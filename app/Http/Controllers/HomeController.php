<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Stripe;


class HomeController extends Controller
{

    public function index()
    {
        $product = product::paginate(9);
        return view('home.userpage', compact('product'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {
            return view('admin.home');
        } else {
            $product = product::paginate(9);
            return view('home.userpage', compact('product'));
        }
    }

    public function product_details($id)
    {

        $product = product::find($id);

        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request, $id)
    {

        if (Auth::id()) {
            $user = Auth::user();

            $product = Product::find($id);

            $cart = new cart;

            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;

            $cart->user_id = $user->id;
            $cart->product_title = $product->title;

            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $request->quantity;
            } else {
                $cart->price = $product->price * $request->quantity;
            }


            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;

            $cart->save();

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function show_cart()
    {

        if (Auth::id()) {
            $id = Auth::user()->id;

            $cart = Cart::where('user_id', '=', $id)->get();

            return view('home.showcart', compact('cart'));
        } else {
            return redirect('login');
        }
    }

    public function remove_cart($id)
    {
        $cart = Cart::find($id);

        $cart->delete();

        return redirect()->back();
    }

    public function order_now()
    {
        $user = Auth::user();
        $userid = $user->id;

        $cartItems = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.user_id', $userid)
            ->select('carts.*', 'products.title', 'products.price', 'products.discount_price', 'products.image')
            ->get();

        $total = 0;
        foreach ($cartItems as $cartItem) {
            // Calculate the price using discount_price if available, otherwise use price
            $price = ($cartItem->discount_price != null) ? $cartItem->discount_price : $cartItem->price;
            $total += $price * $cartItem->quantity;
        }

        return view('home.checkout', ['user' => $user, 'cartItems' => $cartItems, 'total' => $total]);
    }


    public function orderPlace(Request $req)
    {
        $user = Auth::user();
        $userid = $user->id;

        $data = Cart::where('user_id', $userid)->get();

        foreach ($data as $cartItem) {
            $order = new Order;

            $order->name = $user->name;
            $order->email = $user->email;
            $order->phone = $user->phone;
            $order->address = $req->address;
            $order->user_id = $userid;
            $order->product_title = $cartItem->product_title;
            $order->price = $cartItem->price;
            $order->quantity = $cartItem->quantity;
            $order->image = $cartItem->image;
            $order->product_id = $cartItem->product_id;

            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'Processing';

            $order->save();
        }

        Cart::where('user_id', $userid)->delete();

        return redirect('/show_cart')->with('message', 'We have Recieved Your Order. We Will connect with You very soon...');
    }

    public function stripe($totalprice)
    {
        return view('home.stripe', compact('totalprice'));
    }

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for Payment." 
        ]);
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }

}