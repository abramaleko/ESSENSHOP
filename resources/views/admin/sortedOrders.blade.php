<table class="table table-hover table-responsive-sm">
    <thead>
      <tr>
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
            <td>{{$order->user->name}}</td>
            <td>{{$order->reference_token}}</td>
            <td>{{$order->total}}</td>
            <td>{{$order->Order_status}}</td>
            <td>{{$order->created_at}}</td>
            <td><a class="btn verify btn-primary" href=""><i class="fa fa-check-circle"></i>&nbsp;Deliver</a></td>
        </tr>
            @endforeach
    </tbody>
  </table>