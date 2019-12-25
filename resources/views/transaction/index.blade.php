@extends('template')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Transactions</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Transactions</li>
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
                        <h3 class="card-title">Transactions</h3>
                        
                        <div class="card-tools">
                            <div class="btn-group">
                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog"></i> Pengaturan
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                    <a href="{{ route('transaction.create') }}" class="dropdown-item">Create</a>
                                    <a href="{{ url('transaction/import') }}" class="dropdown-item">Import</a>
                                    <a href="{{ url('transaction/download') }}" class="dropdown-item">Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(Session::has('success'))
                        <div id="alert-msg" class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ Session::get('success') }}
                        </div>
                        @endif
                        @if(Session::has('info'))
                        <div id="alert-msg" class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ Session::get('info') }}
                        </div>
                        @endif
                        @if(Session::has('warning'))
                        <div id="alert-msg" class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ Session::get('warning') }}
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="20">No</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $row)
                                    <tr>
                                        <td class="text-center">{{ ++$i }}</td>
                                        <td>{{ $row->product->product_name }}</td>
                                        <td>{{ "Rp. ".number_format($row->trx_price) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($row->trx_date)) }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-info btn-sm" onclick="detailTransaction('{{ $row->product->product_name }}', '{{ $row->trx_price }}', '{{ $row->trx_date }}');"><i class="fa fa-eye"></i></a>
                                                <a href="#" class="btn btn-success btn-sm" onclick="editTransaction({{$products}}, '{{ $row->product_id }}', '{{ date('d/m/Y', strtotime($row->trx_date)) }}');" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" onclick="deleteConfirm('{{ url('transaction/delete/'.$row->trx_id) }}', '{{ $row->product->product_name }}');"><i class="fa fa-trash-alt"></i></a>    
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Delete Confirmation -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-info">
                                <th>Product</th>
                                <th>Price</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="show_product"></td>
                                <td id="show_price"></td>
                                <td id="show_date"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Transaction</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['id' => 'edit_trx']) }}
            <div class="modal-body">
                
                <div class="form-group">
                    {{ Form::label('product', 'Product') }}
                    {{ Form::select('product_id', $products, null, ['class' => 'form-control', 'id' => 'edit_product']) }}
                </div>
                
                <div class="form-group">
                    {{ Form::label('date', 'Date') }}
                    {{ Form::text('trx_date', '', ['class' => 'form-control', 'id' => 'datepicker']) }}
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Transaction</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data transaksi <b><span id="show_name"></span></b> ini?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="#" id="btn_delete" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>

    function detailTransaction(product, price, date) {
        $("#show_product").html(product);
        $("#show_price").html(price);
        $("#show_date").html(date);
        $("#detailModal").modal();
    }

    function editTransaction(products, product, date) {
        $("#edit_trx").attr('action', "{{ url('transaction/update') }}/"+product);
        var data = $("#edit_product option").attr('class', 'list');
        
        var list = $(".list");
        for(var i = 0; i < list.length; i++){

            var isi = $(list[i]).val();

            if(isi == null){
                var isi = $(list[i]).val();
            } else {
                console.log(isi);
                console.log(product);
                if(isi == product){
                    $(list).removeAttr('selected');
                    $(list[i]).attr('selected', 'selected');
                }
            }

            $("#edit_product").change(function(){
                $(list).removeAttr('selected');
                $(this).attr('selected', 'selected');
            });
            
        } 
        $("#datepicker").removeAttr('value');
        $("#datepicker").attr('value', date);
        $("#editModal").modal();

    }
    
    function deleteConfirm(url, name) {
        // Menambahkan value dari suatu atribut di HTML 
        $("#btn_delete").attr('href', url);
        // Input nama kategori ke id show_name
        $("#show_name").html(name);
        // Memanggil modal berdasarkan ID
        $("#deleteModal").modal();
    }

    $(document).ready(function() {

        $("#category").on('change', function(){
            filter();
        });

        $("#keyword").keypress(function(event){

            if(event.keyCode == 13){ // Enter
                filter();
            }

        });

        var filter  = function(){
            var category = $("#category").val();
            var keyword = $("#keyword").val();

            window.location.replace("{{ url('product') }}?category="+category+"&keyword="+keyword);
        }
    });

</script>

@endsection