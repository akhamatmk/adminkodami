@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')

	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a href="{{ URL('product/create') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-plus"></i> Tambah Product</a>
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
				<h3 class="box-title">Kodami Product</h3>
				<div class="table-responsive">				
					<table class="table color-table info-table" id="product-table">
				        <thead>
				            <tr>
				                <th>No</th>
				                <th>Name</th>
				                <th>Name Alias</th>
				                <th>Image</th>
				                <th>Price</th>
				                <th>Stock</th>
				                <th width="30%">Description</th>
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
	    	var table = $('#product-table').DataTable({
		        processing: true,
		        serverSide: true,
		        ajax: '{{ URL::to("product/getData") }}',
		        columns: [
		            { data: 'row', name: 'row' },
		            { data: 'name', name: 'name' },
		            { data: 'name_alias', name: 'name_alias' },
		            { data: 'primary_image', name: 'primary_image' },
		            { data: 'price_format', name: 'price' },
		            { data: 'stock', name: 'stock' },
		            { data: 'description', name: 'description' },		            
		            { data: 'action', name: 'action' },
		        ]
		    });
		});
	</script>
@endsection