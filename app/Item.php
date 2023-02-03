<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'category_id', 'price', 'image'];
    
    //商品のカテゴリー名表示用
    public function category(){
        return $this->belongsTo('App\Category');
    }
    
    public function purchasedUser(){
        return $this->belongsToMany('App\User', 'orders');
    }
    
    // public function sold(){
    //     return $this->hasOne('App\Order');
    // }
    
    public function soldItem(){
        //Ordersテーブルに商品のidが存在するならtrue、つまり売り切れ
        $result = Order::where('item_id', $this->id)->exists();
        return $result;
    }
    
    public function likedUsers(){
        return $this->belongsToMany('App\User', 'likes');
    }
    
    public function isLikedBy($user){
        $liked_users_ids = $this->likedUsers->pluck('id');
        $result = $liked_users_ids->contains($user->id);
        //いいねされていればtrue, されていなければfalseが代入される。
        return $result;
    }
    //likesテーブルとリレーション(いいねしているユーザーを取得する用)
    public function likes(){
        return $this->hasMany('App\Like');
    }
    //出品者を取得する用
    public function user(){
        return $this->belongsTo('App\User');
    }
}
