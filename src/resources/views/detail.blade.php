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
            <form action="/products/{{ $product->id }}/update" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <div class="content-items">
                    <div class="content-item__left">
                        @if($product->image)
                        <img src="{{ asset('storage/'. $product->image) }} " alt="{{ $product->name }}">
                        @endif
                        <input type="file" name="image" required>
                    </div>
                    <div class="content-item__right">
                        <div class="right-items">
                            <label for="name">商品名</label>
                            <input class="right-item__input"  type="text" name="name" value="{{ old('name', $product->name) }}" id="name">
                            <div class="error">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="right-items">
                            <label for="price">値段</label>
                            <input class="right-item__input"  type="text" name="price" value="{{ old('price', $product->price) }}" id="price">
                            <div class="error">
                                @error('price')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="seasons">季節</label>
                            <div class="right-items__season">
                                <input type="hidden" name="seasons" value="">
                                @foreach ($seasons as $season) 
                                <input class="right-items__season--checkbox" type="checkbox" name="seasons[]" value="{{ $season->id }}" {{ $product->seasons->contains($season->id) ? 'checked' : '' }}>
                                {{ $season->name }}
                                @endforeach
                                <div class="error">
                                    @error('seasons')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item__description">
                    <label for="description">商品説明</label>
                    <textarea name="description" id="description" rows="5">{{ $product->description }}</textarea>
                    <div class="error">
                        @error('description')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="item__submit">
                    <a class="item__submit-back" href="/products">戻る</a>
                    <button class="item__submit-update" type="submit">変更を保存</button>
                </div>
            </form>
            <form class="item__submit-delete" action="/products/{{ $product->id }}/delete" method="POST">
                @method('DELETE')
                @csrf 
                <button class="submit__delete" type="submit">
                    🗑️
                </button>
            </form>
        </div>
    </div>

</div>


@endsection