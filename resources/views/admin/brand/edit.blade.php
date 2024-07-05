@extends('layout.backend.index')
@section('content')
<div class="container">
    <h1>Edit Brand</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (Session::has('brand_update'))
    <div class="alert alert-success">
        {{ Session::get('brand_update') }}
    </div>
    @endif

    <form action="{{ url('admin/brand/' . $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Brand Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $brand->name) }}">
        </div>

        <div class="form-group">
            <label for="image">Brand Image:</label>
            <input type="file" class="form-control" id="image" name="image">
            @if ($brand->image)
                <img src="{{ asset('uploads/brand-img/' . $brand->image) }}" alt="{{ $brand->name }}" width="100">
            @endif
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $brand->description) }}</textarea>
        </div>

        <!-- <div class="form-group">
            <label for="status">Status:</label>
            <input type="checkbox" id="status" value="1" name="status" {{ $brand->status == '1' ? 'checked' : '' }}>
        </div> -->

        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="status"   name="status" {{ $brand->status == '1' ? 'checked' : '' }} >
            <label class="form-check-label" for="flexSwitchCheckChecked">Status</label>
        </div>

        <button type="submit" class="btn btn-primary">Update Brand</button>
        <a class="btn btn-primary" href="{{ url('/admin/brand') }}">Back</a>
        {{ Form::close() }}
    </form>
</div>
@endsection