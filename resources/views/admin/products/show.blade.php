@extends('admin.layouts.app')
@section('title', 'Create Product')
@section('content')
    <div class="card">
        <h1>Show Product</h1>
        <div>
            <div class="row">
                <div class=" input-group-static col-5 mb-4">
                    <label>Image</label>
                </div>
                <div class="col-5">
                    <img
                        src="{{ $product->images ? asset('upload/' . $product->images->first()->url ) : 'upload/default.png' }}"
                        id="show-image" alt="">
                </div>
            </div>
            <div class="input-group input-group-static mb-4">
                <label>Name:{{$product->name}}</label>
            </div>

            <div class="input-group input-group-static mb-4">
                <label>Price:{{$product->price}}</label>
            </div>

            <div class="input-group input-group-static mb-4">
                <label>Sale:{{$product->sale}}</label>
            </div>
            <div class="form-group">
                <p>Description</p>
                <div class="row w-100 h-100">
                    {!!$product->description !!}
                </div>
            </div>
            <div>
                <p>Size</p>
                @if ($product->details->count() > 0)
                    @foreach ($product->details as $detail)
                        <p>Size: {{ $detail->size }} - quantity: {{ $detail->quantity }}</p>
                    @endforeach
                @else
                    <p> Sản phẩm này chưa nhập size</p>
                @endif
            </div>

            <div>
                <p>Category</p>
                @foreach($product->categories as $item)
                    <p>{{$item->name}}</p>
                @endforeach
            </div>

        </div>
@endsection

