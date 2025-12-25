@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="index-content">
    <div class="content-head">
        @if (request('name'))
        <h1>"{{ request('name') }}"の商品一覧</h1>
        @else
        <h1>商品一覧</h1>
        @endif
        <div>
            <a class="content-head__botton--addition" href="/products/register">
                +商品を追加
            </a>
        </div>
    </div>
    <div class="content-item">
        <form action="/products" method="GET">
            <div class="content-item__tag">
                <div class="content-item__search">
                    <input type="text" name="name" placeholder="商品名で検索" value="{{ request('name') }}">
                    <button class="search-submit"  type="submit">検索</button>
                </div>
                <div class="content-item__price">
                    <label for="price">価格順で表示</label>
                    <select name="price" id="price">
                        <option value="" selected disabled>価格で並べ替え</option>
                        <option value="high" {{ request('price') == 'high' ? 'selected' : '' }}>
                            高い順に表示
                        </option>
                        <option value="low" {{ request('price') == 'low' ? 'selected' : '' }}>
                            低い順に表示
                        </option>
                    </select>
                </div>
                @if (request('price'))
                <div class="content-item__logo">
                    {{ request('price') === 'high' ? '高い順に表示' : '低い順に表示'}}
                    <a class="content-item__logp--emphasize" href="/products">×</a>
                </div>
                @endif
            </div>
        </form>
        <div class="card-items">
            @foreach ($products as $product)
            <a class="card-items__link" href="/products/detail/{{ $product->id }}">
                <div class="card-item">
                    <img src="{{ asset('images/'. $product->image) }} " alt="{{ $product->name }}" />
                    <div class="card-item__fine">
                        <p>{{ $product->name }}</p>
                        <p>￥{{ $product->price }}</p>
                    </div>
                </div>
            </a>
            @endforeach
            <div class="pagination">
                {{ $products->links('vendor.pagination.default') }}
            </div>
        </div> 
    </div>

</div>
@endsection