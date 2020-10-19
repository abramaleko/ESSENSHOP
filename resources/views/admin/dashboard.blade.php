@extends('layouts.admin-nav')
@section('scripts')
<script src="{{asset('js/sortByTag.js')}}"></script>
@endsection
@section('styles')
<link rel="stylesheet" href="{{asset('css/showProduct.css')}}">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection
@section('title')
    <title>Products</title>
@endsection
@section('content')
<div class="container">
    <p class="header">Products in stock</p>
    <label for="tag" class="mr-sm-2 sortlabel">Sort by tag:</label>
        <div class="form-group form-inline">
            <select class="form-control form-control w-25 mr-sm-2" id="tag">
              <option>All</option>
                 <option>Electronic Gadgets</option>
                <option>Electronic Spares</option>
                 <option>Clothing</option>
                <option>Furniture</option>            
                <option>Cosmetics</option>            
                <option>Ornaments</option>   
            </select>
            <button class="btn btn-primary" onclick="sort()" id="btnSort">Sort</button>
          </div>

          <div class="products-table">
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
          </div>
</div>
    
@endsection