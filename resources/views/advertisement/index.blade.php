@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')
	
	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>				
				<a href="{{ URL('advertisement/create') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-plus"></i> TAMBAH Adsvertisement</a>
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
				<h3 class="box-title">Landing Page Advertisement</h3>
				<div class="table-responsive">				
					<table class="table color-table info-table" id="ads-table">
				        <thead>
				            <tr>
				                <th>No</th>
				                <th>Product</th>
				                <th>Image</th>
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
				    	document.location = "{{ URL('advertisement/destroy') }}/"+id;
				  	} else {
				    	swal("Your imaginary file is safe!");
				  	}
				});

			})				
		}

		var table = $('#ads-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{{ URL::to("advertisement/data") }}',
	        initComplete: function( settings, json ) {
		        remove();
  			},
	        columns: [
	            { data: 'row', name: 'row' },
	            { data: 'product_name', name: 'product_name' },
	            { data: 'image', name: 'image' },
	            { data: 'action', name: 'action' },
	        ]
	    });	
	</script>
@endsection