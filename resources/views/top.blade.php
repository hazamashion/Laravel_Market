@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <p>息をするように買おう</p>
  <a href="{{ route('items.create') }}">新規出品</a>
@endsection