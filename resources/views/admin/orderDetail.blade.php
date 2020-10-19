@extends('layouts.admin-nav')
@section('styles')
<link href="{{asset('css/orderDetail.css')}}" rel="stylesheet">

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

@endsection
@section('title')
    <title>Orders</title>
@endsection
@section('content')
    <div class="container">
        <h2>Order Details</h2>
        <table class="table info">
            <tbody>
              <tr>
                <td>Customer Name</td>
              <td>{{$order->user->name}}</td>
              </tr>
              <tr>
                <td>Email adress</td>
                <td>{{$order->user->email}}</td>
              </tr>
              <tr>
                <td>Phone number</td>
                <td>{{$order->user->phone_number}}</td>
              </tr>
              <tr>
                <tr>
                <td>Location</td>
                <td>{{$order->location}}</td>
              </tr>
              <tr>
                <td>Reference token</td>
                <td>{{$order->reference_token}}</td>
              </tr>
              <tr>
                <td>Order status</td>
                <td>{{$order->Order_status}}</td>
              </tr>
              <tr>
                <td>Date Ordered</td>
                <td>{{$order->created_at}}</td>
              </tr>
              <tr>
                <td>Total</td>
                <td><b>{{$order->total}}</b></td>
              </tr>
            </tbody>
          </table>
          @if ($order->Order_status=='Ordered')
          <a class="btn btn-primary btn-lg" href="{{route('order.confirm',$order->reference_token)}}">Confirm Delivery</a>
          @endif
             <h2 style="margin-bottom: 3rem;">Products Requested</h2>
              <div class="table-borderless">
                  <table class="table table-striped">
                      <thead>
                          <tr>
                              <th scope="col"> </th>
                              <th scope="col">Product</th>
                              <th scope="col">Quantity</th>
                              <th scope="col" class="text-right">Price (Tshs)</th>
                          </tr>
                      </thead>
                      <tbody>
                      
                  @foreach ($tokenDetails as $tokenDetail )
                  <tr>
                  <td><img src="{{asset('storage/'.$tokenDetail->products->image_path)}}" alt="{{$tokenDetail->product_name}}" style="width: 58px; height:55px;" /> </td>
                      <td>{{$tokenDetail->product_name}}</td>
                  <td>{{$tokenDetail->quantity}}</td>
                      <td class="text-right price">{{$tokenDetail->products->new_price}}</td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
    </div>
  
@endsection