@extends('layouts.admin-nav')
@section('scripts')
<script src="{{asset('js/sortOrders.js')}}"></script>
@endsection
@section('styles')
<link href="{{asset('css/orders.css')}}" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

@endsection
@section('title')
    <title>Orders</title>
@endsection
@section('content')
<div class="container">
    <div class="sort">
        <label for="tag" class="mr-sm-3 sortlabel">Sort by:</label>
        <div class="form-group form-inline">
            <select class="form-control form-control w-25 mr-sm-2" id="tag">
                <option>All</option>
                <option>Order Requests</option>
                <option>Delivered orders</option>
                <option>Date added</option>
            </select>
            <button class="btn btn-primary" onclick="sort()">Sort</button>
          </div>
    </div>
    @if (session('success'))
<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <!--displays the success message after adding product-->
    {{ session('success') }}
</div>
@endif
</div>
<div class="container-fluid">
<div class="orders-table">
    <table class="table table-hover table-responsive-sm">
        <thead>
          <tr>
            <th> S/N</th>
            <th> Name</th>
            <th>Reference Token</th>
            <th>Total price</th>
            <th>Order Status</th>
            <th>Date Ordered</th>
            <th>Make Delivery</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td class="number"></td>
                <td>{{$order->user->name}}</td>
                <td>{{$order->reference_token}}</td>
                <td>{{$order->total}}</td>
                <td>{{$order->Order_status}}</td>
                <td>{{$order->created_at}}</td>
            <td><a class="btn verify btn-primary" href="{{route('order.detail',$order->reference_token)}}"><i class="fa fa-check-circle"></i>&nbsp;Deliver</a></td>
            </tr>
                @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection