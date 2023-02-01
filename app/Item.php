<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'category_id', 'price', 'image'];
    
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
}
