@extends('adminlte::page')

@section('title', 'Show Data')

@section('content_header')
    <h1>Show Data Penjualan</h1>
@stop

@section('content')
    <div class="content">

		<!-- Hover rows -->
		<div class="card">
			<div class="card-body">
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">Data Penjualan</legend>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">No Transaksi</label>
                        <div class="col-lg-10">
                            <input type="text" name="no_transaksi" class="form-control border-teal border-1 phone-number" placeholder="No Transaksi" value="{{ $penjualan->no_transaksi }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Tanggal Transaksi</label>
                        <div class="col-lg-10">
                            <input type="date" name="tgl_transaksi" class="form-control border-teal pickadate-accessibility" value="{{ $penjualan->tgl_transaksi }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Nama Customer</label>
                        <div class="col-lg-10">
                            <input type="text" name="customer" class="form-control border-teal border-1 phone-number" value="{{ $penjualan->customer }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Detail Penjualan</label>
                        <div class="col-lg-10">
                            <table class="main-table table table-bordered" style="line-height: 1;">
                                @if (!$penjualan_details->isEmpty())
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Diskon</th>
                                            <th scope="col">Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($penjualan_details as $penjualan_detail)
                                            <tr>
                                                <td>{{ $penjualan_detail->master_barang->nama_barang }}</td>
                                                <td>{{ $penjualan_detail->qty }}</td>
                                                <td>{{ number_format($penjualan_detail->harga, 0, ',', '.') }}</td>
                                                <td>{{ number_format($penjualan_detail->discount, 0, ',', '.') }}</td>
                                                <td>{{ number_format($penjualan_detail->subtotal, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @else
                                    <tbody>
                                        <tr>
                                            <td colspan="2" align="center">Data Kosong</td>
                                        </tr>
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Total Bayar</label>
                        <div class="col-lg-10">
                            <input type="text" name="total_bayar" class="form-control border-teal border-1 phone-number" value="{{ number_format($penjualan->total_bayar, 0, ',', '.') }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">PPN</label>
                        <div class="col-lg-10">
                            <input type="text" name="ppn" class="form-control border-teal border-1 phone-number" value="{{ number_format($penjualan->ppn, 0, ',', '.') }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Grand Total</label>
                        <div class="col-lg-10">
                            <input type="text" name="grand_total" class="form-control border-teal border-1 phone-number" value="{{ number_format($penjualan->grand_total, 0, ',', '.') }}" readonly>
                        </div>
                    </div>
                </fieldset>
                <div class="text-right">
                    <a href="{{ url('/penjualan') }}" class="btn btn-secondary">Kembali <i class="fas fa-fw fa-undo"></i></a>
                </div>
			</div>

		</div>
		<!-- /hover rows -->

	</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        function ribuan2(element){
            var val = element.val();
            val = val.replace(/[^\d]/g, '');
            val = val.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            element.val(val);
        }
        $( document ).ready(function() {
            ribuan2($('input[name="potongan"]'));
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                $(document).Toasts('create', {
                    title: 'Error',
                    body: '{{ $error }}',
                    fixed: true,
                })
                @endforeach
            @endif
        });
    </script>
@stop
