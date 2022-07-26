<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User; 
use App\Models\Transactions;
use App\Models\SubscriptionPlan;
use App\Models\Properties;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Input;

use Paystack;

class PaystackController extends Controller
{
     /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {   
        $data =  \Request::except(array('_token'));
        
        $inputs = $request->all();
        
         
        $user_email=Auth::user()->email;
        $amount=$inputs['amount']*100; 

         

        //Paystack::genTranxRef();
         
        //exit;

        $result = array();
        //Set other parameters as keys in the $postdata array
        $postdata =  array('email' => $user_email, 'amount' => $amount);

        $fields_string = http_build_query($postdata);

        $url = "https://api.paystack.co/transaction/initialize";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = [
          'Authorization: Bearer '.getcong('paystack_secret_key'),
          'Cache-Control: no-cache',

        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $request = curl_exec ($ch);

        curl_close ($ch);

        if ($request) {
          $result = json_decode($request, true);
          
          //print_r($result);
          //exit;

          //echo $result['data']['authorization_url'];
          //exit;
          return redirect($result['data']['authorization_url']);
        }
        else
        {
            \Session::put('success','Payment failed');
            return redirect('my_properties');
        }  
        //return Paystack::getAuthorizationUrl()->redirectNow();
 
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {   

        $reference_id=$_GET['reference'];
        $trxref_id=$_GET['reference'];

        $result = array();
        //The parameter after verify/ is the transaction reference to be verified
        $url = 'https://api.paystack.co/transaction/verify/'.$reference_id;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt(
          $ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '.getcong('paystack_secret_key')]
        );
        $request = curl_exec($ch);
        curl_close($ch);

        if ($request) {
          $result = json_decode($request, true);
        }
        
        //dd($result);
        //exit;
          
        if ($result['status']==true && $result['data']['status'] == 'success') {
            
        $plan_id = Session::get('plan_id');

        $plan_info = SubscriptionPlan::where('id',$plan_id)->where('status','1')->first();
        $plan_name=$plan_info->plan_name;
        $plan_days=$plan_info->plan_days;
        $plan_amount=$plan_info->plan_price;

        $tax_amount=($plan_amount*getcong('tax_percentage'))/100;
        $total_amount=$plan_amount+$tax_amount;
        
          
        $user_id=Auth::user()->id;           
        $user = User::findOrFail($user_id);
 

        $payment_property_id = Session::get('payment_property_id');
        $property_obj = Properties::findOrFail($payment_property_id);

        $property_obj->active_plan_id = $plan_id;
        $property_obj->property_exp_date = strtotime(date('m/d/Y', strtotime("+$plan_days days")));
        $property_obj->status = 1;
        $property_obj->save();

         
        $payment_trans = new Transactions;

        $payment_trans->property_id = $payment_property_id;
        $payment_trans->user_id = Auth::user()->id;
        $payment_trans->email = $user->email;
        $payment_trans->plan_id = $plan_id;
        $payment_trans->gateway = 'Paystack';
        $payment_trans->payment_amount = $plan_amount;
        $payment_trans->tax_amount = $tax_amount;
        $payment_trans->total_payment_amount = $total_amount;
        $payment_trans->payment_id = $trxref_id;
        $payment_trans->date = strtotime(date('m/d/Y H:i:s'));
        
        $payment_trans->save();

        Session::forget('payment_property_id');
        Session::forget('plan_id');
        Session::forget('plan_name');
        Session::forget('plan_price');
        Session::forget('plan_days');
        
         //Subscription Payment Email
        $user_full_name=$user->name;

        $data_email = array(
            'name' => $user_full_name
             );    
        
        if(getenv("MAIL_USERNAME"))
        {
            \Mail::send('emails.payment_success', $data_email, function($message) use ($user,$user_full_name){
                $message->to($user->email, $user_full_name)
                    ->from(getcong('site_email'), getcong('site_name')) 
                    ->subject(trans('words.property_payment_done'));
            });
        }


        \Session::flash('success',trans('words.payment_success'));
         return redirect('my_properties');  
 
            
            //Perform necessary action
        }else{
           \Session::flash('error_flash_message',trans('words.payment_failed'));
            return redirect('my_properties');
        }
    }
}
