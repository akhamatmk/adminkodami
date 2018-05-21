@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')
	
	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a href="{{ URL('requestForQuotation/create') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-plus"></i> TAMBAH Request For Quotation</a>
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
				<h3 class="box-title">Request For Qoutation</h3>
				<div class="table-responsive">				
					<table class="table color-table info-table" id="requestforquotation-table">
				        <thead>
				            <tr>
				                <th>No</th>
				                <th>Case ID</th>
				                <th>Purchase Type</th>
				                <th>Document Title</th>
				                <th>Solicitation Type</th>
				                <th>Currency</th>
				                <th>Detail Delivery Address</th>
				                <th>Efective Date</th>
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

			function delete_row()
			{
				$(".delete").click(function(e) {
					var id = $(this).data('id');

					if(confirm("Are you sure delete data ?")){

						$.ajax({
			    			type: "DELETE",
							url: "{{ URL('requestForQuotation') }}/"+id,
							dataType: 'json',
							data: {
					        	"_token": "{{ csrf_token() }}"
					        },
							success: function(data){
								swal({title: "data has been deleted", text: "!", icon:"warning"}).then(function(){ 
								   		location.reload();
								   	}
								);
							}
			    		});	
					}
				});
			}

			var table = $('#requestforquotation-table').DataTable({
		        processing: true,
		        serverSide: true,
		        ajax: '{{ URL::to("requestForQuotation/getData") }}',
		        initComplete: function( settings, json ) {
		        	delete_row();
  				},
		        columns: [
		            { data: 'row', name: 'row' },
		            { data: 'case_id', name: 'case_id' },
		            { data: 'purchase_type', name: 'purchase_type' },
		            { data: 'document_title', name: 'document_title' },
		            { data: 'solicitation_type', name: 'solicitation_type' },
		            { data: 'currency', name: 'currency' },
		            { data: 'detail_delivery_address', name: 'detail_delivery_address' },
		            { data: 'effective_date', name: 'effective_date' },
		            { data: 'action', name: 'action' },
		        ]
		    });
		});
	</script>
@endsection