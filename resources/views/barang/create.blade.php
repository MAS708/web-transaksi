@extends('adminlte::page')

@section('title', 'Tambah Data')

@section('content_header')
    <h1>Tambah Data Master Barang</h1>
@stop

@section('content')
    <div class="content">

		<!-- Hover rows -->
		<div class="card">
			<div class="card-body">
				<form class="form-validate-jquery" action="{{ route('barang.store')}}" method="post" enctype="multipart/form-data">
					@csrf
					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">Data Barang</legend>

                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Kode Barang<span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="kode_barang" class="form-control border-teal border-1 phone-number" placeholder="Kode Barang" required>
								<span class="form-text text-muted">Contoh : 001</span>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Nama Barang<span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="nama_barang" class="form-control border-teal border-1 phone-number" placeholder="Nama Barang" required>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Harga<span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="harga" oninput="ribuan2($(this))" class="form-control border-teal border-1" placeholder="Nominal" required>
							</div>
						</div>
					</fieldset>
					<div class="text-right">
						<a href="{{ url('/barang') }}" class="btn btn-secondary">Kembali <i class="fas fa-fw fa-undo"></i></a>
						<button type="submit" class="btn btn-primary submitBtn">Simpan <i class="fas fa-fw fa-paper-plane"></i></button>
					</div>
				</form>
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
