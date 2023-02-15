<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    public function isAdmin(){
        return $this->role === 'admin';
    }
    
    //作成途中で挫折
}