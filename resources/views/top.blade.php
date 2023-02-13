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
                                        <img loading='lazy' src="{{ asset('/storage/' . $item->image) }}">
                                    </a>
                                </div>
                                <div class="body_main_top_description">
                                    {{ $item->description }}
                                </div>
                            </div>

                            <div class="body_main_content">
                                商品名:{{ $item->name }} {{ $item->price }}
                                {{ $item->soldItem() ? '売り切れ' : '出品中' }}
                                <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' : '☆' }}</a>
                                <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
                                    @csrf
                                    @method('patch')
                                </form>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      /* global $ */
      $('.like_button').each(function(){
        $(this).on('click', function(){
          $(this).next().submit();
        });
      });
    </script>
@endsection