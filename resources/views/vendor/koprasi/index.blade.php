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
					<li class="active">Dashboard</li>
				</ol>
       	</div>
       <!-- /.col-lg-12 -->
    </div>

	<div class="row">
	   	<div class="col-sm-12">
	      	<div class="white-box">
				<h3 class="box-title">Vendor Koprasi</h3>
				<div class="table-responsive">				
					<table class="table color-table info-table" id="vendor-unregister-table">
				        <thead>
				            <tr>
				                <th>No</th>
				                <th>Name Koprasi</th>
				                <th>Slogan</th>
				                <th width="40%">Deskripsi</th>
				                <th>Postal Code</th>
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
		var table = $('#vendor-unregister-table').DataTable({
		        processing: true,
		        serverSide: true,
		        ajax: '{{ URL::to("vendor/koprasi/getUnregisteredUser") }}',
		        columns: [
		            { data: 'row', name: 'row' },
		            { data: 'name', name: 'name' },
		            { data: 'slogan', name: 'slogan' },
		            { data: 'description', name: 'description' },
		            { data: 'postal_code', name: 'postal_code' },
		            { data: 'image', name: 'image' },
		            { data: 'action', name: 'action' }
		        ]
		    });	    
	</script>
@endsection