@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
    <h1>{{ $title }}</h1>
    <form method="post" action="{{ route('profile.update', $user) }}">
        @csrf
        @method('patch')
        <label>
            <p>名前:</p>
            <input type="text" name="name" value="{{ $user->name }}">
        </label>
        <label>
            <p>プロフィール:</p>
            <textarea name="profile" cols="50" rows="8">{{ $user->profile }}</textarea>
        </label>
        <div class="submit">
            <input type="submit" value="更新">
        </div>
    </form>
@endsection