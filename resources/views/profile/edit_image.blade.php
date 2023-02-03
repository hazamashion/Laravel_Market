@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
    <h1>{{ $title }}</h1>
    <h2>現在の画像</h2>
    <form method="post" action="{{ route('profile.update_image', $user) }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        @if( $user->image !== '')
            <img src="{{ asset('/storage/' . $user->image) }}">
        @else
            画像は設定されていません。
        @endif
        <div>
            画像を選択:
            <input type="file" name="image">
        </div>
        <div class="submit">
            <input type="submit" value="更新">
        </div>
    </form>
@endsection