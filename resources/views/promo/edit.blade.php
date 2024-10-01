@extends('adminlte::page')

@section('title', 'Edit Data')

@section('content_header')
    <h1>Edit Data Promo</h1>
@stop

@section('content')
    <div class="content">

		<!-- Hover rows -->
		<div class="card">
			<div class="card-body">
				<form class="form-validate-jquery" action="{{ route('promo.update', $promo->id)}}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
					@csrf
					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">Data Promo</legend>

                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Kode Promo<span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="kode_promo" class="form-control border-teal border-1 phone-number" placeholder="Kode Promo" value="{{ $promo->kode_promo }}" required>
								<span class="form-text text-muted">Contoh : promo-001</span>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Nama Promo<span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="nama_promo" class="form-control border-teal border-1 phone-number" placeholder="Nama Promo" value="{{ $promo->nama_promo }}" required>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Potongan Harga<span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="potongan" oninput="ribuan2($(this))" class="form-control border-teal border-1" placeholder="Nominal" value="{{ $promo->potongan }}" required>
							</div>
						</div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Keterangan</label>
                            <div class="col-lg-10">
                                <textarea name="keterangan" cols="10" rows="5" class="form-control border-teal border-1">{{ $promo->keterangan }}</textarea>
                            </div>
                        </div>
					</fieldset>
					<div class="text-right">
						<a href="{{ url('/promo') }}" class="btn btn-secondary">Kembali <i class="fas fa-fw fa-undo"></i></a>
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
