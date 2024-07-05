@extends('layout.backend.index')
@section('content')
<div class="container">
    <h1>Brand Details</h1>

    <div class="card">
        <div class="card-header">
            <h2>{{ $brand->name }}</h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="image">Brand Image:</label>
                @if ($brand->image)
                <img src="{{ asset('uploads/brand-img/' . $brand->image) }}" alt="{{ $brand->name }}" class="img-fluid">
                @else
                <label for="image" id="image-preview">
                    <img src="https://bit.ly/3ubuq5o" class="img-thumbnail" alt="" width="200px" height="200px">
                    <div>
                        <span hidden>+</span>
                    </div>
                </label>
                @endif
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <p>{{ $brand->description }}</p>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <span class="badge rounded-pill bg-{{ $brand->status ? 'success ' :  'danger'}} bg-{{ $brand->status ? '<i class="bi bi-exclamation-octagon me-1"></i>' :  '<i class="bi bi-check-circle "></i>'}}">{{ $brand->status  ? ' Active':' Unactive' }}</i></span>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url('admin/brand/' . $brand->id . '/edit') }}" class="btn btn-primary">Edit Brand</a>
            <a href="{{ url('admin/brand') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection