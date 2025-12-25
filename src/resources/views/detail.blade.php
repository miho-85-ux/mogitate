@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail-content">
    <div class="detail-content__inner">
        <div>
            <a class="detail-content__log" href="/products">商品一覧</a> > {{ $product->name }}
        </div>
        <div>
            <form action="/products/{{ $product->id }}/update" method="POST">
                @method('PATCH')
                @csrf
                <input type="hidden" name="key" value="{{ $product->id }}">
                <div class="content-items">
                    <div class="content-item__left">
                        <img src="{{ asset('images/'. $product->image) }} " alt="{{ $product->name }}">
                        <input type="file">
                    </div>
                    <div class="content-item__right">
                        <div class="right-items">
                            <label for="name">商品名</label>
                            <input class="right-item__input"  type="text" name="name" value="{{ $product->name }}" id="name">
                        </div>
                        <div class="right-items">
                            <label for="price">値段</label>
                            <input class="right-item__input"  type="text" name="price" value="{{ $product->price }}" id="price">
                        </div>
                        <div>
                            <label for="seasons">季節</label>
                            <div class="right-items__season">
                                @foreach ($seasons as $season) 
                                <input class="right-items__season--checkbox" type="checkbox" name="seasons[]" value="{{ $season->id }}" {{ $product->seasons->contains($season->id) ? 'checked' : '' }}>{{ $season->name }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item__description">
                    <label for="description">商品説明</label>
                    <textarea name="description" id="description" rows="5">{{ $product->description }}</textarea>
                </div>
                <div class="item__submit">
                    <a class="item__submit-back" href="/products">戻る</a>
                    <button class="item__submit-update" type="submit">変更を保存</button>
                </div>
            </form>
        </div>
    </div>

</div>


@endsection