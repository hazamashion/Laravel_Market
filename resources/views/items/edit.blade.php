@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
    <h1>商品情報の編集</h1>
    <h2>商品追加フォーム</h2>
    <form method="post" action="{{ route('items.update', $item) }}">
        @csrf
        @method('patch')
        <div>
            <label>
                <p>商品名:</p>
                <input type="text" name="name" value="{{ $item->name }}">
            </label>
            <label>
                <p>商品説明:</p>
                <textarea name="description" cols="40" rows="10">{{ $item->description }}</textarea>
            </label>
            <label>
                <p>価格:</p>
                <input type="number" name="price" value="{{ $item->price }}">
            </label>
            <label>
                <p>カテゴリー:</p>
                <select name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </label>
            <div class="submit">
                <input type="submit" value="出品">    
            </div>
        </div>
    </form>
@endsection