<!-- resources/views/job/form.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create a New Job</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('store.post') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" name="company_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="post">Post</label>
                <input type="text" name="post" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="closing_date">Closing Date</label>
                <input type="date" name="closing_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="closing_date">Location</label>
                <input type="text" name="location" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="closing_date">Mobile Number</label>
                <input type="text" name="mobile_number" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Job</button>
        </form>
    </div>
@endsection
