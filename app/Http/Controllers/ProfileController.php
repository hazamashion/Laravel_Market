<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileEditRequest;
use App\Http\Requests\ProfileEditImageRequest;

class ProfileController extends Controller
{
    //ログイン時でないとアクションが通らないミドルウェア
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit(){
        $user = \Auth::user();
        return view('profile.edit', [
            'title' => 'プロフィール編集',
            'user' => $user,
        ]);
    }
    
    public function update($id, ProfileEditRequest $request){
        $user = User::find($id);
        
        $user->update($request->only(['name', 'profile']));
        
        session()->flash('success', 'プロフィールを編集しました。');
        return redirect()->route('users.show', $user);
    }
        
    
    public function editImage(){
        $user = \Auth::user();
        return view('profile.edit_image', [
            'title' => 'プロフィール画像編集',
            'user' => $user,
        ]);
    }
    
    public function updateImage($id, ProfileEditImageRequest $request){
        $user = User::find($id);
        $path = '';
        $image = $request->file('image');
        
        //publicディスク(storage/app/public/)のphotosディレクトリに保存
        $path = $image->store('photos', 'public');
        
        //変更前の画像の削除
        \Storage::disk('public')->delete(\Storage::url($user->image));
        
        $user->update([
            'image' => $path,
        ]);
        
        session()->flash('success', '画像を編集しました。');
        return redirect()->route('users.show', $user);
    }
}
