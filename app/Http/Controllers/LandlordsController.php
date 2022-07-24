<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Properties;

use Illuminate\Http\Request;

class LandlordsController extends Controller
{
    public function __construct()
    {
         check_property_exp(); 
    } 
  public function index(){
    $landlord = User::where('usertype', 'Landlord')->orderBy('id', 'desc')->paginate(getconfig('pagination_limit'));
    return view('pages.landlords', compact('landlord'));
  }

  public function landlord_details($id){
    $landlord = User::findOrFail($id);
    $properties = Properties::where(['status'=>'1', 'user_id'=>$id])->orderBy('id', 'desc')->paginate(getconfig('pagination_limit'));
    return view('pages.landlord_details', compact('landlord', 'properties'));
  }
}
