@extends('adminlte::page')

@section('title', 'Tambah Data')

@section('content_header')
    <h1>Tambah Data Penjualan</h1>
@stop

@section('content')
    <form id="submit-form" class="form-validate-jquery" action="{{url('/penjualan')}}" method="post">
        <div class="content">

            <!-- Hover rows -->
            <div class="card">
			    <div class="card-body">
					@csrf
					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">Data Penjualan</legend>

                        <div class="form-group row">
							<label class="col-form-label col-lg-2">No Transaksi<span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="no_transaksi" class="form-control border-teal border-1 phone-number" placeholder="No Transaksi" required>
								<span class="form-text text-muted">Contoh : 202312-001</span>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Tanggal Transaksi<span class="text-danger">*</span></label>
							<div class="col-lg-10">
                                <input type="date" name="tgl_transaksi" class="form-control border-teal pickadate-accessibility" value="{{date('Y-m-d')}}" required>
                            </div>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Nama Customer<span class="text-danger">*</span></label>
							<div class="col-lg-10">
								<input type="text" name="customer" class="form-control border-teal border-1 phone-number" placeholder="Nama Customer" required>
							</div>
						</div>
					</fieldset>
                </div>
            </div>
            <!-- /hover rows -->
        </div>
        <div class="content">

            <!-- Form action components -->
            <div class="mb-3">
                <legend class="text-uppercase font-size-sm font-weight-bold">Barang yang dibeli</legend>
            </div>

            <div class="row">
                <div class="col-md-4 control-group">
                    <!-- Text + button -->
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h6 class="card-title">Barang 1</h6>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label>Barang<span class="text-danger">*</span></label>
                                <select name="kode_barang_id[0]"
                                    class="form-control form-control-select2 kode_barang_id" required>
                                    <option option value="">-- Pilih Barang --</option>
                                    @foreach ($barangs as $barang)
                                    <option data-harga="{{$barang->harga}}" value="{{$barang->kode_barang}}">{{$barang->nama_barang}} - {{ number_format($barang->harga, 0, ',', '.') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Barang<span class="text-danger">*</span></label>
                                <input type="number" name="qty[0]" class="form-control qty"
                                    placeholder="Jumlah Barang" required>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" name="harga[0]" class="form-control border-teal border-1 font-weight-bold harga" placeholder="Terisi Otomatis" required readonly>
                            </div>
                            <div class="form-group">
                                <label>Kode Promo</label>
                                <select name="kode_promo_id[0]"
                                    class="form-control form-control-select2 kode_promo_id">
                                    <option option value="">-- Pilih Kode --</option>
                                    @foreach ($promos as $promo)
                                    <option data-harga="{{$promo->potongan}}" value="{{$promo->kode_promo}}">{{$promo->nama_promo}} - {{ number_format($promo->potongan, 0, ',', '.') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Diskon</label>
                                <input type="text" name="discount[0]" class="form-control border-teal border-1 font-weight-bold discount" placeholder="Terisi Otomatis" required readonly>
                            </div>
                            <div class="form-group">
                                <label>Sub Total</label>
                                <input type="text" name="subtotal[0]" class="form-control border-teal border-1 font-weight-bold subtotal" placeholder="Terisi Otomatis" required readonly>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" id="add_row" class="btn btn-light"><i
                                        class="fas fa-fw fa-plus-circle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="row"></div>
            </div>
        </div>
        <div class="content">

            <!-- Hover rows -->
            <div class="card">
			    <div class="card-body">
					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">Total Bayar</legend>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Total Bayar</label>
							<div class="col-lg-10">
								<input type="text" name="total_bayar" id="total_bayar" class="form-control border-teal border-1 phone-number" placeholder="Terisi Otomatis" required readonly>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">PPN</label>
							<div class="col-lg-10">
								<input type="text" name="ppn" id="ppn" class="form-control border-teal border-1 phone-number" placeholder="Terisi Otomatis" required readonly>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-form-label col-lg-2">Grand Total</label>
							<div class="col-lg-10">
								<input type="text" name="grand_total" id="grand_total" class="form-control border-teal border-1 phone-number" placeholder="Terisi Otomatis" required readonly>
							</div>
						</div>
					</fieldset>
                    <div class="text-right">
						<a href="{{ url('/promo') }}" class="btn btn-secondary">Kembali <i class="fas fa-fw fa-undo"></i></a>
						<button type="submit" class="btn btn-primary submitBtn">Simpan <i class="fas fa-fw fa-paper-plane"></i></button>
					</div>
                </div>
            </div>
            <!-- /hover rows -->
        </div>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script type="text/javascript">
        let i = 1;

        $("body").on("click", "#add_row", function () {
            html = '';
            html +=
                '<div class="col-md-4 control-group">' +
                '<div class="card">' +
                '<div class="card-header header-elements-inline">' +
                '<h6 class="card-title">Barang ' + parseInt(i + 1) + '</h6>' +
                '</div>' +
                '<div class="card-body">' +
                '<div class="form-group">' +
                    '<label>Barang<span class="text-danger">*</span></label>' +
                    '<select name="kode_barang_id[' + i + ']" class="form-control form-control-select2 kode_barang_id" required>' +
                        '<option option value="">-- Pilih Barang --</option>' +
                        '@foreach ($barangs as $barang)' +
                        '<option data-harga="{{$barang->harga}}" value="{{$barang->kode_barang}}">{{$barang->nama_barang}} - {{ number_format($barang->harga, 0, ',', '.') }}</option>' +
                        '@endforeach' +
                    '</select>' +
                '</div>' +
                '<div class="form-group">' +
                    '<label>Jumlah Barang<span class="text-danger">*</span></label>' +
                    '<input type="number" name="qty[' + i + ']" class="form-control qty" placeholder="Jumlah Barang" required>' +
                '</div>' +
                '<div class="form-group">' +
                    '<label>Harga</label>' +
                    '<input type="text" name="harga[' + i + ']" class="form-control border-teal border-1 font-weight-bold harga" placeholder="Terisi Otomatis" required readonly>' +
                '</div>' +
                '<div class="form-group">' +
                    '<label>Kode Promo</label>' +
                    '<select name="kode_promo_id[' + i + ']"' +
                        'class="form-control form-control-select2 kode_promo_id">' +
                        '<option option value="">-- Pilih Kode --</option>' +
                        '@foreach ($promos as $promo)' +
                        '<option data-harga="{{$promo->potongan}}" value="{{$promo->kode_promo}}">{{$promo->nama_promo}} - {{ number_format($promo->potongan, 0, ',', '.') }}</option>' +
                        '@endforeach' +
                    '</select>' +
                '</div>' +
                '<div class="form-group">' +
                    '<label>Diskon</label>' +
                    '<input type="text" name="discount[' + i + ']" class="form-control border-teal border-1 font-weight-bold discount" placeholder="Terisi Otomatis" required readonly>' +
                '</div>' +
                '<div class="form-group">' +
                    '<label>Sub Total</label>' +
                    '<input type="text" name="subtotal[' + i + ']" class="form-control border-teal border-1 font-weight-bold subtotal" placeholder="Terisi Otomatis" required readonly>' +
                '</div>' +
                '<div class="d-flex justify-content-end align-items-center">' +
                '<button type="button" id="remove_row" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i></button>' +
                '</div></div></div></div>';

            $("#row").before(html);

            // var $select = $('.form-control-select2').select2();
            i++;
        });

        $("body").on("click", "#remove_row", function () {
            i = 1;
            $(this).parents(".control-group").remove();
            jumlahPenjualan();  // Recalculate the totals after a row is removed
        });
        function jumlahPenjualan() {
            var totalBayar = 0;

            // Loop through each row of items
            $(".control-group").each(function(index, element) {
                var harga = parseFloat($(element).find('.kode_barang_id option:selected').data('harga')) || 0;
                var qty = parseInt($(element).find('.qty').val()) || 0;
                var discount = parseFloat($(element).find('.kode_promo_id option:selected').data('harga')) || 0;

                var hargaTotal = harga * qty;
                var subTotal = hargaTotal - discount;

                // Format the values
                var formattedHargaTotal = hargaTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                var formattedDiscount = discount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                var formattedSubTotal = subTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                // Update the fields for the current row
                $(element).find('.harga').val(formattedHargaTotal);
                $(element).find('.discount').val(formattedDiscount);
                $(element).find('.subtotal').val(formattedSubTotal);

                // Add to total bayar
                totalBayar += subTotal;
            });

            // Calculate PPN and Grand Total
            var ppn = Math.floor(totalBayar * 11 / 100);  // Round down the PPN
            var grandTotal = Math.floor(totalBayar + ppn);  // Round down the Grand Total

            // Format the values for total bayar, ppn, and grand total
            var formattedTotalBayar = totalBayar.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            var formattedPpn = ppn.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            var formattedGrandTotal = grandTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            // Update the total bayar, ppn, and grand total fields
            $('#total_bayar').val(formattedTotalBayar);
            $('#ppn').val(formattedPpn);
            $('#grand_total').val(formattedGrandTotal);
        }
        $(document).ready(function() {
            // Event handler for the first row (Barang 1) which is initially present on the page
            $('.kode_barang_id, .qty, .kode_promo_id').on("change", function () {
                jumlahPenjualan();
            });

            // Event handler for dynamically added rows (Barang 2, 3, etc.)
            $(document).on("change", ".kode_barang_id, .qty, .kode_promo_id", function () {
                jumlahPenjualan();
            });
        });

    </script>
    <script>
        function ribuan2(element){
            var val = element.val();
            val = val.replace(/[^\d]/g, '');
            val = val.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            element.val(val);
        }
        $( document ).ready(function() {
            // var $select = $('.form-control-select2').select2();
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
