@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')
	
	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a href="{{ URL('salesAndDistribution/create') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-plus"></i> TAMBAH SALES AND DISTRIBUTION</a>
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
				<h3 class="box-title">Sales And Distribution</h3>
				<div class="table-responsive">				
					<table class="table color-table info-table" id="salesanddistribution-table">
				        <thead>
				            <tr>
				                <th>No</th>
				                <th>Kodami Product</th>
				                <th>Vendor</th>
				                <th>Price</th>
				                <th>Valid Until</th>
				                <th>Min Order</th>
				                <th></th>
				            </tr>
				        </thead>
    				</table>
				</div>
			</div>
	   </div>
	</div>

	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header</h4>
				</div>

				<div class="modal-body">
					<form id="form-sales" class="form-horizontal">
						@csrf 

						<div class="form-group">
					    <label class="control-label col-sm-3" for="vendor_id">Vendor:</label>
					    <div class="col-sm-9">
					    	<select class="form-control" id="vendor_id" name="vendor_id">
					    		<option value="0">-- SIlahkan Pilih Vendornya --</option>
				    			@foreach($vendor as $key => $value)
				    				<option value="{{ $value->id }}">{{ $value->name }}</option>
							    @endForeach
					    	</select>
					      
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="kodami_product_id">Product:</label>
					    <div class="col-sm-9">
					    	<select class="form-control" id="kodami_product_id" name="kodami_product_id">
					    		<option value="0">-- SIlahkan Pilih Product --</option>
				    			@foreach($product as $key => $value)
				    				<option value="{{ $value->id }}">{{ $value->name }}</option>
							    @endForeach
					    	</select>
					      
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="price">Price:</label>
					    <div class="col-sm-9">
					    	<input type="text" name="price" id="price" data-precision="0" placeholder="Price" class="form-control money">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="valid_until">Valid Until:</label>
					    <div class="col-sm-9">
					    	<input type="text" name="valid_until" id="valid_until" placeholder="Valid Until" class="form-control date">
					    </div>
					</div>
					
					<div class="form-group">
					    <label class="control-label col-sm-3" for="min_order">Min Order</label>
					    <div class="col-sm-9">
					    	<input type="number" name="min_order" id="min_order" placeholder="Min Order" class="form-control">
					    </div>
					</div>						

					</form>
				</div>
			
				<div class="modal-footer">
					<a id="submit" class="btn btn-primary">Submit</a>
					<input type="hidden" id="id" value="0" name="id">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

@endsection

@section('script')
	<script>
			function delete_row()
			{
				$(".delete").click(function(e) {
					var id = $(this).data('id');

					if(confirm("Are you sure delete data ?")){

						$.ajax({
			    			type: "DELETE",
							url: "{{ URL('salesAndDistribution') }}/"+id,
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

			function edit_row()
			{
				$(".edit").click(function(){
					var id = $(this).data('id');
					$.ajax({
		    			type: "GET",
						url: "{{ URL('salesAndDistribution') }}/"+id+"/edit",
						dataType: 'json',
						success: function(data){
							$("#kodami_product_id").val(data.kodami_product_id);
				    		$("#vendor_id").val(data.vendor_id);
				    		$("#price").val(data.price);
				    		$("#valid_until").val(data.valid_date);
				    		$("#min_order").val(data.min_order);
				    		$("#id").val(data.id);
						}
		    		});	

					$("#myModal").modal('show');
				});
			}

	    $(function() {
	    	$('.money').maskMoney();
	    	var table = $('#salesanddistribution-table').DataTable({
		        processing: true,
		        serverSide: true,
		        ajax: '{{ URL::to("salesAndDistribution/getData") }}',
		        initComplete: function( settings, json ) {
		        	delete_row();
		        	edit_row();
  				},
		        columns: [
		            { data: 'row', name: 'row' },
		            { data: 'product_name', name: 'product_name' },
		            { data: 'vendor_name', name: 'vendor_name' },
		            { data: 'price', name: 'price' },
		            { data: 'valid_date', name: 'valid_date' },
		            { data: 'min_order', name: 'min_order' },
		            { data: 'action', name: 'action' }
		        ]
		    });

	    	$("#submit").click(function(){
	    		$.ajax({
	    			type: "PUT",
					url: "{{ URL('salesAndDistribution') }}/"+$("#id").val(),
					dataType: 'json',
					data: $("#form-sales").serialize(),
					success: function(data){
						$("#myModal").modal('hide');
						swal({title: "Succes Updated ?", text: "!", icon:"success"}).then(function(){ 
						   	location.reload();
						   }
						);
					}
	    		});
	    	});

		    
		});
	</script>
@endsection