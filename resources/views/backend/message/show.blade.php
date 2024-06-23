@extends('backend.layouts.master')
@section('main-content')

<div class="card">
  <h5 class="card-header">Message</h5>
  <div class="card-body">
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif

    @if($message)
        @if($message->photo)
        <img src="{{$message->photo}}" class="rounded-circle " style="margin-left:44%;">
        @else
        <img src="{{asset('backend/img/avatar.png')}}" class="rounded-circle " style="margin-left:44%;">
        @endif
        <div class="py-4">From: <br>
           Name :{{$message->name}}<br>
           Email :{{$message->email}}<br>
           Phone :{{$message->phone}}
        </div>
        <hr/>
        <h5 class="text-center" style="text-decoration:underline"><strong>Subject :</strong> {{$message->subject}}</h5>
        <p class="py-5">{{$message->message}}</p>
    @endif
  </div>
</div>

<div class="card mt-4">
  <h5 class="card-header">Reply</h5>
  <div class="card-body">
    <form action="{{ route('message.reply', $message->id) }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="reply">Your Reply</label>
        <textarea class="form-control" id="reply" name="reply" rows="5" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Send Reply</button>
    </form>
  </div>
</div>

@endsection
