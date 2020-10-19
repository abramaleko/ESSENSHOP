<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Products;
use App\Models\Orders;
use App\Models\Cart;
use App\Models\Messages;



class AdminsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        //shows the all products in stock
        $products=DB::table('products')->orderBy('id','desc')->get();
        return view('admin.dashboard')->with('products',$products);
    }
    public function productDelete($id)
    {
        //deletes the product from the table
        $deleteProduct=Products::find($id)->delete();
        return redirect()->back();
    }
    public function sortByTag(Request $request)
    {
        $tag=$request->input('tag');
        if ($tag=="All") {
            //if tag selected is all
         $results=DB::table('products')->orderBy('id','desc')->get();
         return view('admin.sorted')->with('products',$results)->render();
        }
        else
        {
         $results=Products::where('tag',$tag)->get();
         return view('admin.sorted')->with('products',$results)->render();
        }
    }

     //shows a new product page
     public function newProduct()
     {
         return view('admin.new-product');
     }

     //adds a new product
    public function addProduct (Request $request)
    {   
      $this->validate($request,[
          'name'=>'required|string',
          'image' => 'required|mimes:jpg,jpeg,png|max:2048',
          'image1' => 'mimes:jpg,jpeg,png|max:2048',
          'image2' => 'mimes:jpg,jpeg,png|max:2048',
          'image3' => 'mimes:jpg,jpeg,png|max:2048',
          'description' => 'required|string',
          'stock' => 'required',
          'price' => 'required',
          'tag' => 'required',
      ]);
      $path = $request->file('image')->store('product_images','public');

    $ins=new Products;
    $ins->name=$request->input('name');
    $ins->image_path=$path;
    //checks the image uploaded has the three images
    if ($request->hasFile('image1')) 
    {
      $path1 = $request->file('image1')->store('product_images','public');
      $ins->image1=$path1;
    }
     if ($request->hasFile('image2')) 
    {
      $path2 = $request->file('image2')->store('product_images','public');
      $ins->image2=$path2;
    }
    if ($request->hasFile('image3')) 
    {
      $path3 = $request->file('image3')->store('product_images','public');
      $ins->image3=$path3;
    }
    $ins->description=$request->input('description');
    $ins->stock=$request->input('stock');
    $ins->new_price=$request->input('price');
    $ins->tag=$request->input('tag');
    $ins->save();
    return redirect()->route('admin.new_product')->with('success','The product have been successfully added');
    }


    public function update($id)
    {
        //shows the update product page
        $product=Products::find($id);
        return view('admin.updateProduct')->with('product',$product);
    }

  public function updateProduct(Request  $request ,$id)
    {
        //validate the product updates
     $this->validate($request,[
         'name'=>'required|string',
         'image' => 'mimes:jpg,jpeg,png|max:2048',
         'image1' => 'mimes:jpg,jpeg,png|max:2048',
         'image2' => 'mimes:jpg,jpeg,png|max:2048',
         'image3' => 'mimes:jpg,jpeg,png|max:2048',
         'description' => 'required|string',
         'stock' => 'required',
         'price' => 'required',
         'tag' => 'required',
     ]);
 
 //updates the product details
     $product=  Products::find($id);
     $product->name=$request->input('name');
     if ($request->hasFile('image')) 
     {
     $path = $request->file('image')->store('product_images','public');
     $product->image_path=$path;
    }
        //checks the image uploaded has the three images
        if ($request->hasFile('image1')) 
        {
          $path1 = $request->file('image1')->store('product_images','public');
          $product->image1=$path1;
        }
         if ($request->hasFile('image2')) 
        {
          $path2 = $request->file('image2')->store('product_images','public');
          $product->image2=$path2;
        }
        if ($request->hasFile('image3')) 
        {
          $path3 = $request->file('image3')->store('product_images','public');
          $product->image3=$path3;
        }
     $product->description=$request->input('description');
     $product->stock=$request->input('stock');
     $product->new_price=$request->input('price');
     $product->tag=$request->input('tag');
     $product->save();
     return redirect()->route('admin.new_product')->with('success','The product have been successfully updated');
    }

    public function orders()
    {
         $orders=Orders::all();  //selects all records in the table orders
        return view ('admin.orders')->with('orders',$orders);
    }

    public function sortOrders(Request $request)
    {
        $tag=$request->tag;
        switch ($tag) {
            case 'All':
                {
                $orders=Orders::all();  //selects all records in the table orders
                return view('admin.sortedOrders')->with('orders',$orders)->render();
                }
                break;
                case 'Order Requests':
                {
                    $orders=Orders::where('Order_status','Ordered')->get();
                    return view('admin.sortedOrders')->with('orders',$orders)->render();
                }
                break;
                case 'Delivered orders':
                {
                    $orders=Orders::where('Order_status','Delivered')->get();
                    return view('admin.sortedOrders')->with('orders',$orders)->render();
                }
                 break;
                 case 'Date added':
                    {
                        $orders=Orders::orderBy('created_at','desc')->get();
                        return view('admin.sortedOrders')->with('orders',$orders)->render();

                    }
                     break;
        }
    }

      public function orderdetail($id)
      {
          $order=Orders::where('reference_token',$id)->first();
          $tokenDetails=Cart::where('reference_token',$id)->get();
          $data=array(
            'order'=>$order,
            'tokenDetails'=>$tokenDetails 
           );
          return view('admin.orderDetail')->with($data);
      }

      public function orderconfirm($id)
      {
        $updateOrder=Orders::where('reference_token',$id)->update(['Order_status'=>'Delivered']);
        $updateCart=Cart::where('reference_token',$id)->update(['status'=>'Delivered']);
        return redirect()->route('admin.orders');
      }
            public function messages()
      {
           $messages=Messages::all();
           return view('admin.messages')->with('messages',$messages);
      }

      public function messageDelete($id)
      {
          //deletes the mail from the table
          $deletemessage=Messages::find($id)->delete();
          return redirect()->back();
      }
      public function messageDetail($id)
      {
         
        $message=Messages::find($id)->first();
       return view('admin.messageDetail')->with('message',$message);
      }

}

