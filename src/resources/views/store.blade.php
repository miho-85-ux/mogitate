@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
@endsection

@section('content')
<div class="store-content">
    <div class="store-content__inner">
        <div>
            <h1>商品登録</h1>
        </div>
        <div >
            <form action="/products/register" method="POST" enctype="multipart/form-data" >
                @csrf 
                <div class="content-items">
                    <label for="name">商品名
                        <span class="item-span">必須</span>
                    </label>
                    <input class="item-input" type="text" name="name" id="name" placeholder="商品名を入力" value="{{ old('name') }}" >
                    <div class="error">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="content-items">
                    <label for="price">値段<span class="item-span">必須</span></label>
                    <input class="item-input" type="text" name="price" id="price" placeholder="値段を入力" value="{{ old('price') }}">
                    <div class="error">
                        @error('price')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="content-items">
                    <label for="image">商品画像<span class="item-span">必須</span></label>
                    @if(isset($product) && $product->image)
                        <img src="{{ asset('storage/'. $product->image) }}" alt="">
                    @endif
                    <input class="item-input__image" type="file" name="image" id="image" >
                    <div class="error">
                        @error('image')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="content-items">
                    <label for="seasons">季節
                        <span class="item-span">必須</span>
                        <span class="item-span__selection">複数選択可</span>
                    </label>
                    <div class="content-items__season">
                        @foreach ($seasons as $season)
                        <input class="item-input__season--checkbox" type="checkbox" name="seasons[]" value="{{ $season->id }}" {{ in_array($season->id, old('seasons', [])) ? 'checked' : '' }} > {{ $season->name }}
                        @endforeach
                    </div>
                    <div class="error">
                        @error('seasons')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="content-items">
                    <label for="description">商品説明<span class="item-span">必須</span></label>
                    <textarea name="description" rows=10 id="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                    <div class="error">
                        @error('description')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="content-items__buttons">
                    <a class="button-back" href="/products">戻る</a>
                    <button class="button-register" type="submit">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection