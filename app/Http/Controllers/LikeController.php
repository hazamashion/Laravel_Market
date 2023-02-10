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
        $item_ids = Like::where('user_id', $user->id)->latest('created_at')->pluck('item_id');
        $items = Item::find($item_ids);
        
        return view('likes.index', [
            'title' => 'お気に入り一覧',
            'items' => $items,
        ]);
    }
}
