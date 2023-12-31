<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
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
        $comment=Comment::orderby('id','desc')->get();
        $reply=Reply::all();
        return view('home.userpage', compact('product','comment','reply'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {
            $total_product=Product::all()->count();
            $total_order=Order::all()->count();
            $total_user=User::all()->count();

            $order=Order::all();

            $total_revenue=0;

            foreach($order as $order)
            {
                $total_revenue=$total_revenue + $order->price;

            }

            $total_delivered=Order::where('delivery_status','=','delivered')->get()->count();

            $total_processing=Order::where('delivery_status','=','processing')->get()->count();

            return view('admin.home',compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing'));
        } else {
            $product = product::paginate(9);

            $comment=Comment::orderby('id','desc')->get();

            $reply=Reply::all();

            return view('home.userpage', compact('product','comment','reply'));
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

            $userid=$user->id;

            $product = Product::find($id);

            $product_exist_id=Cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();

            if($product_exist_id)
            {
                $cart=Cart::find($product_exist_id)->first();

                $quantity=$cart->quantity;

                $cart->quantity=$quantity + $request->quantity;

                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $cart->quantity;
                } else {
                    $cart->price = $product->price * $cart->quantity;
                }

                $cart->save();

                return redirect()->back()->with('message','Product Added to Cart Successfully');

            }
            else
            {
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

            }

            
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

        return redirect('/show_order')->with('message', 'We have received your order. We will connect with you very soon...');
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

    public function show_order()
    {
        if(Auth::id())
        {

            $user=Auth::user();

            $userid=$user->id;

            $order=Order::where('user_id','=',$userid)->get();

            return view('home.order',compact('order'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function cancle_order($id)
    {
        $order = Order::find($id);

        $order->delivery_status='You Cancled the Order';

        $order->save();

        return redirect()->back();
    }

    public function add_comment(Request $request)
    {
        if(Auth::id())
        {
            $comment=new Comment;

            $comment->name=Auth::user()->name;
            $comment->user_id=Auth::user()->id;

            $comment->comment=$request->comment;

            $comment->save();

            return redirect()->back();

        }
        else
        {
            return redirect('login');
        }

    }

    public function add_reply(Request $request)
    {
        if(Auth::id())
        {
            $reply=new Reply;

            $reply->name=Auth::user()->name;
            $reply->user_id=Auth::user()->id;
            $reply->comment_id=$request->commentId;
            $reply->reply=$request->reply;

            $reply->save();

            return redirect()->back();

        }
        else
        {
            return redirect('login');
        }
    }

    public function product_search(Request $request)
    {

        $comment=Comment::orderby('id','desc')->get();
        $reply=Reply::all();

        $search_text = $request->search;

        $product=Product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"$search_text")->paginate(9);

        return view('home.userpage',compact('product','comment','reply'));
    }

    public function products()
    {

        $product = product::paginate(9);
        $comment=Comment::orderby('id','desc')->get();
        $reply=Reply::all();

        return view('home.all_product',compact('product','comment','reply'));
    }

    public function search_product(Request $request)
    {

        $comment=Comment::orderby('id','desc')->get();
        $reply=Reply::all();

        $search_text = $request->search;

        $product=Product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"$search_text")->paginate(9);

        return view('home.all_product',compact('product','comment','reply'));

    }

    public function contact()
    {
        return view('home.contact');
    }

    public function showPage()
{
    // Get the currently logged-in user
    $user = Auth::user();
    
    // Pass the user data to the view
    return view('your.view.name', ['user' => $user]);
}

}
