@extends('layout.backend.index')

@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Create category</h1>

        <div class="card mb-4">
            <div class="card-body">
                @if(Session::has('category_create'))
                <div class="alert alert-primary alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Primary!</strong> {{ session('category_create') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Something is wrong:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Brand Creation Form -->
                <div>
                    {!! Form::open(['url' => 'admin/category', 'files' => true]) !!}

                    <div class="form-group">
                        
                        {{ Form::label('brand_id', 'Brand:') }}
                        {{ Form::select('brand_id', $brands,null ,array('class'=>'form-select')) }}
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Description:') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        <label for="image" id="image-preview">
                            <img src="https://bit.ly/3ubuq5o" class="img-thumbnail" alt="" width="200px" height="200px">
                            <div>
                                <span hidden>+</span>
                            </div>
                        </label>

                        <br>

                        <div class="form-group" style="padding: 2px;">

                            <div class="input-group">
                                <div class="custom-file  @error('image') is-invalid" @enderror">
                                    <input type="file" id="image" name="image" accept="image/*" class="form-control @error('image') is-invalid" @enderror">
                                    <p class="invalid-feedback">
                                        please uploade an image.
                                    </p>

                                </div>

                                @error('image')
                                <p class="invalid-feedback">
                                    {{ $message }}
                                </p>
                                @enderror


                            </div>

                        </div>

                    </div>
                    
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" checked value="1">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Status</label>
                    </div>
                    

                    <br>
                    <div class="form-group">
                        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                        <a class="btn btn-primary" href="{{ url('/admin/category') }}">Back</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection