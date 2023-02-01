<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemEditRequest;
use App\Http\Requests\ItemEditImageRequest;

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
    
    public function edit($id){
        $item = Item::find($id);
        $categories = Category::all();
        
        return view('items.edit', [
            'title' => '商品情報編集',
            'item' => $item,
            'categories' => $categories,
        ]);
    }
    
    public function update($id, ItemEditRequest $request){
        $item = Item::find($id);
        $item->update($request->only(['name', 'destroy', 'price', 'category_id']));
        
        session()->flash('success', '商品を編集しました。');
        return redirect()->route('items.show', $item);
    }
    
    public function editImage($id){
        $item = Item::find($id);
        
        return view('items.edit_image', [
            'title' => '商品画像変更',
            'item' => $item,
        ]);
    }
    
    public function updateImage($id, ItemEditImageRequest $request){
        $item = Item::find($id);
        //画像投稿処理
        $path = '';
        $image = $request->file('image');
        
        //publicディスク(storage/app/public/)のphotosディレクトリに保存
        $path = $image->store('photos', 'public');
        
        //変更前の画像の削除
        \Storage::disk('public')->delete(\Storage::url($item->image));
        
        //ファイルパスをテーブルに保存
        $item->update([
            'image' => $path,
        ]);
        
        session()->flash('success', '商品を編集しました。');
        return redirect()->route('items.show', $item);        
    }
    
    public function destroy($id){
        $user = \Auth::user();
        $item = Item::find($id);
        
        //画像の削除
        \Storage::disk('public')->delete($item->image);
        
        //レコードの削除
        $item->delete();
        
        session()->flash('success', '削除しました');
        return redirect()->route('users.exhibitions', $user);
    }
    
    public function show($id){
        $item = Item::find($id);
        $category = Category::find($item->category_id);
        
        return view('items.show', [
            'title' => '商品詳細',
            'item' => $item,
            'category' => $category,
        ]);
    }
    
    public function confirm($id){
        $item = Item::find($id);
        
        $sold = Order::where('item_id', $item->id)->exists();
        // dd($sold);
        return view('items.confirm', [
            'title' => '購入確認',
            'item' => $item,
            'sold' => $sold,
        ]);
    }
    
    public function finish(){
        //ここでOrder::createで売れた商品,購入者をレコードに追加
        return view('items.finish', [
            'title' => '購入確定',
        ]);
    }
}
