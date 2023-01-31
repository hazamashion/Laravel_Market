@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
    @if($item->id !== '')
        <h1>{{ $title }}</h1>
        <div>
            <p>商品名</p>
            <p>{{ $item->name }}</p>
        </div>
        <div>
            <p>画像</p>
            <img src="{{ asset('/storage/' . $item->image) }}">
        </div>
        <div>
            <p>カテゴリ</p>
            <p>{{ $category->name }}</p>
        </div>
        <div>
            <p>価格</p>
            <p>{{ $item->price }}</p>
        </div>
        <div>
            <p>説明</p>
            <p>{{ $item->description }}</p>
        </div>
        <form action="{{ route('items.confirm', $item) }}">
            @csrf
            <input type="submit" value="購入する">
        </form>
    @else
        <p>その商品はありません。</p>
    @endif
@endsection