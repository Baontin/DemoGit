<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\order_detail;

// use Session;
use Stripe;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
// PAGES
    public function index()
    {
        $user = User::where('usertype', 'user')->get()->count();
        $product = Product::all()->count();
        $order = Order::all()->count();
        $deliver = Order::where('status', 'Delivered')->get()->count();

        return view("admin/index", compact('user', 'product', 'order', 'deliver'));
    }

    public function home()
    {
        $products = Product::paginate(4);

        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }

        return view("home.index", compact('products', 'count'));
    }

    public function shop() {
        $categories = Category::all();
        $products = Product::paginate(9);

        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }

        return view('home.shop', compact('count', 'products', 'categories'));
    }

    public function filter($category_name) {
        $categories = Category::all();
        $products = Product::where('category', $category_name)->paginate(9);

        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }

        return view('home.shop', compact('count', 'products', 'categories'));
    }
    
    public function testimonial() {

        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }

        return view('home.testimonial', compact('count'));
    }

    public function why_us() {

        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }

        return view('home.why_us', compact('count'));
    }

    public function contact_us() {
        if(Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }

        return view('home.contact_us', compact('count'));
    }
// @ END PAGES

    public function login_home()
    {
        $products = Product::paginate(4);

        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }

        return view("home.index", compact('products', 'count'));
    }

    public function product_details($id)
    {
        $product = Product::find($id);

        $descriptions = explode('<hr>', $product->description);

        $shortDescription = isset($descriptions[0]) ? $descriptions[0] : '';
        

        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }

        return view('home.product_details', compact('product', 'count', 'shortDescription'));
    }

    public function increase_quantity($id) {
        $cartItem = Cart::find($id);
        $product_id = $cartItem->product_id;
        $product = Product::find($product_id);


        if ($cartItem) {
            if ($cartItem->quantity < $product->quantity) {
                $cartItem->quantity += 1;
                $cartItem->save();
            } else { 
                toastr()->warning('Product is only have ' . $product->quantity);
            }
        }
        return redirect()->back();
    }

    public function decrease_quantity($id) {
        $cartItem = Cart::find($id);

        if($cartItem && $cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();
        }
        return redirect()->back();
    }

    public function add_cart($id)
    {
        $product_id = $id;

        $user = Auth::user();
        $user_id = $user->id;

        $cartItem = Cart::where('user_id', $user_id)
                                ->where('product_id', $product_id)
                                ->first();

        $product = Product::find($product_id);

        if ($cartItem) {
            if ($cartItem->quantity < $product->quantity) {
                $cartItem->quantity += 1;
                $cartItem->save();
            } else {
                toastr()->warning('Product is only have ' . $product->quantity);
            }

        } else {
            $data = new Cart;

            $data->user_id = $user_id;
            $data->product_id = $product_id;

            $data->save();
        }

        toastr()->success('Product added to cart successfully.');
        return redirect()->back();
    }
    
    public function buy_now($id) {
        $product_id = $id;

        $user_id = Auth::user()->id;

        $cartItem = Cart::where('user_id', $user_id)
                            ->where('product_id', $product_id)
                            ->first();
        
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            $data = new Cart;

            $data->user_id = $user_id;
            $data->product_id = $product_id;

            $data->save();
        }
        
        toastr()->success('Product added to cart successfully.');
        return redirect('mycart');

    }

    public function mycart () {

        if (Auth::id()) {
            $user = Auth::user();

            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();

            // Get product's data of an acc with user_id
            $cart = Cart::where('user_id', $user_id)->get();
        } else {
            $count = '';
        }


        return view('home.mycart', compact('count', 'cart'));
    }

    public function delete_cart($id) {
        $data = Cart::find($id);

        $data->delete();

        toastr()->success('Product removed successfully.');

        return redirect()->back();
    }

    public function mypersonal() {
        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();

            $orders = Order::where('user_id', $user_id)->paginate(4);
        } else {
            $count = '';
        }

             
        return view('home.mypersonal', compact('count', 'orders'));
    }

    public function update_customer_info(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^0[0-9]{9}$/'],
        ]);

        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();

            $user = User::find($user_id);

            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            // $user->name = $request->name;
            // $user->phone = $request->phone;
            $user->address = $request->address;
            
            $user->save();
            
            toastr()->success('Product added to cart successfully.');
        } else {
            $count = '';
        }

        // 
        // $user = Auth::user();
        // $user_id = $user->id;
        
        return redirect('mypersonal');
    }
    
    public function view_order_detail($orderId) {
        $orders = order_detail::where('order_id', $orderId)->get();
        

        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();
        } else {
            $count = '';
        }

        return view('home.view_order_detail', compact('orders', 'count'));
    }
    

    public function place_order() {
        if (Auth::id()) {
            $user = Auth::user();
            $user_id = $user->id;

            $count = Cart::where('user_id', $user_id)->count();

            $cart = Cart::where('user_id', $user_id)->get();

            $totalOrder = 0;

            foreach ($cart as $carts) {
               $totalOrder += $carts->product->price * $carts->quantity;
            }

        } else {
            $count = '';
            $totalOrder = 'error';
        }

        return view('home.place_order', compact('count', 'totalOrder'));
    }

    // CHUYỂN KHOẢN 
    public function stripe($totalOrder)
    {
        return view('home.stripe', compact('totalOrder'));
    }

    public function stripePost(Request $request, $totalOrder)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalOrder * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from complete" 
        ]);

        // lưu đơn hàng vào DB
        $name = Auth::user()->name;
        $address = Auth::user()->address;
        $phone = Auth::user()->phone; 

        $user_id = Auth::user()->id;

        $carts = Cart::where('user_id', $user_id)->get(); 

            // lƯU THÔNG TIN USER
            $order = new Order;

            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->total_order = $totalOrder;
            $order->user_id = $user_id;
            $order->payment_status = "paid";

            $order->save();

            // lƯU SẢN PHẨM ĐƠN HÀNG 

            foreach ($carts as $cart) {
                $order_detail = new order_detail;
                
                // L
                $order_detail->product_id = $cart->product_id;
                $order_detail->quantity = $cart->quantity;
                $order_detail->user_id = $cart->user_id;
                $order_detail->product_id = $cart->product_id;
                

                // Tìm sản phẩm để lưu thông tin
                $product = Product::find($cart->product_id);

                $order_detail->name = $product->title;
                $order_detail->image = $product->image;
                $order_detail->price = $product->price;

                $totalValue = $cart->quantity * $product->price;
                $order_detail->total_value = $totalValue;
                $order_detail->order_id = $order->id;

                $order_detail->save();

                // Trừ số lượng sản phẩm trong kho
                $product->quantity = $product->quantity - $cart->quantity;
                $product->save();

            }
            

        
        $cart_remove = Cart::where('user_id', $user_id)->get();

        foreach ($cart_remove as $remove) {
            $data = Cart::find($remove->id);

            $data->delete();
        }

        toastr()->success('Payment successful!');
        toastr()->success('Product ordered successfully.');
                      
        return redirect('mycart');
    }

    public function confirm_order(Request $request) {
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone; 
        $totalOrder = $request->totalOrder;

        $user_id = Auth::user()->id;

        $carts = Cart::where('user_id', $user_id)->get(); 

            // lƯU THÔNG TIN USER
            $order = new Order;

            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->total_order = $totalOrder;
            $order->user_id = $user_id;

            $order->save();

            // lƯU SẢN PHẨM ĐƠN HÀNG 

            foreach ($carts as $cart) {
                $order_detail = new order_detail;
                
                // L
                $order_detail->product_id = $cart->product_id;
                $order_detail->quantity = $cart->quantity;
                $order_detail->user_id = $cart->user_id;
                $order_detail->product_id = $cart->product_id;

                // Tìm sản phẩm để lưu thông tin
                $product = Product::find($cart->product_id);

                $order_detail->name = $product->title;
                $order_detail->image = $product->image;
                $order_detail->price = $product->price;

                $totalValue = $cart->quantity * $product->price;
                $order_detail->total_value = $totalValue;
                $order_detail->order_id = $order->id;

                $order_detail->save();

                // Trừ số lượng sản phẩm trong kho
                $product->quantity = $product->quantity - $cart->quantity;
                $product->save();

            }
            

        
        $cart_remove = Cart::where('user_id', $user_id)->get();

        foreach ($cart_remove as $remove) {
            $data = Cart::find($remove->id);

            $data->delete();
        }

        toastr()->success('Product ordered successfully.');
        return redirect('/');

    }
}
