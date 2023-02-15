@extends('layouts.logged_in')

@section('content')
	
	<div class="container">
	
	    <h1>{{ $title }}</h1>
	    <a href="{{ route('items.create') }}">新規追加</a>
	
		<table class="item_table">
			<thead>
				<tr>
					<th>名前</th>
					<th>金額</th>
					<th>説明</th>
					<th>画像</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
			    @forelse($items as $item)
				<tr>
					<td>{{ $item->name }}</td>
					<td>{{ $item->price }}</td>
					<td>{{ $item->description }}</td>
					<td>
					    @if($item->image !== '')
	                        <img class="admin_image" src="{{ secure_asset('storage/' . $item->image) }}">
	                    @else
	                        <img src="{{ secure_asset('images/no_image.png') }}">
	                    @endif
					<td>
					    <a href="{{ route('items.edit', $item) }}">
	                      編集
	                    </a>
						<form method="POST" action="{{ route('items.destroy', $item) }}">
							@csrf
	            			@method('delete')
	                        <input type="submit" value="削除" >
	                    </form>
					</td>
				</tr>
				@empty
	                <p>商品はありません。</p>
				@endforelse
			</tbody>
		</table>
	</div>
@endsection