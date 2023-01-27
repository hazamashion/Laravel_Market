<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(){
        return view('users.show', [
            'title' => 'プロフィール詳細',
        ]);
    }
    
    public function exhibitions(){
        return view('users.exhibitions', [
            'title' => '出品商品一覧',
        ]);
    }
}
