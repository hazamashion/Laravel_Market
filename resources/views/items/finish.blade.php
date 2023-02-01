@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
    <h1>ご購入ありがとうございました。</h1>
    <div>
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
            <p>{{ $item->category->name }}</p>
        </div>
        <div>
            <p>価格</p>
            <p>{{ $item->price }}</p>
        </div>
        <div>
            <p>説明</p>
            <p>{{ $item->description }}</p>
        </div>
        <a href="{{ route('top') }}">トップに戻る</a>
    </div>
@endsection