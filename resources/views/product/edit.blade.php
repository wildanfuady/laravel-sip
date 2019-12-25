@extends('template')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Product</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Product</li>
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
                {{ Form::model($product, ['method' => 'PATCH', 'route' => ['product.update', $product->product_id], 'files' => true]) }}
                    <div class="card-header">
                        Form Edit Produk
                    </div>
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('category_id', 'Category') }}
                                    <!-- <label for="category_id">Category</label> -->
                                    {{ Form::select('category_id', $categories, $product->category_id, ['class' => 'form-control', 'placeholder' => 'Choose One', 'id' => 'test']) }}

                                    <!-- <select name="category_id" id="test" class="form-control">
                                        <option value="" selected>Choose One</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                        </select>
                                    </!-->

                                </div>
                                <div class="form-group">
                                    {{ Form::label('name', 'Name') }}
                                    {{ Form::text('product_name', $product->product_name, ['class' => 'form-control', 'placeholder' => 'Enter product name']) }}

                                    <!-- <input type="text" name="name" value="" class="form-control" placeholder="Enter product name"> -->
                                </div>
                                <div class="form-group">
                                    {{ Form::label('price', 'Price') }}
                                    {{ Form::number('price', $product->product_price, ['class' => 'form-control', 'placeholder' => 'Enter product price']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('sku', 'SKU') }}
                                    {{ Form::text('sku', $product->product_sku, ['class' => 'form-control', 'placeholder' => 'Enter product sku']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('status', 'Status') }}
                                    <!-- <label for="category_id">Category</label> -->
                                    {{ Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], $product->product_status, ['class' => 'form-control', 'placeholder' => 'Choose One']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    {{ Form::label('image', 'Image') }}
                                    <br>
                                    <img src="{{ asset('storage/'.$product->product_image) }}" alt="" class="img-fluid">
                                    {{ Form::label('image', 'Ganti Image') }}
                                    <br>
                                    {{ Form::file('image', ['class' => 'form-control']) }}

                                    <!-- <input type="file" name="image" class="form-control"> -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('description', 'Description') }}
                                    {{ Form::textarea('description', $product->product_description, ['class' => 'form-control', 'placeholder' => 'Enter product description']) }}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="{{ route('product.index') }}" class="btn btn-outline-info">Back</a>
                        <button type="submit" class="btn btn-primary float-right">Update Product</button>
                    </div>
                    {{ Form::close() }}
                    <!-- </form> -->
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection