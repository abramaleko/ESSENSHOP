@extends('layouts.admin-nav')
@section('scripts')
@endsection
@section('styles')
<style>
    .details
    {
        font-size: 25px;
        padding-top: 20px;
        font-family: 'Roboto Slab', serif;

    }
    @media only screen and (max-width: 600px) {
      
        .details
        {
            font-size: 20px !important;
        }
}
  
</style>
@endsection
@section('title')
    <title>Messages</title>
@endsection
@section('content')
<div class="container my-4">
<div class="messsage">
<p class="details">Name:&nbsp;<strong>{{$message->name}}</strong></p>
<p class="details">Email:&nbsp;<strong>{{$message->email}}</strong></p>
    <p class="details">Message:</p>
<p class="details">{{$message->message}}</p>
</div>
</div>


@endsection