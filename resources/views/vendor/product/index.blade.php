@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')
	
	<style type="text/css">
		.modal-content{
		    position: relative;
		    display: table; /* This is important */ 
		    overflow-y: auto;    
		    overflow-x: auto;
		    width: auto;
		    min-width: 140%;   
		}
	</style>

	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a href="{{ url('vendor') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-plus"></i> BACK VENDOR</a>
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
				<h3 class="box-title">Vendor</h3>
				<div class="table-responsive">				
					<table class="table color-table info-table" id="vendor-product-table">
				        <thead>
				            <tr>
				                <th>No</th>
				                <th>Nama</th>
				                <th>Alias</th>
				                <th>Category</th>
				                <th>Status Product</th>
				                <th>Price</th>
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
	    $(function() {
	    	var table = $('#vendor-product-table').DataTable({
		        processing: true,
		        serverSide: true,
		        ajax: '{{ URL::to("vendor/".$vendor->id."/product/show") }}',
		        columns: [
		            { data: 'row', name: 'row' },
		            { data: 'name', name: 'name' },
		            { data: 'name_alias', name: 'name_alias' },
		            { data: 'category_name', name: 'category_name' },
		            { data: 'is_validated', name: 'is_validated' },
		            { data: 'price', name: 'price' },
		            { data: 'image', name: 'image' },
		            { data: 'action', name: 'action' },
		        ]
		    });
		});
	</script>
@endsection