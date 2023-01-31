<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id){
        $user = User::find($id);
        $count = $user->items()->count();
        $purchased_items = $user->purchasedItems()->get();
        return view('users.show', [
            'title' => 'プロフィール詳細',
            'user' => $user,
            'count' => $count,
            'purchased_items' => $purchased_items,
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
