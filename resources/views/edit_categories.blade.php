<form action="{{ route('update.categories') }}" method="post">
    @csrf

    <h2>Select Categories</h2>

    @foreach($categories as $category)
        <label>
            <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ $user->categories->contains($category) ? 'checked' : '' }}>
            {{ $category->name }}
        </label>
        <br>
    @endforeach

    <button type="submit">Update Categories</button>
</form>

