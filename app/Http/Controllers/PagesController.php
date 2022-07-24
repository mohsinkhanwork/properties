<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct()
    {
         check_property_exp(); 
    }
      
    public function get_page($slug)
    {   
    	   
       $page_info = Pages::where('page_slug',$slug)->first();         
       
       return view('pages.pages',compact('page_info'));
        
    } 
}
