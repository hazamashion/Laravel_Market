<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index(){
        
        if (\Auth::check()) {
            $user_id = \Auth::user()->id;
            $items = Item::where('user_id', '!=', $user_id)->get();
        } else {
            return view('auth.register');
        }
    
        return view('top', [
            'title' => 'Market',
            'items' => $items,
        ]);
    }
}