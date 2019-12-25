@extends('template')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Detail Product</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Detail Product</li>
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
            
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        Detail Produk
                    </div>
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('category_id', 'Category') }}
                                    <!-- <label for="category_id">Category</label> -->
                                    {{ Form::select('category_id', $categories, $product->category_id, ['class' => 'form-control', 'placeholder' => 'Choose One', 'disabled' => 'disabled']) }}

                                    <!-- <select name="category_id" id="test" class="form-control">
                                        <option value="" selected>Choose One</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                        </select>
                                    </!-->

                                </div>
                                <div class="form-group">
                                    {{ Form::label('name', 'Name') }}
                                    {{ Form::text('product_name', $product->product_name, ['class' => 'form-control', 'placeholder' => 'Enter product name', 'disabled' => 'disabled']) }}

                                    <!-- <input type="text" name="name" value="" class="form-control" placeholder="Enter product name"> -->
                                </div>
                                <div class="form-group">
                                    {{ Form::label('price', 'Price') }}
                                    {{ Form::number('price', $product->product_price, ['class' => 'form-control', 'placeholder' => 'Enter product price', 'disabled' => 'disabled']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('sku', 'SKU') }}
                                    {{ Form::text('sku', $product->product_sku, ['class' => 'form-control', 'placeholder' => 'Enter product sku', 'disabled' => 'disabled']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('status', 'Status') }}
                                    <!-- <label for="category_id">Category</label> -->
                                    {{ Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], $product->product_status, ['class' => 'form-control', 'placeholder' => 'Choose One', 'disabled' => 'disabled']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    {{ Form::label('image', 'Image') }}
                                    <br>
                                    <img src="{{ asset('storage/'.$product->product_image) }}" alt="" class="img-fluid">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('description', 'Description') }}
                                    {{ Form::textarea('description', $product->product_description, ['class' => 'form-control', 'placeholder' => 'Enter product description', 'disabled' => 'disabled']) }}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="{{ route('product.index') }}" class="btn btn-outline-info">Back</a>
                    </div>
                    <!-- </form> -->
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection