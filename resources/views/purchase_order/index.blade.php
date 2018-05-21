@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')

	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a href="{{ URL('purchase-order/create') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-plus"></i> TAMBAH PO</a>
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
				<h3 class="box-title">Purchase Order</h3>
				<div class="table-responsive">				
					<table class="table color-table info-table" id="prichase_order-table">
				        <thead>
				            <tr>
				                <th>No</th>
				                <th>PO Number</th>
				                <th>Rfq Number</th>
				                <th>Vendor</th>
				                <th>Doc Date</th>
				                <th>Email</th>
				                <th>Ship Via</th>
				                <th>Tax (%)</th>
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
	    	var table = $('#prichase_order-table').DataTable({
		        processing: true,
		        serverSide: true,
		        ajax: '{{ URL::to("purchase-order/getData") }}',
		        columns: [
		            { data: 'row', name: 'row' },
		            { data: 'po_number', name: 'row' },
		            { data: 'rfq', name: 'rfq' },
		            { data: 'vendor', name: 'vendor' },
		            { data: 'doc_date', name: 'doc_date' },
		            { data: 'email', name: 'email' },
		            { data: 'ship_via', name: 'ship_via' },
		            { data: 'tax', name: 'tax' },
		            { data: 'action', name: 'action' },
		        ]
		    });
		});
	</script>
@endsection