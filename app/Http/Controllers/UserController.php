<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(){
        return view('users.show', [
            'title' => 'プロフィール詳細',
        ]);
    }
    
    public function exhibitions(){
        $user = \Auth::user();
        $user_id = $user->id;
        $items = Item::where('user_id', $user_id)->latest()->get();
        // dd($items);
        return view('users.exhibitions', [
            'title' => '出品商品一覧',
            'user' => $user,
            'items' => $items,
        ]);
    }
}
