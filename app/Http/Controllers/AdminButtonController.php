<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminButtonController extends Controller
{
    public function gotoProductTable(){
        return view('admin.productTable');
    }
}
