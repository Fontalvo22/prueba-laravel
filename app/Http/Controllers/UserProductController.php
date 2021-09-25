<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserProductController extends Controller
{
    function index(){
        
        $products=User::getUsersWithProducts();
        
        return view('products.index', ['products'=>$products]);
    }
}
