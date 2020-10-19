@extends('layouts.admin-nav')
@section('scripts')
@endsection
@section('styles')

@endsection
@section('title')
    <title>Messages</title>
@endsection
@section('content')
<div class="container my-4">
    <table class="table table-hover table-responsive-sm">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Date sent</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @if (count($messages)>0)
            @foreach ($messages as $message)
                <tr>
                <td><a href="{{route('message.detail',$message->id)}}">{{$message->name}}</td>
                <td>{{$message->email}}</td>
                <td>{{$message->created_at}}</td>
                <td><a class="btn btn-danger" href="{{route('message.delete',$message->id)}}"><i class="fa fa-trash"></i> </a></td>
              </tr>  
            @endforeach
            @endif
        </tbody>
      </table>
</div>


@endsection