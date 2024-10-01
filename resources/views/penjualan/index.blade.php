@extends('adminlte::page')

@section('title', 'Penjualan')

@section('content_header')
    <h1>Penjualan</h1>
@stop

@section('content')
    <div class="content">

		<!-- Hover rows -->
		<div class="card">
            <div class="card-header header-elements-inline">
				<a href="{{ route('penjualan.create')}}"><button type="button" class="btn btn-success rounded-round"><i class="fas fa-fw fa-plus"></i> Tambah</button></a>
			</div>
			<table class="table datatable-basic table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>No Transaksi</th>
						<th>Customer</th>
						<th>Tanggal Transaksi</th>
						<th>Total Bayar</th>
						<th>PPN</th>
						<th>Grand Total</th>
						<th style="text-align: center">Actions</th>
					</tr>
				</thead>
				<tbody>
                    @if ($penjualans->isNotEmpty())
                        @foreach ($penjualans as $key => $penjualan)
                        <tr>
                            <td width="40px">{{ $key+1 }}</td>
                            <td>{{ $penjualan->no_transaksi }}</td>
                            <td>{{ $penjualan->customer }}</td>
                            <td>{{ $penjualan->tgl_transaksi }}</td>
                            <td>{{ number_format($penjualan->total_bayar, 0, ',', '.') }}</td>
                            <td>{{ number_format($penjualan->ppn, 0, ',', '.') }}</td>
                            <td>{{ number_format($penjualan->grand_total, 0, ',', '.') }}</td>
                            <td>
                                <div style="text-align:center">
                                    <a href="{{route('penjualan.show', $penjualan->id)}}"><button type="button" class="btn btn-primary btn-icon"><i class="fas fa-fw fa-eye" title="Show"></i></button></a>
                                    <a class="delbutton" data-toggle="modal" data-target="#modal_theme_danger" data-uri="{{ url('penjualan', $penjualan->id) }}"><button type="button" class="btn btn-danger btn-icon"><i class="fas fa-fw fa-trash" title="Delete"></i></button></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" style="text-align:center;">Tidak ada data</td>
                        </tr>
                    @endif
				</tbody>
			</table>
		</div>
		<!-- /hover rows -->

	</div>

    <!-- Danger modal -->
	<div id="modal_theme_danger" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-danger" align="center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<form action="" method="post" id="delform">
				    @csrf
				    @method('DELETE')
					<div class="modal-body" align="center">
						<h2> Hapus Data? </h2>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn bg-danger">Hapus</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /default modal -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script type="text/javascript">
    $(document).on("click", ".delbutton", function () {
        var url = $(this).data('uri');
        $("#delform").attr("action", url);
    });
    $( document ).ready(function() {
        // Default style
        @if(session('error'))
            $(document).Toasts('create', {
                title: 'Error',
                body: '{{ session('error') }}',
                fixed: true,
            })
        @endif
        @if ( session('success'))
            $(document).Toasts('create', {
                title: 'Success',
                body: '{{ session('success') }}',
                fixed: true,
            })
        @endif

    });
</script>
@stop
