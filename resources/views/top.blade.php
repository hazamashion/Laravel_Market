@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
    <h1>{{ $title }}</h1>
    <p>息をするように買おう</p>
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
                                商品名:{{ $item->name }}
                                カテゴリ:
                                ({{ $item->created_at }})
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