<table class="table table-hover table-responsive-sm">
  <thead>
    <tr>
      <th> Image</th>
      <th> Name</th>
      <th>Stock</th>
      <th>Price</th>
      <th>Tag</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($products as $product)
  <td><img src="{{asset('storage/'.$product->image_path)}}" alt="{{$product->name}}" style="width: 58px;
    height: 55px;"></td>
  <td><a href="/admin/editProduct/{{$product->id}}" style="color: inherit">{{$product->name}}</a></td>
  <td>{{$product->stock}}</td>
  <td>{{$product->new_price}}</td>
  <td>{{$product->tag}}</td>
  <td><a class="btn btn-danger" href="{{route('admin.product.delete',$product->id)}}"><i class="fa fa-trash"></i> </a></td>
  </tr>
    @endforeach
  </tbody>
</table>