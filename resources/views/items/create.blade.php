@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
    <h1>商品を出品</h1>
    <h2>商品追加フォーム</h2>
    <form method="post" action="{{ route('items.store') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <div>
                <label>
                    <p>商品名:</p>
                    <input type="text" name="name">
                </label>
                <label>
                    <p>商品説明:</p>
                    <textarea name="description" cols="40" rows="10"></textarea>
                </label>
                <lavel>
                    <p>価格:</p>
                    <input type="number" name="price">
                </lavel>
                <label>
                    <p>カテゴリー:</p>
                    <select name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </label>
                <label>
                    <p>画像を選択:</p>
                    <input type="file" name="image">
                </label>
            </div>
            <input type="submit" value="投稿">
        </div>
    </form>
@endsection