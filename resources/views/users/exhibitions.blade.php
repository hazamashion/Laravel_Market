@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
    <h1>{{ $user->name }}の出品商品一覧</h1>
    <a href="{{ route('items.create') }}">新規出品</a>
    <ul class="items">
        @forelse($items as $item)
            <li class="item">
                <div class="content">
                    <div class="body">
                        <div class="body_heading">
                        </div>
                        <div class="body_main">
                            <div class="body_main_top">
                                <div class="body_main_top_img">
                                    <a href="{{ route('items.show', $item->id) }}">
                                        <img src="{{ asset('/storage/' . $item->image) }}">
                                    </a>
                                </div>
                                <div class="body_main_top_description">
                                    {{ $item->description }}
                                </div>
                            </div>

                            <div class="body_main_content">
                                商品名:{{ $item->name }} {{ $item->price }}
                                {{ $item->soldItem() ? '売り切れ' : '出品中' }}
                                カテゴリ:{{ $item->category->name }}
                                ({{ $item->created_at }})
                                <div class="body_main_content_link">
                                    [<a href="{{ route('items.edit', $item) }}">編集</a>]
                                    [<a href="{{ route('items.edit_image', $item) }}">画像の変更</a>]
                                </div>
                                <div class="delete">
                                    <form method="post" action="{{ route('items.destroy', $item) }}">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="削除">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="body_footer">
                            
                        </div>
                    </div>
                </div>
            </li>
        @empty
          <li>商品はありません。</li>
        @endforelse
    </ul>
@endsection