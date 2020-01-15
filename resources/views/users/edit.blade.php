@extends('layouts.index')
​
@section('title')
    <title>Edit Users</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{-- @card --}}
                        @slot('title')
                        @endslot
                        @if (session('error'))
                            @alert(['type' => 'danger'])
                                {!! session('error') !!}
                            @endalert
                        @endif
                        <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="name"
                                    value="{{ $user->name }}"
                                    class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" required>
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email"
                                    value="{{ $user->email }}"
                                    class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}"
                                    required readonly>
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                                <p class="text-warning">Biarkan kosong, jika tidak ingin mengganti password</p>
                            </div>
                            <label>Photo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Photo</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input {{ $errors->has('avatar') ? ' is-invalid' : '' }}" name="avatar" id="validatedCustomFile" required>
                                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                    {{-- Error Notification --}}
                                    @if ($errors->has('avatar'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm"><i class="fa fa-send"></i> Update</button>
                            </div>
                        </form>
                        @slot('footer')
                        @endslot
                    {{-- @endcard --}}
                </div>
            </div>
        </div>
    </div>
@endsection
