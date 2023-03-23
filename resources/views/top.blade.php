@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <div class="container">
        <div class="row mt-3">
            @forelse($items as $item)
                <div class="item col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card">
                        <a href="{{ route('items.show', $item->id) }}">
                            <div class="ratio ratio-1x1">
                            <div class="bg-image" style="background-image:url('{{ Storage::url($item->image) }}');"></div>
                            </div>
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">{{ $item->description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">{{ $item->created_at }}</span>
                                <span class="badge {{ $item->soldItem() ? 'badge-danger' : 'badge-success' }}">
                                    {{ $item->soldItem() ? '売り切れ' : '出品中' }}
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                            <span class="badge badge-primary">{{ $item->price }}円</span>
                            <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
                                @csrf
                                @method('patch')
                                <button type="submit" class="btn btn-sm {{ $item->isLikedBy(Auth::user()) ? 'btn-warning' : 'btn-outline-warning' }}">
                                    {{ $item->isLikedBy(Auth::user()) ? '★' : '☆' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">商品はありません。</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection