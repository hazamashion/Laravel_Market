@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
    <h1>プロフィール</h1>
    <div>
        @if($user->image !== '' )
            <img src="{{ asset('/storage/' . $user->image) }}">
        @else
            プロフィール画像は設定されていません。
        @endif
        <a href="{{ route('profile.edit_image', $user) }}">画像を変更</a>
    </div>
    <div>
        {{ $user->name }}さん
        <a href="{{ route('profile.edit', $user) }}">プロフィール編集</a>
    </div>
    <div>
        出品数:{{ $count }}
    </div>
    <h2>購入履歴</h2>
    <ul>
        @forelse($purchased_items as $purchased_item)
            <li>
                <a href="{{ route('items.show', $purchased_item) }}">
                    {{ $purchased_item->name }}
                </a>
                : {{$purchased_item->price }} 出品者 {{ $purchased_item->user_id }}
            </li>
        @empty
            購入した商品はありません。
        @endforelse
    </ul>

@endsection