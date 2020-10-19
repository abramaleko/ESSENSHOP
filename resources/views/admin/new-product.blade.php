@extends('layouts.admin-nav')
@section('styles')
<link rel="stylesheet" href="{{asset('css/newProduct.css')}}">
@endsection
@section('title')
    <title>Add product</title>
@endsection
@section('content')
<div class="container">
    <p id="new_product">ADD NEW PRODUCT</p>
    @if (count($errors)>0)
    <!--checks for errors in validation-->
    <script>
      $('.alert').alert()
      </script>
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
            <ul>
        @foreach ($errors->all() as $error)
           <li>{{$error}}</li>           
        @endforeach
      </ul>
    </div>
   @endif
   @if (session('success'))
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <!--displays the success message after adding product-->
        {{ session('success') }}
    </div>
@endif
<form method="POST" action="{{route('admin.addProduct')}}" enctype="multipart/form-data" autocomplete="off">
  @csrf
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="name">Product name</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group col-md-6" style="padding-top: 30px;">
            <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="image" name="image">
                  <label class="custom-file-label" for="image">Cover Image</label>
                </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="my-2">Product Images</label>
          <small id="" class="form-text text-muted">
            This images are optional to upload
          </small> 
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="image" name="image1">
                  <label class="custom-file-label" for="image">Image 1</label>
                </div>
            </div>
          </div>
          <div class="form-group col-md-4">
            <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="image" name="image2">
                  <label class="custom-file-label" for="image">Image 2</label>
                </div>
            </div>
          </div>
          <div class="form-group col-md-4">
            <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="image" name="image3">
                  <label class="custom-file-label" for="image">Image 3</label>
                </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="description">Product description</label>
          <textarea rows=" 5" class="form-control ckeditor" id="description" name="description" placeholder="What is the product all about?"></textarea>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="Price">Price (Tshs)</label>
            <input type="number" class="form-control" id="Price" name="price">
          </div>
          <div class="form-group col-md-4">
            <label for="inputTag">Tag</label>
            <select id="inputTag" class="form-control" name="tag">
              <option selected>Choose...</option>
              <option>Electronic Gadgets</option>
              <option>Electronic Spares</option>
              <option>Clothing</option>
              <option>Furniture</option>            
              <option>Cosmetics</option>            
              <option>Ornaments</option>            
            </select>
          </div>
          <div class="form-group col-md-2">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" min="1">
          </div>
        </div>

        <button type="submit" class="btn btn-outline-primary btn-lg">Add Product</button>
      </form>
</div>
<script>
   document.querySelectorAll('.custom-file-input').forEach(item => {
  item.addEventListener('change',function(e) {
    //handle click
    var fileName = e.target.files[0].name;
   var nextSibling = e.target.nextElementSibling
   nextSibling.innerText = fileName
  })
})
    </script>
  <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
  </script>
@endsection