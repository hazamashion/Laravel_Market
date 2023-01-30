<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    public function create(){
        $categories = Category::all();
        return view('items.create', [
            'title' => '新規出品',
            'categories' => $categories,
        ]);
    }
    
    public function store(ItemRequest $request){
        $user = \Auth::user();
        //画像投稿処理
        $path = '';
        $image = $request->file('image');
        if( isset($image) === true ){
            //publicディスク(storage/app/public/)のphotosディレクトリに保存
            $path = $image->store('photos', 'public');
        }
        Item::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'image' => $path,//ファイルパスを保存
        ]);
        session()->flash('success', '投稿を追加しました');
        return redirect()->route('items.show', $user);
    }
    
    public function edit(){
        return view('items.edit', [
            'title' => '商品情報編集',
        ]);
    }
    
    public function editImage(){
        return view('items.edit_image', [
            'title' => '商品画像変更',
        ]);
    }
    
    public function show(){
        return view('items.show', [
            'title' => '商品詳細',
        ]);
    }
    
    public function confirm(){
        return view('items.confirm', [
            'title' => '購入確認',
        ]);
    }
    
    public function finish(){
        return view('items.finish', [
            'title' => '購入確定',
        ]);
    }
}
