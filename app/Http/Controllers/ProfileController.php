<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(){
        return view('profile.edit', [
            'title' => 'プロフィール編集',
        ]);
    }
    
    public function editImage(){
        return view('profile.edit_image', [
            'title' => 'プロフィール画像編集',
        ]);
    }
}
