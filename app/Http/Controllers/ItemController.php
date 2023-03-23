<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Order;
use App\Like;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemEditRequest;
use App\Http\Requests\ItemEditImageRequest;
use Intervention\Image\Facades\Image;

class ItemController extends Controller
{
    //ログイン時でないとアクションが通らないミドルウェア
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(){
        $categories = Category::all();
        return view('items.create', [
            'title' => '新規出品',
            'categories' => $categories,
        ]);
    }
    
    public function store(ItemRequest $request){
        $user = \Auth::user();
        $category_id = $request->category_id;
        //存在しないカテゴリーを防ぐ
        if( Category::find($category_id) !== null ){
            // 画像投稿処理
            $image = $request->file('image');
            $resizedFilePath = null; // 初期化
            
            if (isset($image)) {
                $filename = $image->hashName();
                //Intervention Imageライブラリを使用して画像を読み込むためのコード
                $img = Image::make($image);
                //最大幅・最大高さが320pxに収まるようにリサイズ
                $img->resize(320, 320, function ($constraint) {
                    //画像のアスペクト比を保持しながらリサイズ
                    $constraint->aspectRatio();
                    //元の画像よりも大きくならないようにする
                    $constraint->upsize();
                });
            
                // リサイズされた画像のファイルパスを保存する
                $resizedFilename = 'resized-' . $filename;
                $img->save(storage_path('app/public/photos/' . $resizedFilename));
                $resizedFilePath = 'photos/' . $resizedFilename;
            }
    
            $item = Item::create([
                'user_id' => \Auth::user()->id,
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'image' => $resizedFilePath,
            ]);
    
            session()->flash('success', '商品を追加しました');
            return redirect()->route('items.show', $item);
        } else {
            session()->flash('error', '存在しないカテゴリーです。');
            return redirect()->route('items.create');
        }
    }
    
    public function edit($id){
        $item = Item::find($id);
        
        if($item->user_id !== \Auth::user()->id){
            session()->flash('error','不正な操作です。');
            return redirect('/');
        }
        
        $categories = Category::all();
        
        return view('items.edit', [
            'title' => '商品情報編集',
            'item' => $item,
            'categories' => $categories,
        ]);
    }
    
    public function update($id, ItemEditRequest $request){
        
        $item = Item::find($id);
        
        if($item->user_id !== \Auth::user()->id){
            session()->flash('error','不正な操作です。');
            return redirect('/');
        }
        
        $category_id = $request->category_id;
        
        if( Category::find($category_id) !== null ){
            $item->update($request->only(['name', 'description', 'price', 'category_id']));
            session()->flash('success', '商品を編集しました。');
            return redirect()->route('items.show', $item);    
        } else {
            session()->flash('error', '存在しないカテゴリーです。');
            return redirect()->route('items.show', $item);
        }
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
        if( Item::find($id) !== null ){
            $item = Item::find($id);
            $category = Category::find($item->category_id);
            
            return view('items.show', [
                'title' => '商品詳細',
                'item' => $item,
                'category' => $category,
            ]);            
        } else {
            session()->flash('error', 'その商品はありません。');
            return redirect()->route('top');
        }
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
    
    public function storeOrder($id, Request $request){
        $item = Item::find($id);
        
        if( $item->soldItem() === false ){
        Order::create([
            'user_id' => \Auth::user()->id,
            'item_id' => $item->id,
        ]);
        
        session()->flash('success', '購入が完了しました。');
        return redirect()->route('items.finish', $item);
        
        } else {
            session()->flash('error', '申し訳ありません。ちょっと前に売り切れました。');
            return redirect()->route('items.show', $item);
        }
    }
    
    public function finish($id){
        $item = Item::find($id);
        return view('items.finish', [
            'title' => '購入確定',
            'item' => $item,
        ]);
    }
    
    public function toggleLike($id){
        $user = \Auth::user();
        $item = Item::find($id);
        
        if($item->isLikedBy($user)){
            //いいねの取り消し
            $item->likes->where('user_id', $user->id)->first()->delete();
            \Session::flash('success', 'お気に入りを取り消しました。');
        } else {
            //いいねを設定
            Like::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);
            \Session::flash('success', 'お気に入りに追加しました。');
        }
        //トップページにリダイレクト
        return redirect('/');
    }
}
