@extends('layouts.app')

@section('content')

<div class="container mt-5">
    Hello, {{auth()->user()->name}}
    @if(Auth::check() && auth()->user()->user_type == 'employer')
    <p>Your trial {{now()->format('y-m-d') > auth()->user()->user_trial ? 'was expired': 'will expire'}} on {{auth()->user()->user_trial}}</p>
    @endif

    <div class="row justify-content-center">
        @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-success">{{Session::get('error')}}</div>
        @endif

        <div class="col-md-3">
            <div class="card-counter primary">
                <p class="text-center mt-3 lead">
                    User profile
                </p>
                <button class="btn btn-primary float-end">View</button>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter danger">
                <p class="text-center mt-3 lead">
                    Post job
                </p>
                <a href="{{route('create.post')}}" class="btn btn-primary float-end">View</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter success">
                <p class="text-center mt-3 lead">
                    All jobs
                </p>
                <button class="btn btn-primary float-end">View</button>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-counter info">
                <p class="text-center mt-3 lead">
                    Item
                </p>
                <button class="btn btn-primary float-end">View</button>
            </div>
        </div>
    </div>
    <a href="{{route('dashboard.mail')}}" class="mt-5 btn btn-lg btn-success btn-rounded">Find Your Job</a>
</div>

{{-- <a class="nav-link" href="{{route('job.post')}}">Post job</a> --}}

<style>
    .card-counter {
        box-shadow: 2px 2px 10px #DADADA;
        margin: 5px;
        padding: 20px 10px;
        background-color: #fff;
        height: 130px;
        border-radius: 5px;
        transition: .3s linear all;
    }
    .card-counter.primary {
        background-color: #007bff;
        color: #FFF;
    }
    .card-counter.danger {
        background-color: #ef5350;
        color: #FFF;
    }
    .card-counter.success {
        background-color: #66bb6a;
        color: #FFF;
    }
    .card-counter.info {
        background-color: #26c6da;
        color: #FFF;
    }
</style>

@endsection