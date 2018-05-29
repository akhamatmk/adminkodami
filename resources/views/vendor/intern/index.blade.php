@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')

	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a href="{{ URL('vendor/intern/create') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-plus"></i> TAMBAH VENDOR</a>
				<ol class="breadcrumb">
					<li><a href="javascript:void(0)">Dashboard</a></li>
					<li class="active">Dashboard</li>
				</ol>
       	</div>
       <!-- /.col-lg-12 -->
    </div>

	<div class="row">
	   	<div class="col-sm-12">
	      	<div class="white-box">
				<h3 class="box-title">Vendor Intern</h3>
				<div class="table-responsive">				
					<table class="table color-table info-table" id="vendor-intern-table">
				        <thead>
				            <tr>
				                <th>No</th>
				                <th>Name Vendor</th>
				                <th>Vendor Code</th>
				                <th>PIC</th>
				                <th>Username</th>
				                <th>Email</th>
				                <th>Telephone</th>
				                <th>Detail Address</th>
				                <th></th>
				            </tr>
				        </thead>
    				</table>
				</div>
			</div>
	   </div>
	</div>

	<div class="row">
	   	<div class="col-sm-12">
	      	<div class="white-box">
				<h3 class="box-title">Vendor From Koprasi</h3>
				<div class="table-responsive">				
					<table class="table color-table info-table" id="vendor-koprasi-table">
				        <thead>
				            <tr>
				                <th>No</th>
				                <th>Name Vendor</th>
				                <th>Vendor Code</th>
				                <th>PIC</th>
				                <th>Username</th>
				                <th>Email</th>
				                <th>Telephone</th>
				                <th>Detail Address</th>
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
	    $(function() {

	    	function remove()
			{
				$(".delete").click(function(){
					var id = $(this).data("id");

					swal({
					  	title: "Are you sure?",
					  	text: "Once deleted, you will not be able to recover this imaginary file!",
					  	icon: "warning",
					  	buttons: true,
					  	dangerMode: true,
					})
					.then((willDelete) => {
					  	if (willDelete) {
					    	document.location = "{{ URL('vendor/intern/destroy') }}/"+id;
					  	} else {
					    	swal("Your imaginary file is safe!");
					  	}
					});

				})				
			}   

	    	var table = $('#vendor-intern-table').DataTable({
		        processing: true,
		        serverSide: true,
		        ajax: '{{ URL::to("vendor/intern/getData") }}',
		        initComplete: function( settings, json ) {
		        	remove();
  				},
		        columns: [
		            { data: 'row', name: 'row' },
		            { data: 'name', name: 'name' },
		            { data: 'code', name: 'code' },
		            { data: 'pic', name: 'pic' },
		            { data: 'username', name: 'username' },
		            { data: 'email', name: 'email' },
		            { data: 'telephone', name: 'telephone' },
		            { data: 'detail_address', name: 'detail_address' },
		            { data: 'action', name: 'action' }
		        ]
		    });

		    var table2 = $('#vendor-koprasi-table').DataTable({
		        processing: true,
		        serverSide: true,
		        ajax: '{{ URL::to("vendor/koprasi/getData") }}',
		        initComplete: function( settings, json ) {
		        	remove();
  				},
		        columns: [
		            { data: 'row', name: 'row' },
		            { data: 'name', name: 'name' },
		            { data: 'code', name: 'code' },
		            { data: 'pic', name: 'pic' },
		            { data: 'username', name: 'username' },
		            { data: 'email', name: 'email' },
		            { data: 'telephone', name: 'telephone' },
		            { data: 'detail_address', name: 'detail_address' },
		            { data: 'action', name: 'action' }
		        ]
		    });

		 	
		});
	</script>
@endsection