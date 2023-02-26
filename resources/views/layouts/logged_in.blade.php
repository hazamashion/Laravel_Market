@extends('layouts.default')
 
@section('header')
<header>
    <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
        <a href="{{ route('top') }}" class="navbar-brand">
            Market
        </a>
        <form class="form-inline mr-auto">
            <label class="sr-only" for="kw">検索キーワード</label>
            <input type="search" class="form-control form-control-sm mr-2" placeholder="キーワード" id="kw">
            <button type="submit" class="btn btn-primary btn-sm">検索</button>
        </form>
        <ul class="navbar-nav">
            <li class="nav-item">

            </li>
            <li class="nav-item">
                <a href="{{ route('users.show', Auth::user()) }}" class="nav-link text-dark">
                    プロフィール
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('likes.index') }}" class="nav-link text-dark">
                    お気に入り一覧
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.exhibitions', Auth::user()) }}" class="nav-link text-dark">
                    出品商品一覧
                </a>
            </li>
            @if(Auth::user()->email === 'admin@admin.com')
                <li class="nav-item">
                    <a href="{{ route('admin') }}" class="nav-link text-dark">
                        管理画面
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('items.create') }}" class="nav-link text-dark">新規出品</a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-dark btn-sm mt-1 ml-2">ログアウト</button>
                </form>            
            </li>
        </ul>
    </nav>
</header>
@endsection