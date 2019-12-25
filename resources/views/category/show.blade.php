@extends('template')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Detail Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Detail Category</li>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Show Category</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Name Category</label>
                            <input type="text" id="category_name" class="form-control" value="{{ $category['category_name'] }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <input type="text" id="status" class="form-control" value="{{ $category['category_status'] }}" disabled>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('categories') }}" class="btn btn-outline-info">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection