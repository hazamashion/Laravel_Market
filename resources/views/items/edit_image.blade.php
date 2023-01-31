@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
    <h1>商品画像の変更</h1>
    <h2>現在の画像</h2>
    <div>
        <img src="{{ asset('/storage/' . $item->image) }}">
        <form method="post" action="{{ route('items.edit_image', $item) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <label>
                画像を選択
                <input type="file" name="image">
            </label>
            <div>
                <input type="submit" value="更新">
            </div>
        </form>
    </div>
@endsection