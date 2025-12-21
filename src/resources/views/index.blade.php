@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="index-content">
    <div class="content-head">
        <h1>商品一覧</h1>
        <div>
            <a class="content-head__botton--addition" href="/products/register">+商品を追加</a>
        </div>
    </div>
    <div>
        <form class="content-item" action="">
            <div class="content-item__tag">
                <div class="content-item__search">
                    <input type="text" name="name" placeholder="商品名で検索">
                    <button class="search-submit"  type="submit">検索</button>
                </div>
                <div class="content-item__price">
                    <label for="price">価格順で表示</label>
                    <select name="price" id="price">
                        <option value="" selected disabled>価格で並べ替え</option>
                        <option>高い順に表示</option>
                        <option>低い順に表示</option>
                        <!-- 　ここに選んだら表示されるボタンを作らないといけない。 -->
                    </select>
                </div>
            </div>
            <div class="card-items">
                @foreach ($products as $product)
                <div class="card-item">
                    <img src="{{ asset('images/'. $product->image) }} " alt="{{ $product->name }}" />
                    <div class="card-item__fine">
                        <p>{{ $product->name }}</p>
                        <p>￥{{ $product->price }}</p>
                    </div>
                </div>
                @endforeach
                <div class="pagination">
                    {{ $products->links('vendor.pagination.default') }}
                </div>
            </div> 
        </form>
    </div>

    <div>

    </div>
</div>
@endsection