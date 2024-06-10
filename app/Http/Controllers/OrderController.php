<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipping;
use App\User;
use App\Jobs\GeneratePdfJob;
use Illuminate\Support\Facades\Notification;
use Helper;
use Illuminate\Support\Str;
use App\Notifications\StatusNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductCheckedOut;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(10);
        return view('backend.order.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $this->validate($request, [
        'first_name' => 'string|required',
        'last_name' => 'string|required',
        'full_address' => 'string|required', // Validation for full address
        'address2' => 'string|nullable',
        'coupon' => 'nullable|numeric',
        'phone' => 'numeric|required',
        'post_code' => 'string|nullable',
        'email' => 'string|required',
        'gcash_receipt' => 'required_if:payment_method,gcash|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'gcash_reference' => 'required_if:payment_method,gcash'
    ]);

    if (empty(Cart::where('user_id', auth()->user()->id)->where('order_id', null)->first())) {
        request()->session()->flash('error', 'Cart is Empty!');
        return back();
    }

    $order = new Order();
    $order_data = $request->all();
    $order_data['order_number'] = 'ORD-' . strtoupper(Str::random(10));
    $order_data['user_id'] = $request->user()->id;
    $order_data['shipping_id'] = $request->shipping;
    $shipping = Shipping::where('id', $order_data['shipping_id'])->pluck('price');
    $order_data['sub_total'] = Helper::totalCartPrice();
    $order_data['quantity'] = Helper::cartCount();
    $order_data['total_amount'] = Helper::totalCartPrice();

    // Update address1 with full address
    $order_data['address1'] = $request->full_address;

    if (request('payment_method') == 'paypal') {
        $order_data['payment_method'] = 'paypal';
        $order_data['payment_status'] = 'paid';
    } elseif (request('payment_method') == 'cardpay') {
        $order_data['payment_method'] = 'cardpay';
        $order_data['payment_status'] = 'paid';
    } elseif (request('payment_method') == 'gcash') {
        $order_data['payment_method'] = 'gcash';
        $order_data['payment_status'] = 'pending';

        // Handle file upload for G-Cash receipt
        if ($request->hasFile('gcash_receipt')) {
            $receiptName = time() . '.' . $request->gcash_receipt->extension();
            $request->gcash_receipt->move(public_path('receipts'), $receiptName);
            $order_data['gcash_receipt'] = $receiptName;
        }

        $order_data['gcash_reference'] = $request->gcash_reference;
    } else {
        $order_data['payment_method'] = 'cod';
        $order_data['payment_status'] = 'Unpaid';
    }

    $order->fill($order_data);
    $status = $order->save();

    if ($order) {
        $users = User::where('role', 'admin')->first();
        $details = [
            'title' => 'New Order Received',
            'actionURL' => route('order.show', $order->id),
            'fas' => 'fa-file-alt'
        ];
        Notification::send($users, new StatusNotification($details));

        Mail::to(auth()->user()->email)->send(new ProductCheckedOut($order));

        if (request('payment_method') == 'paypal') {
            return redirect()->route('payment')->with(['id' => $order->id]);
        } else {
            session()->forget('cart');
            session()->forget('coupon');
        }
        Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => $order->id]);

        request()->session()->flash('success', 'Your product order has been placed. Thank you for shopping with us.');
        return redirect()->route('home');
    }
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function show($id){
         $order = Order::with(['shipping', 'products'])->find($id);
         if (!$order) {
             abort(404); // Handle case where order with the given ID doesn't exist
         }
         // Check if the authenticated user is an admin
         if (auth()->user()->role == 'admin') {
             return view('backend.order.show')->with('order', $order); // Return the admin view
         } else {
             abort(403); // Unauthorized access
         }
     }

     public function userShow($id){
        $order = Order::with(['shipping', 'products'])->find($id);
        if (!$order) {
            abort(404); // Handle case where order with the given ID doesn't exist
        }
        // Ensure the user is the owner of the order
        if ($order->user_id == auth()->user()->id) {
            return view('user.order.show')->with('order', $order); // Return the user view
        } else {
            abort(403); // Unauthorized access
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view('backend.order.edit')->with('order', $order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
    $order = Order::find($id);
    $this->validate($request, [
        'status' => 'required|in:new,process,delivered,cancel',
        'payment_status' => 'required|in:unpaid,pending,paid', // Add validation for payment status
    ]);

    $data = $request->all();

    if ($request->status == 'delivered') {
        foreach ($order->cart as $cart) {
            $product = $cart->product;
            $product->stock -= $cart->quantity;
            $product->save();
        }
    }

    $order->status = $data['status'];
    $order->payment_status = $data['payment_status'];

    $status = $order->save();

    if ($status) {
        request()->session()->flash('success', 'Successfully updated order');
    } else {
        request()->session()->flash('error', 'Error while updating order');
    }
    return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            $status = $order->delete();
            if ($status) {
                request()->session()->flash('success', 'Order Successfully deleted');
            } else {
                request()->session()->flash('error', 'Order cannot be deleted');
            }
            return redirect()->route('order.index');
        } else {
            request()->session()->flash('error', 'Order not found');
            return redirect()->back();
        }
    }

    /**
     * Generate a PDF for the specified order.
     *
     * @param  int  $orderId
     * @return \Illuminate\Http\Response
     */
    public function generatePdf($orderId)
    {
        set_time_limit(120); // Increase execution time

        $order = Order::with(['cart_info.product'])->find($orderId);

        // Dispatch the job to generate the PDF
        GeneratePdfJob::dispatch($order);

        return response()->json(['message' => 'PDF generation started, you will be notified when it is ready.']);
    }

    /**
     * Display the order tracking page.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderTrack()
    {
        return view('frontend.pages.order-track');
    }

    /**
     * Track a specific order based on the order number.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function productTrackOrder(Request $request)
    {
        $order = Order::where('user_id', auth()->user()->id)->where('order_number', $request->order_number)->first();
        if ($order) {
            switch ($order->status) {
                case 'new':
                    request()->session()->flash('success', 'Your order has been placed.');
                    break;
                case 'process':
                    request()->session()->flash('success', 'Your order is currently processing.');
                    break;
                case 'delivered':
                    request()->session()->flash('success', 'Your order has been delivered. Thank you for shopping with us.');
                    break;
                default:
                    request()->session()->flash('error', 'Sorry, your order has been canceled.');
                    break;
            }
            return redirect()->route('home');
        } else {
            request()->session()->flash('error', 'Invalid order number. Please try again!');
            return back();
        }
    }

    /**
     * Generate a PDF for the specified order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pdf(Request $request)
    {
        $order = Order::getAllOrder($request->id);
        $file_name = $order->order_number . '-' . $order->first_name . '.pdf';
        $pdf = PDF::loadView('backend.order.pdf', compact('order'));
        return $pdf->download($file_name);
    }

    /**
     * Generate an income chart for the current year.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function incomeChart(Request $request)
    {
        $year = \Carbon\Carbon::now()->year;
        $items = Order::with(['cart_info'])->whereYear('created_at', $year)->where('status', 'delivered')->get()
            ->groupBy(function ($d) {
                return \Carbon\Carbon::parse($d->created_at)->format('m');
            });

        $result = [];
        foreach ($items as $month => $item_collections) {
            foreach ($item_collections as $item) {
                $amount = $item->cart_info->sum('amount');
                $m = intval($month);
                isset($result[$m]) ? $result[$m] += $amount : $result[$m] = $amount;
            }
        }

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthName = date('F', mktime(0, 0, 0, $i, 1));
            $data[$monthName] = (!empty($result[$i])) ? number_format((float)($result[$i]), 2, '.', '') : 0.0;
        }
        return $data;
    }
}
