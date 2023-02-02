<?php

namespace App\Http\Controllers;

use App\Like;
use App\Item;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index(){
        $user = \Auth::user();
        $items_id = Like::where('user_id', $user->id)->pluck('item_id');
        
        return view('likes.index', [
            'title' => 'お気に入り一覧',
            'items' => Item::find($items_id),
        ]);
    }
    
    //ログイン時でないとアクションが通らないミドルウェア
    public function __construct()
    {
        $this->middleware('auth');
    }
}
