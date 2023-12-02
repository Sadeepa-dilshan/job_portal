@extends('layouts.app')

@section('content')

<div class="container mt-2">
    <div class="row justify-content-center">

        <div class="col-md-8 mt-5 mb-5">

            @include('message')

            <div class="card shadow" id="card" style="margin-top:50px;">
                <div class="card-header">Login</div>
                <form action="{{route('login.post')}}" method="post" id="registrationForm">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" required>
                            @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" required>
                            @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password')}}</span>
                            @endif
                        </div>
                        <br>
                        <div class="form-group text-center">
                            <button class="btn btn-dark" id="btnRegister" type="submit">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection