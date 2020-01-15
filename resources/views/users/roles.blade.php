@extends('layouts.index')
​
@section('title')
    <title>Set Role</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">Set Role</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
                            <li class="breadcrumb-item active">Set Role</li>
                        </ol>
                    </div>
                    <div>
                    <div class="row clearfix">
                        <div class="card" style=" margin-left: 30px;">
                        <div class="col-md-12">
                            <form action="{{ route('users.roles', $user->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                            {{-- @card --}}
                                @slot('title')
                                @endslot
                                @if (session('success'))
                                    <div class="btn btn-info btn-sm">
                                        {!! session('success') !!}
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <br>
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <td>:</td>
                                                <td>{{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>:</td>
                                                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                            </tr>
                                            <tr>
                                                <th>Role</th>
                                                <td>:</td>
                                                <td>
                                                    @foreach ($roles as $row)
                                                    <input type="radio" name="role"
                                                        {{ $user->hasRole($row) ? 'checked':'' }}
                                                        value="{{ $row }}"> {{  $row }} <br>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-sm float-right">
                                            Set Role
                                        </button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
