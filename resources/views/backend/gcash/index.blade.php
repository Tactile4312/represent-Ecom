@extends('backend.layouts.master')

@section('title','Manage GCash')

@section('main-content')
<div class="card">
    <h5 class="card-header">Manage GCash</h5>
    <div class="card-body">
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form method="post" action="{{ route('admin.gcash.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="gcash_number">GCash Number</label>
                <input type="text" name="gcash_number" class="form-control" value="{{ $gcash->number ?? '' }}" required>
            </div>
            <div class="form-group">
                <label for="gcash_qr">GCash QR Code</label>
                <input type="file" name="gcash_qr" class="form-control">
                @if(isset($gcash->qr_code_path))
                    <img src="{{ $gcash->qr_code_path }}" alt="GCash QR" style="max-width: 150px; margin-top: 10px;">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Automatically hide alert after 3 seconds
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert").alert('close');
        }, 3000);
    });
</script>
@endpush
