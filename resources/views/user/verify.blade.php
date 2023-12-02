@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <div  class="card-header">Verify Account</div>
                <div class="card-body">Your account is not verified.Plese verify your account.
                    You may resend the verification email.
                    <a href="{{route('resend.email')}}">Resend verification email</a>
                </div>
            </div>
        </div>
    </div>

@endsection