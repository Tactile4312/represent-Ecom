@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card">
  <h5 class="card-header">Order Edit</h5>
  <div class="card-body">
    <form action="{{ route('order.update', $order->id) }}" method="POST">
      @csrf
      @method('PATCH')

      <div class="form-group">
        <label for="status">Order Status:</label>
        <select name="status" id="status" class="form-control">
          <option value="new" {{ ($order->status == 'new') ? 'selected' : '' }}>New</option>
          <option value="process" {{ ($order->status == 'process') ? 'selected' : '' }}>Processing</option>
          {{-- <option value="delivered" {{ ($order->status == 'delivered') ? 'selected' : '' }}>Delivered</option> --}}
          <option value="ready_to_pickup" {{ ($order->status == 'ready_to_pickup') ? 'selected' : '' }}>Ready To Pickup</option>
          <option value="claimed" {{ ($order->status == 'claimed') ? 'selected' : '' }}>Claimed</option>
          <option value="cancel" {{ ($order->status == 'cancel') ? 'selected' : '' }}>Cancel</option>
        </select>
      </div>

      @if($order->payment_method == 'gcash')
      <div class="form-group">
        <label for="gcash_reference">G-Cash Reference Number:</label>
        <input type="text" name="gcash_reference" class="form-control" value="{{ $order->gcash_reference }}" readonly>
      </div>
      <div class="form-group">
        <label for="gcash_receipt">G-Cash Receipt:</label>
        <img src="{{ asset('receipts/' . $order->gcash_receipt) }}" alt="G-Cash Receipt" class="img-fluid gcash-receipt">
      </div>
      @endif

      <div class="form-group">
        <label for="payment_status">Payment Status:</label>
        <select name="payment_status" id="payment_status" class="form-control">
          <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
          <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
@endsection

@push('styles')
<style>
    .order-info, .shipping-info {
        background: #ECECEC;
        padding: 20px;
    }
    .order-info h4, .shipping-info h4 {
        text-decoration: underline;
    }
    .gcash-receipt {
        max-width: 400px; /* Set a reasonable max width */
        height: auto;
        display: block;
        margin: 20px auto; /* Center the image */
    }
</style>
@endpush
