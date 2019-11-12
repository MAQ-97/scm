<?php

namespace App\Http\Controllers;

use App\Category;
use App\Color;
use App\Notifications\OrderEmail;
use App\Notifications\OrderrejectedEmail;
use App\Notifications\OrderstatusEmail;
use App\Order;
use App\OrderMeta;
use App\ItemType;
use App\Product;
use App\ProductCategory;
use App\ProductColors;
use App\ProductTypes;
use App\User;
use App\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\OrderProductColor;
use Auth;
use Session;

class OrderController extends Controller
{
    public function index()
    {

        $products = Product::all();


//         dd($products);
        return view('products.products', ['products' => $products]);
    }

    public function add()
    {
        return view('frontend.products.checkout');
    }

    public function create(Request $request)
    {
//
//        dd($request);
        $cart_item = Session::get('cart');
//        dd($cart_item);
        $order = new Order();
        $order->user_id = Auth::user()->id;

        if ($request->input('additional_notes') != "") {
            $notes = $request->input('additional_notes');
        } else {
            $notes = "nothing";
        }
        if ($order->save()) {

            $order_meta = new OrderMeta();
            $data = [
                ['order_id' => $order->id, 'key' => 'shipping', 'value' => $request->input('shipping')],
                ['order_id' => $order->id, 'key' => 'billing', 'value' => $request->input('billing')],
                ['order_id' => $order->id, 'key' => 'additional_notes', 'value' => $notes],
            ];

            if (OrderMeta::insert($data)) {
                foreach ($cart_item as $key => $item) {
                    $order_product_color = new OrderProductColor();
                    $order_product_color->order_id = $order->id;
                    $order_product_color->product_color_id = $key;
                    $order_product_color->quantity = $item['qty'];
//                    $order_product_color->quantity_updated = false;

                    $order_product_color->save();

                }

                $cart = [];
                Session::put('cart', $cart);
                Session::flash('success', 'Your Order Has Placed!');
                $admins = User::role('admin')->get();
                foreach ($admins as $admin) {
                    $admin->notify(new OrderEmail($order));
                }


                if (!Auth::user()->hasRole('distributor')) {

                    $distributors = UserMeta::where('user_id', $order->user_id)->where('key', 'distributor_id')->first();
                    //                dd($distributors->value);
                    $distributors = User::findorfail($distributors->value);

                    $distributors->notify(new OrderEmail($order));
                }

                //-------


                //  foreach ($distributors as $admin)
                //  {
                //  }
                //  $user->notify(new RegisterEmail($request->input('password')));

                return redirect(route('clients'));
            }
        }
    }

    public function get_all_orders()
    {

        $orders = Order::all();
        $client_order = [];
        $logged_user = Auth::user();
        $ids = [];
        $ids[] = $logged_user->id;
        if ($logged_user->hasRole('distributor')) {
            $distributors = UserMeta::where('key', 'distributor_id')->where('value', $logged_user->id)->get();

            foreach ($distributors as $distributor) {
                $ids[] = $distributor->user_id;
            }
        }
        foreach ($orders as $order) {
            $user = User::find($order)->first();
            // dd($user->name);
            $order->user_name = $user->name;
            if (in_array($order->user_id, $ids)) {
                $client_order[] = $order;
            }
        }
        // dd($user->hasRole('admin'));

        if ($logged_user->hasRole('admin')) {
            //  dd($orders);
            return view('order.order')->with('orders', $orders);

        } else {
            //  dd($orders);
            return view('order.order')->with('orders', $client_order);

        }
    }


    public function get_all_clients_order()
    {

        $orders = Order::all();
        $client_order = [];
        $logged_user = Auth::user();
        //$ids = [];
        //$ids[] = $logged_user->id;
        $clients_ids = [];


        if ($logged_user->hasRole('distributor')) {
            $distributors = UserMeta::where('key', 'distributor_id')->where('value', $logged_user->id)->get();

            foreach ($distributors as $distributor) {
                $clients_ids[] = $distributor->user_id;
                //custom_printR($clients_ids);
            }
        }

        //custom_printR($user);
        foreach ($orders as $order) {
            $user = User::find($order)->first();
            // dd($user->name);
            $order->user_name = $user->name;
            if (in_array($order->user_id, $clients_ids)) {
                $client_order[] = $order;
            }
        }

        //custom_printR($client_order);
        return view('distributor.clients_order')->with('orders', $client_order);


    }


    public function get_all_distributor_orders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        $client_order = [];
        $logged_user = Auth::user();
        $ids = [];
        $ids[] = $logged_user->id;
        if ($logged_user->hasRole('distributor')) {
            $distributors = UserMeta::where('key', 'distributor_id')->where('value', $logged_user->id)->get();

            foreach ($distributors as $distributor) {
                $ids[] = $distributor->user_id;
            }
        }
        foreach ($orders as $order) {
            $user = User::find($order)->first();
//                dd($user->name);
            $order->user_name = $user->name;
            if (in_array($order->user_id, $ids)) {
                $client_order[] = $order;
            }
        }
        //dd($user->hasRole('admin'));
        if ($logged_user->hasRole('distributor')) {
            //dd($orders);
            return view('distributor.distributor_order')->with('orders', $orders);
        }
    }


    public function get_all_balance_orders()
    {

        $orders = Order::where(['status' => 'balance'])->get();
        $client_order = [];
        $logged_user = Auth::user();
        $ids = [];
        $ids[] = $logged_user->id;
        //$clients_ids = [];

        if ($logged_user->hasRole('distributor')) {
            $distributors = UserMeta::where('key', 'distributor_id')->where('value', $logged_user->id)->get();

            foreach ($distributors as $distributor) {
                $ids[] = $distributor->user_id;
            }
        }
        foreach ($orders as $order) {
            $user = User::find($order)->first();
            // dd($user->name);
            $order->user_name = $user->name;
            if (in_array($order->user_id, $ids)) {
                $client_order[] = $order;
            }
        }

        //dd($user->hasRole('admin'));
        if ($logged_user->hasRole('distributor')) {
            //dd($orders);
            return view('distributor.show_balance_delivery')->with('orders', $client_order);
        }


    }

    public function get_all_completed_orders()
    {

        $orders = Order::where(['status' => 'completed'])->get();
        $client_order = [];
        $logged_user = Auth::user();
        $ids = [];
        $ids[] = $logged_user->id;
        //$clients_ids = [];

        if ($logged_user->hasRole('distributor')) {
            $distributors = UserMeta::where('key', 'distributor_id')->where('value', $logged_user->id)->get();

            foreach ($distributors as $distributor) {
                $ids[] = $distributor->user_id;
            }
        }
        foreach ($orders as $order) {
            $user = User::find($order)->first();
            // dd($user->name);
            $order->user_name = $user->name;
            if (in_array($order->user_id, $ids)) {
                $client_order[] = $order;
            }
        }
        //dd($user->hasRole('admin'));
        if ($logged_user->hasRole('distributor')) {
            //dd($orders);
            return view('distributor.show_completed_delivery')->with('orders', $client_order);
        }
    }


    public function get_order($id)
    {
        $order = Order::find($id);
        $user = User::find($order->user_id);
        $user_phone = UserMeta::where('user_id', $user->id)->where('key', 'phone')->first();
        $user->phone = $user_phone->value;
        $user_city = UserMeta::where('user_id', $user->id)->where('key', 'city')->first();
        $user->city = $user_city->value;

        $client_order = [
            "id" => $order->id,
            "order_no" => $order->order_no,
            "status" => $order->status,
            "created_at" => $order->created_at->format('m-d-Y')
        ];
        $order_metas = OrderMeta::where('order_id', $order->id)->get();
        foreach ($order_metas as $order_meta) {
            $client_order[$order_meta->key] = $order_meta->value;
        }
//            dd($order->id);
        $order_product_colors = OrderProductColor::where('order_id', $order->id)->get();
        $client_order['products'] = [];
        foreach ($order_product_colors as $key => $order_product_color) {
            $product_color = ProductColors::find($order_product_color->product_color_id);
            $product_id = (int)$product_color->product_id;
            $product = Product::find($product_id);
            $client_order['products'][$key]['product_id'] = $product->id;
            $client_order['products'][$key]['product_name'] = $product->name;
            $color = Color::find($product_color->color_id);
            $client_order['products'][$key]['product_color'] = $color->code;
            $client_order['products'][$key]['product_color_id'] = $color->product_color_id;
            $client_order['products'][$key]['order_product_color_id'] = $order_product_color->id;
            $client_order['products'][$key]['qty'] = $order_product_color->quantity;
            $client_order['products'][$key]['qty_approved'] = $order_product_color->quantity_approved_by_distributor;
            $client_order['products'][$key]['qty_pending'] = $order_product_color->quantity_pending;
            $client_order['products'][$key]['qty_delivered'] = $order_product_color->quantity_delivered;
            $client_order['products'][$key]['image'] = $color->image;

        }
//dd($client_order);
        return view('order.vieworder', ['user' => $user, 'order' => $client_order]);

    }

    public function update(Request $request, $id)
    {
        // dd($request);die;
        $order = Order::findorfail($id);
        $old_status = $order->status;
        $old_quantities = OrderProductColor::where('order_id', $order->id)->get();
        // dd($old_quantities);


        if (Auth::user()->getRoleNames()[0] == 'admin') {

            $order->status = $request->status;
            $order->order_no = $request->order_no;
            $qty_pending = $request->qty_pending;
            $qty_delivered = $request->qty_delivered;
            $actual_qty = $request->actual_qty;

            $order_product_color_ids = $request->order_product_color_id;
            $qty_approved_distributor = $request->qty_approved_distributor;
            $colors = $request->color;

            if ($qty_pending <= $qty_approved_distributor  && $qty_delivered <= $qty_approved_distributor ) {

                foreach ($order_product_color_ids as $key => $order_product_color_id) {
                    $order_product_color = OrderProductColor::find($order_product_color_id);
                    $order_product_color->product_color_id = $colors[$key];
                    $order_product_color->quantity_approved_by_distributor = $qty_approved_distributor[$key];

                    if (Auth::user()->getRoleNames()[0] == 'admin') {
                        $order_product_color->quantity_pending = $qty_pending[$key];
                        $order_product_color->quantity_delivered = $qty_delivered[$key];
                        $order_product_color->quantity_completed = $key;
                    }
                    $order_product_color->save();

                    //$product_color = ProductColors::find($order_product_color->product_color_id);
                    //$qty = $order_product_color->quantity_delivered;
                    //  //  dd($qty);
                    //if ($request->status == 'approved' || $request->status == 'balance') {
                    //   //  dd($old_quantities[$key]->qty_delivered);
                    //$product_color->quantity_in_hand = $product_color->quantity_in_hand + $old_quantities[$key]->quantity_delivered;
                    //$product_color->quantity_in_hand = $product_color->quantity_in_hand - $qty;
                    //$product_color->save();
                    //  // $order_product_color->quantity_updated = true;
                    //$order->status = $request->status;
                    //}
                }


                $order->save();

                if ($old_status != $order->status) {

                    $user = Auth::user();
                    if ($user->hasRole('admin') && $order->status == 'declined') {
                        //  dd()
                        $user_id = $order->user_id;
                        $user = User::findorfail($user_id);
                        $user->notify(new OrderrejectedEmail($order));
                    } elseif ($user->hasRole('distributed') && $old_status == 'declined') {
                        $admins = User::role('admin')->get();
                        foreach ($admins as $admin) {
                            $admin->notify(new OrderstatusEmail($order));
                        }
                    }
                }
                return redirect()->route('order.list');

            } else {
                return Redirect::back()->with('error', 'Pending quantity & Delivered quantity should not be greater than Approved quantity by distributor');
            }

        } elseif (Auth::user()->getRoleNames()[0] == 'distributor') {

            $order->status = 'processing';
            $order->order_no = $request->order_no;
            $actual_qty = $request->actual_qty;

            $order_product_color_ids = $request->order_product_color_id;
            $qty_approved_distributor = $request->qty_approved_distributor;
            $colors = $request->color;

            if ($qty_approved_distributor <= $actual_qty) {

                foreach ($order_product_color_ids as $key => $order_product_color_id) {
                    $order_product_color = OrderProductColor::find($order_product_color_id);
                    $order_product_color->product_color_id = $colors[$key];
                    $order_product_color->quantity_approved_by_distributor = $qty_approved_distributor[$key];

                    if (Auth::user()->getRoleNames()[0] == 'distributor') {
                        $order_product_color->quantity_pending = $key;
                        $order_product_color->quantity_delivered = $key;
                        $order_product_color->quantity_completed = $key;
                    }
                    $order_product_color->save();

                }
                $order->save();

                return Redirect::back()->with('msg', 'Approved quantity has been assigned');

            } else {
                return Redirect::back()->with('error', 'Your approved quantity should not be greater than given quantity');
            }

        } else {
            return Redirect::back()->with('error', 'You cannot update order');
        }

    }

    public function getColor($product_id)
    {
        $product_Colors = ProductColors::where('product_id', $product_id)->get();
        foreach ($product_Colors as $product_Color) {
            $color = Color::find($product_Color->color_id);
            $product_Color->color_name = $color->name;
            $product_Color->color_code = $color->code;
        }
        return response()->json($product_Colors);
    }

}
