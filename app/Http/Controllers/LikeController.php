<?php

namespace App\Http\Controllers;

use App\Like;
use App\Item;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //ログイン時でないとアクションが通らないミドルウェア
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user = \Auth::user();
        $items = $user->likeItems()->latest('likes.created_at')->get();
        
        return view('likes.index', [
            'title' => 'お気に入り一覧',
            'items' => $items,
        ]);
    }
}
