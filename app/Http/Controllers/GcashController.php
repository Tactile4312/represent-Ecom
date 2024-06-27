<?php
// /app/Http/Controllers/GCashController.php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GCashDetail;

class GCashController extends Controller
{
    public function index()
    {
        $gcash = GCashDetail::first();
        return view('backend.gcash.index', compact('gcash'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'gcash_number' => 'required|string|max:15',
            'gcash_qr' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gcashData = [
            'number' => $request->gcash_number,
        ];

        if ($request->hasFile('gcash_qr')) {
            $image = $request->file('gcash_qr');
            $name = 'gcash_qr.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $gcashData['qr_code_path'] = '/images/' . $name;
        }

        GCashDetail::updateOrCreate(['id' => 1], $gcashData);

        return redirect()->back()->with('success', 'GCash details updated successfully.');
    }
}


