<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'category_id', 'price', 'image'];
    
    public function soldItems(){
        return $this->belongsToMany('App\User', 'orders');
    }
}
