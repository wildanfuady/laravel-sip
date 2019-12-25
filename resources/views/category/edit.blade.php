@extends('template')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Category</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                
                @if(!empty($errors->all())) 

                <div class="alert alert-danger"> 
                    <ul> 
                        @foreach($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                        @endforeach 
                    </ul> 
                </div> 

                @endif

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Category</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{URL::to('category/update/'.$category['category_id'])}}" method="POST">
                            {{ csrf_field() }}
                            
                            <input type="hidden" name="_method" value="PUT">
                            
                            <input type="hidden" name="category_id" value="{{$category['category_id']}}">

                        <div class="form-group">
                            <label for="">Name Category</label>
                            <input type="text" id="category_name"  name="name" class="form-control" value="{{ $category['category_name'] }}">
                        </div>
                    
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" class="form-control"> 
                                <option value="Active" {{ $category['category_status']=='Active'?'selected':'' }}>Active</option> 
                                <option value="Inactive" {{ $category['category_status']=='Inactive'?'selected':'' }}>Inactive</option> 
                            </select> 
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('categories') }}" class="btn btn-outline-info">Back</a>
                        <button type="submit" class="btn btn-primary">Edit Data</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection