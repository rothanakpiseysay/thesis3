@extends('layout.backend.index')
@section('content')

<!-- <h1>Product List</h1>
    <a class="btn btn-primary" href="{{url('/product/create')}}">Create New</a> -->

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <form class="app-search-form" action="{{ route('brands.search') }}" method="GET">
        <input type="text" placeholder="Search..." name="search" class="form-control search-input">
        <button type="submit" class="btn search-btn btn-primary" value="Search"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
</div><!--//app-search-box-->
<br>
@if(Session::has('brand_delete'))
<div class="alert alert-primary alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Primary!</strong> {!! session('brand_delete') !!}
</div>
@endif

<div class="panel panel-default">


    <div class="panel-heading">
        All Brand
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <th style="width: 50px;">No#</th>
                <th style="width: 50px;">Brand_ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Status</th>
                <th style="width: 10px;">Action</th>
            </thead>
            @if (count($brands) > 0)
            <tbody>
                @foreach ($brands as $brand)
                <tr>
                    <td>
                        <div>{{$loop->index + 1}}</div>
                    </td>
                    <td>
                        <div>{{ $brand->id }}</div>
                    </td>
                    <td>
                        <a href="{{url('/admin/brand/'.$brand->id)}}">{{ $brand->name }}</a>
                    </td>
                    <td>
                        <div>{{ Html::image('uploads/brand-img/'.$brand->image, $brand->name, array('width'=>'60', 'height' => '50')) }}</div>
                    </td>
                    
                    <td>
                        <span class="badge rounded-pill bg-{{ $brand->status ? 'success ' :  'danger'}} bg-{{ $brand->status ? '<i class="bi bi-exclamation-octagon me-1"></i>' :  '<i class="bi bi-check-circle "></i>'}}">{{ $brand->status  ? ' Active':' Unactive' }}</i></span>
                    </td>
                    

                    <td style="display: flex;  gap:5px; ">
                        <a class="btn btn-outline-secondary" href="{{url('/admin/brand/'.$brand->id)}}">Show</a>
                        <a class="btn btn-outline-success" href="{!! url('admin/brand/' . $brand->id . '/edit') !!}">Edit</a>
                        {{ Form::open(array('url'=>'admin/brand/'. $brand->id, 'method'=>'DELETE')) }}
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <a class="btn btn-outline-danger">Delete</button>
                            {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            @endif
        </table>
    </div>
</div>
<script>
    $(".delete").click(function() {
        var form = $(this).closest('form');
        $('<div></div>').appendTo('body')
            .html('<div><h6> Are you sure ?</h6></div>')
            .dialog({
                modal: true,
                title: 'Delete message',
                zIndex: 10000,
                autoOpen: true,
                width: 'auto',
                resizable: false,
                buttons: {
                    Yes: function() {
                        $(this).dialog('close');
                        form.submit();
                    },
                    No: function() {
                        $(this).dialog("close");
                        return false;
                    }
                },
                close: function(event, ui) {
                    $(this).remove();
                }
            });
        return false;
    });
</script>

@endsection