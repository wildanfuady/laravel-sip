@extends('template')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
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
            <!-- div.col-md-6*2>div.card>div.card-header+div.card-body -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Sales Graph
                    </div>
                    <div class="card-body">
                        <canvas class="chart" id="sales-chart" style="height:250px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Latest Transaction
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1; ?>
                                @foreach($lt as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->product->product_name }}</td>
                                        <td>{{ "Rp. ".number_format($row->trx_price) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($row->trx_date)) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<script>

    var chart = document.getElementById("sales-chart").getContext('2d');
    var areaChart = new Chart(chart, {
        type : 'line',
        data : 
        {
            labels: {!! json_encode($chart['months']) !!},
            datasets : [
                {
                    label : 'Grafik Penjualan',
                    data : {{ json_encode($chart['totals']) }},
                }
            ]
        }
    });

</script>
@endsection