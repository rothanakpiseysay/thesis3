@extends('layout.backend.index')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Create Brands</h1>

        <div class="card mb-4">
            <div class="card-body">
                @if(Session::has('brand_create'))
                <div class="alert alert-primary alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Primary!</strong> {{ session('brand_create') }}
                </div>
                @endif
                @if (count($errors) > 0)
                <!-- Form Error List -->
                <div class="alert alert-danger">
                    <strong>Something is Wrong</strong>
                    <br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- It Create the new Category -->
                <div>
                    {{ Form::open(array('url'=>'admin/brand', 'files'=>'true')) }}


                    <br>
                    {{ Form::label('name', 'Name:') }}
                    {{ Form::text('name',null, array('class'=>'form-control')) }}

                    <br>
                    {{ Form::label('description', 'Description:') }}
                    {{ Form::textarea('description',null, array('class'=>'form-control')) }}

                    <br>
                    <div>
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


                    <br>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" checked value="1">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Status</label>
                    </div>

                    <br>
                    {{ Form::submit('Create', array('class'=>'btn btn-primary')) }}


                    <a class="btn btn-primary" href="{{ url('/admin/brand') }}">Back</a>

                    {{ Form::close() }}
                </div>


            </div>
        </div>

    </div>
</main>
@endsection