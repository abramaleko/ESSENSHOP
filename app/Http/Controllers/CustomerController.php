<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Cart;
use App\Models\User;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Messages;

class CustomerController extends Controller
{
    //
    public function __construct()
    {
     // $this->middleware(['auth','verified'])->except(['index']);
      $this->middleware(['auth','verified'])->except(['index','showProduct','search','productCategory','contactus','sendmessage']);
    }

    public function index()
    {
     //shows the homepage
      if(Auth::user())
      {
        //if user is logged in
        $cartbadge=Cart::where([
          ['user_id','=',auth()->user()->id],
          ['status','=','Pending order'],
          ])->count();
       $products=DB::table('products')->orderBy('id','desc')->get();
       $data=array(
        'products'=>$products,
        'cartbadge'=>$cartbadge 
       );
       return view('index')->with($data);
      }
      else
      {
        $products=DB::table('products')->orderBy('id','desc')->get();
        return view('index')->with('products',$products);
      }
    }
    
    public function productCategory($id)
    {
      $products=Products::where('tag',$id)->get();
      if(Auth::user())
      {
        $cartbadge=Cart::where([
          ['user_id','=',auth()->user()->id],
          ['status','=','Pending order'],
          ])->count();
          $data=array(
            'products'=>$products,
            'cartbadge'=>$cartbadge ,
            'tag'=>$id
           );
           return view('productsCategorized')->with($data);
      }
      return view('productsCategorized')->with(['products'=>$products,'tag'=>$id]);

     
   
    }
    public function showProduct($id)
    {
        if(Auth::user())
        {
           //show the individual product
           $product=DB::table('products')->find($id);
           $cartbadge=Cart::where([
            ['user_id','=',auth()->user()->id],
            ['status','=','Pending order'],
            ])->count();
             $data=array(
             'product'=>$product,
             'cartbadge'=>$cartbadge 
            );
           return view('product')->with($data);
        }
        else
        {
          $product=DB::table('products')->find($id);
          return view('product')->with('product',$product);
        }
    }
    public function addToCart(Request $request)
    {
      //check if item to added to cart is already added by checking the user id is has already added a certain product
      $product_name=$request->input('product_name');
      $user_id=auth()->user()->id;
      $check=Cart::where([
          ['user_id','=',$user_id],
          ['product_name','=',$product_name],
          ['status','=','Pending order'],
          ])->count();
          if($check>=1)
          {
              return json_encode('Item has already been added to cart');
          }
          else{
            $insert=new Cart;
            $insert->product_id=$request->input('product_id');
            $insert->user_id=$user_id;
            $insert->product_name=$product_name;
            $insert->quantity=$request->input('quantity');
            $insert->save();
            return json_encode(array(
              "statusCode"=>200
          ));
        }
    }

    public function cartBadge()
    //updates the cartbadge
    {
      $cartbadge=Cart::where([
        ['user_id','=',auth()->user()->id],
        ['status','=','Pending order'],
        ])->count();
        return $cartbadge;
    }
    public function cart()
    {
           //shows the cart page
           $cartbadge=Cart::where([
            ['user_id','=',auth()->user()->id],
            ['status','=','Pending order'],
            ])->count();
            $cartItems=Cart::where([
            ['user_id','=',auth()->user()->id],
            ['status','=','Pending order'],
          ])->orderBy('cart_id','desc')->get();
          $data=array(
            'cartItems'=>$cartItems,
            'cartbadge'=>$cartbadge 
           );

          return view('cart')->with($data);
    }

    public function updateQuantity(Request $request)
    {
     //this functions updates the quantity of the product in the cart when user changes
      $quantity=$request->input('quantity');
      $productName=$request->input('productName');
      $update=Cart::where([
        ['status','=','Pending order'],
        ['product_name','=',$productName]
      ])->update(['quantity'=>$quantity]);
      return true;
    }
    public function deleteitem($id)
    {
     //delete an item in the cart page
      $deleteitem=Cart::where('cart_id',$id)->delete();
      return redirect('/cart');
    }
    public function confirmDetail(Request $request)
    {
       $userDetail=User::find(Auth::user()->id);
       $subtotal=$request->input('subtotal');
      return view('confirminfo',[
        'userDetail'=>$userDetail,
      'subtotal' => $subtotal
      ])->render();
    }

    public function addToOrder(Request $request)
    {
      $user_id=auth()->user()->id;
      $location=$request->input('location');
      $total=$request->input('total');
      $token= $request->input('reference_token');

      //updates the cart items which have been assigned a payment token
      $updateStatus=Cart::where([
        ['user_id','=',$user_id],
        ['status','=','Pending order']
        ])->update(
          ['status'=>'Ordered','reference_token'=>$token,]
        );
     //inserts into orders table
      $insert=new Orders;
      $insert->user_id=$user_id;
      $insert->total=$total;
      $insert->reference_token=$token;
      $insert->location=$location;
      $insert->save();
      return json_encode(array(
        "statusCode"=>200
    ));
    }

    public function requestedOrders()
    {
          //shows the requested orders
          $orders=Orders::where('user_id',Auth::user()->id)->get();
          return view('orders')->with('orders',$orders);
    }

    public function orderDetail($id)
    {
      $cartDetails=Cart::where('reference_token',$id)->get(); //finds the items in the cart table
      $orderDetails=Orders::where('reference_token',$id)->first();  //find the order corresponding to the token
      return view('orderDetails',['orderDetails'=>$orderDetails,'cartDetails'=>$cartDetails]);
    }
     public function search(Request $request)
     {
       $name=$request->input('search');
       $name1=substr($name,0,5);
       $search=Products::where('name',$name)
       ->orWhere('name','like',$name1.'%')
       ->get();
       if(Auth::user())
     {
        //if user is logged in
        $cartbadge=Cart::where([
          ['user_id','=',auth()->user()->id],
          ['status','=','Pending order'],
          ])->count();
      $data=array(
        'products'=>$search,
        'cartbadge'=>$cartbadge 
      );       
      return view('search')->with($data);
     }
     return view('search')->with('products',$search);
     }

     public function contactus()
     {
     if(Auth::user())
     {
        //if user is logged in
        $cartbadge=Cart::where([
          ['user_id','=',auth()->user()->id],
          ['status','=','Pending order'],
          ])->count();
         return view('contactus')->with('cartbadge',$cartbadge);
     }
        return view('contactus');
     }
       
     public function sendmessage(Request $request)
     {
       //validate the message
       $this->validate($request,[
          'name'=>'required|string',
          'email'=>'required|email',
          'message'=>'required|string',
       ]);
        
       $ins=new Messages;
       $ins->name=$request->input('name');
       $ins->email=$request->input('email');
       $ins->message=$request->input('message');
       $ins->save();

      return redirect()->back()->with('success','Thanks for getting in touch,we will contact you soon');

     }
}
