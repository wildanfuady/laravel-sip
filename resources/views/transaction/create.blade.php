@extends('template')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Create Transaction</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Create Transaction</li>
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
                        Whoops! Ada kesalahan saat input data, yaitu:
                        <ul> 
                        @foreach($errors->all() as $error) 
                            <li>{{ $error }}</li> 
                        @endforeach 
                        </ul> 
                    </div> 

                @endif 
                <div class="card">
                    {{ Form::open(['route' => 'transaction.store']) }}
                    <div class="card-header">
                        Form Tambah Transaksi
                    </div>
                    <div class="card-body">
                        
                        <div class="form-group">
                            {{ Form::label('product', 'Product') }}
                            {{ Form::select('product_id', $products, null, ['class' => 'form-control', 'placeholder' => 'Choose One']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('product', 'Date') }}
                            {{ Form::date('trx_date', '', ['class' => 'form-control']) }}
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="{{ route('transaction.index') }}" class="btn btn-outline-info">Back</a>
                        <button type="submit" class="btn btn-primary float-right">Add Transaction</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection