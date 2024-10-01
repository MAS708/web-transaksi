@extends('adminlte::page')

@section('title', 'Master Barang')

@section('content_header')
    <h1>Master Barang</h1>
@stop

@section('content')
    <div class="content">

		<!-- Hover rows -->
		<div class="card">
            <div class="card-header header-elements-inline">
				<a href="{{ route('barang.create')}}"><button type="button" class="btn btn-success rounded-round"><i class="fas fa-fw fa-plus"></i> Tambah</button></a>
			</div>
			<table class="table datatable-basic table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Barang</th>
						<th>Kode Barang</th>
						<th>Harga</th>
						<th style="text-align: center">Actions</th>
					</tr>
				</thead>
				<tbody>
                    @if ($barangs->isNotEmpty())
                        @foreach ($barangs as $key => $barang)
                        <tr>
                            <td width="40px">{{ $key+1 }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->kode_barang }}</td>
                            <td>{{ number_format($barang->harga, 0, ',', '.') }}</td>
                            <td>
                                <div style="text-align:center">
                                    <a href="{{route('barang.edit', $barang->id)}}"><button type="button" class="btn btn-primary btn-icon"><i class="fas fa-fw fa-edit" title="Edit"></i></button></a>
                                    <a class="delbutton" data-toggle="modal" data-target="#modal_theme_danger" data-uri="{{ url('barang', $barang->id) }}"><button type="button" class="btn btn-danger btn-icon"><i class="fas fa-fw fa-trash" title="Delete"></i></button></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" style="text-align:center;">Tidak ada data</td>
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
