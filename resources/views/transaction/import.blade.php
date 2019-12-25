@extends('template')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Create Import Transaction</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Create Import Transaction</li>
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
                <div class="callout callout-info">
                    <h5>Informasi Penting</h5>
                    <p>Jika Anda membutuhkan format excel untuk melakukan import, silahkan download <strong><a href="{{ asset('storage/files/format-import.xlsx') }}">di sini</a></strong>.</p>
                </div>
                <div class="card">
                    {{ Form::open(['url' => 'transaction/store_import', 'files' => true]) }}
                    <div class="card-header">
                        Form Import Transaction
                    </div>
                    <div class="card-body">
                        
                        <div class="form-group">
                            {{ Form::label('', 'File Import') }}
                            {{ Form::file('file_trx', ['class' => 'form-control']) }}
                        </div>
                        <div class="input-group">
                            <div class="custom-file">
                                {{ Form::file('file_trx', ['class' => 'custom-file-input', 'id' => 'customFile']) }}
                                {{ Form::label('exampleInputFile', 'Choose file', ['class' => 'custom-file-label']) }}
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="{{ route('transaction.index') }}" class="btn btn-outline-info">Back</a>
                        <button type="submit" class="btn btn-primary float-right">Import Transaction</button>
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