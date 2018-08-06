@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')
	
	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>				
				<ol class="breadcrumb">
					<li><a href="javascript:void(0)">Dashboard</a></li>
					<li class="active">Dashboard 1</li>
				</ol>
       	</div>
       <!-- /.col-lg-12 -->
    </div>

	<div class="row">
	   	<div class="col-sm-12">
	      	<div class="white-box">
				<h3 class="box-title">Transaktion</h3>
				<div class="table-responsive">				
					<table class="table color-table info-table" id="transaction-saldo-table">
				        <thead>
				            <tr>
				                <th>No</th>
				                <th>Code Transaksi</th>
				                <th>Jumlah Topup Saldo</th>
				                <th>Random Fee</th>
				                <th>Total Pembayaran</th>
				                <th>Jenis Pembayaran</th>
				                <th>Status Transaksi</th>
				                <th></th>
				            </tr>
				        </thead>
    				</table>
				</div>
			</div>
	   </div>
	</div>

@endsection

@section('script')
	<script>

		function change()
		{
			$(".change").click(function(){
				var id = $(this).data("id");
				var type = $(this).data("change");

				swal({
				  	title: "Are you sure Change?",
				  	text: "If not your data will'n change!",
				  	icon: "warning",
				  	buttons: true,
				  	dangerMode: true,
				})
				.then((willDelete) => {
				  	if (willDelete) {
				    	document.location = "{{ URL('transaction/saldo/change') }}/"+id+"/"+type;
				  	} else {
				    	swal("Your Data is safe!");
				  	}
				});

			})				
		}

		var table = $('#transaction-saldo-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{{ URL::to("transaction/saldo/data") }}',
	        initComplete: function( settings, json ) {
		        change();
  			},
	        columns: [
	            { data: 'row', name: 'row' },
	            { data: 'transaction_code', name: 'transaction_code' },
	            { data: 'price', name: 'price_product' },
	            { data: 'feerandom', name: 'fee_random' },
	            { data: 'total', name: 'total' },
	            { data: 'typepayment', name: 'type_payment' },
	            { data: 'status', name: 'status' },
	            { data: 'action', name: 'action' },
	        ]
	    });		
	</script>
@endsection