@extends('admin.layouts.app')
@section('title', 'Create User')
@section('content')
    <div class="card">
        <h1>Create User</h1>
        <div>
            <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-md-3 col-sm-4 control-label">Ảnh</label>
                    <div class="col-md-9 col-sm-8">
                        <div class="row">
                            <div class="col-xs-6">
                                <img id="show-image"
                                     src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg"
                                     alt="your image"
                                     style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
                                <input type="file" name="image" accept="image/*"
                                       class="form-control-file @error('image') is-invalid @enderror" id="image-input">
                                <label for="">Ảnh </label><br/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-group input-group-static mb-4">
                    <label>Name</label>
                    <input type="text" value="{{ old('name') }}" name="name" class="form-control">
                    @error('name')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label>Email</label>
                    <input type="email" value="{{ old('email') }}" name="email" class="form-control">
                    @error('email')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label>Phone</label>
                    <input type="text" value="{{ old('phone') }}" name="phone" class="form-control">
                    @error('phone')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label name="group" class="ms-0">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="male">Male</option>
                        <option value="fe-male">FeMale</option>

                    </select>
                    @error('gender')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group input-group-static mb-4">
                    <label>Address</label>
                    <textarea name="address" class="form-control">{{ old('address') }} </textarea>
                    @error('address')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>


                <div class="input-group input-group-static mb-4">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                    <span class="text-danger"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Roles</label>
                    <div class="row">
                        @foreach ($roles as $groupName => $role)
                            <div class="col-5">
                                <h4>{{ $groupName }}</h4>
                                <div>
                                    @foreach ($role as $item)
                                        <div class="form-check">
                                            <input class="form-check-input" name="role_ids[]" type="checkbox"
                                                   value="{{ $item->id }}">
                                            <label class="custom-control-label"
                                                   for="customCheck1">{{ $item->display_name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-submit btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
{{--@section('script')--}}

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


{{--@endsection--}}
