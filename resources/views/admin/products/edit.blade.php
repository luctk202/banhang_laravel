@extends('admin.layouts.app')
@section('title', 'Update Product')
@section('content')
    <div class="card">
        <h1>Update product</h1>
        <div>
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group input-group-static mb-4">
                    <div class=" input-group-static col-5 mb-4">
                        <label>Image</label>
                        <input type="file" accept="image/*" name="image" id="image-input" class="form-control">

                        @error('image')
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-5">
                        <img src="{{ $product->images ? asset('upload/' . $product->images->first()->url ) : 'upload/default.png' }}"
                             id="show-image" alt="">
                    </div>
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Name</label>
                    <input type="text" value="{{ old('name') ?? $product->name }}" name="name" class="form-control">
                    @error('name')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label>Price</label>
                    <input type="text" value="{{ old('price') ?? $product->price }}" name="price" class="form-control">
                    @error('price')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label>Sale</label>
                    <input type="text" value="{{ old('sale') ?? $product->sale}}" name="sale" class="form-control">
                    @error('sale')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <div class="">
                        <textarea name="description" id="description" class="form-control" cols="4" rows="5"
                                  style="width: 100%">{{ old('description') ?? $product->description }} </textarea>
                    </div>
                    @error('description')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>

                <input type="hidden" id="inputSize" name='sizes'>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddSizeModal">
                    Add size
                </button>
                <div class="modal fade" id="AddSizeModal" tabindex="-1" aria-labelledby="AddSizeModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AddSizeModalLabel">Add size</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="AddSizeModalBody">

                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn  btn-primary btn-add-size">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-group input-group-static mb-4">
                    <label name="group" class="ms-0">Category</label>
                    <select name="category_ids[]" class="form-control" multiple>
                        @foreach($categories as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-submit btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection


@section('style')
    <style>
        .w-40 {
            width: 40%;
        }

        .w-20 {
            width: 20%;
        }

        .row {
            justify-content: center;
            align-items: center
        }

        .ck.ck-editor {
            width: 100%;
            height: 100%;
        }

    </style>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"
            integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        let sizes = @json($product->details);
    </script>
    <script src="{{ asset('admin/assets/js/product/product.js') }}"></script>
@endsection
<script src="{{asset('bootstrap/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bootstrap/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('bootstrap/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script>
    $(function () {
        function readURL(input, selector) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $(selector).attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image-input").change(function () {
            readURL(this, '#show-image');
        });

    });
</script>

