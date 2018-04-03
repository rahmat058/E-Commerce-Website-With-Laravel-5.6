<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Cart;
use Session;
use DB;

Session_start();

class CheckoutController extends Controller
{
    public function login_check()
    {
      return view('pages.login');
    }

    public function customer_registration(Request $request)
    {
       $data = array();
       $data['customer_name']  = $request->customer_name;
       $data['customer_email'] = $request->customer_email;
       $data['password']       = md5($request->password);
       $data['mobile_number']  = $request->mobile_number;


       $customer_id = DB::table('tbl_customer')
                         -> insertGetId($data);


        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);

        return Redirect::to('/checkout');
    }


    public function checkout()
    {
      return view('pages.checkout');
    }

    public function save_shipping_details(Request $request)
    {

         $data = array();
         $data['shipping_email']          = $request->shipping_email;
         $data['shipping_first_name']     = $request->shipping_first_name;
         $data['shipping_last_name']      = $request->shipping_last_name;
         $data['shipping_address']        = $request->shipping_address;
         $data['shipping_mobile_number']  = $request->shipping_mobile_number;
         $data['shipping_city']           = $request->shipping_city;

         $shipping_id = DB::table('tbl_shipping')
                           -> insertGetId($data);


         Session::put('shipping_id', $shipping_id);

         return Redirect::to('/payment');
    }


    public function payment()
    {
      return view('pages.payment');
    }

    public function order_place(Request $request)
    {
      $payment_gateway = $request->payment_method;

      $payment_data = array();
      $payment_data['payment_method'] = $payment_gateway;
      $payment_data['payment_status']  = 'pending';

      $payment_id  = DB::table('tbl_payment')
                        -> insertGetId($payment_data);


      $order_data = array();
      $order_data['customer_id']   = Session::get('customer_id');
      $order_data['shipping_id']   = Session::get('shipping_id');
      $order_data['payment_id']    = $payment_id;
      $order_data['order_total']   = Cart::total();
      $order_data['order_status']  = 'pending';

      $order_id = DB::table('tbl_order')
                       -> insertGetId($order_data);

      $contents = Cart::content();

      $order_details_data = array();

      foreach ($contents as  $allContent)
      {
           $order_details_data['order_id']               = $order_id;
           $order_details_data['product_id']             = $allContent->id;
           $order_details_data['product_name']           = $allContent->name;
           $order_details_data['product_price']          = $allContent->price;
           $order_details_data['product_sales_quantity'] = $allContent->qty;


           DB::table('tbl_order_details')
               -> insert($order_details_data);
      }


      if($payment_gateway === 'handcash')
      {
           Cart::destroy();
           return view('pages.handcash');
      }
      elseif($payment_gateway === 'paypal')
      {
          Cart::destroy();
          return view('pages.paypal');
      }
      elseif($payment_gateway === 'bkash')
      {
          Cart::destroy();
          return view('pages.bkash');
      }
      elseif($payment_gateway === 'payza')
      {
          Cart::destroy();
          return view('pages.payza');
      }
      else
      {
          Cart::destroy();
          return view('pages.ezcash');
      }

    }



    public function customer_login(Request $request)
    {
      $customer_email = $request->customer_email;
      $customer_pass  = md5($request->password);

      $result = DB::table('tbl_customer')
                  -> where('customer_email', $customer_email)
                  -> where('password', $customer_pass)
                  -> first();

          if ($result) {
             Session::put('customer_id', $result->customer_id);
             return Redirect::to('/checkout');
          }else{
            return Redirect::to('/login-check');
          }
    }

    public function customer_logout()
    {
      Session::flush();
      return Redirect::to('/');
    }



    public function manage_order()
    {
      $all_order_info = DB::table('tbl_order')
      -> join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
      -> select('tbl_order.*', 'tbl_customer.customer_name')
      -> get();

      $manage_order =  view('admin.manage_order')
                           -> with('all_order_info', $all_order_info);

      return view('admin_layout')
              -> with('admin.manage_order', $manage_order);
    }
}
