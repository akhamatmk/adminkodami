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
				<a id="add-vendor" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-plus"></i> TAMBAH VENDOR</a>
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
					<table class="table color-table info-table" id="vendor-table">
				        <thead>
				            <tr>
				                <th>No</th>
				                <th>Name</th>
				                <th>Code</th>
				                <th>PIC</th>
				                <th>Telephone</th>
				                <th>Email</th>
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
					<form id="form-vendor" class="form-horizontal" action="{{ URL("vendor") }}" method="post">
						@csrf 

						<div class="form-group">
						    <label class="control-label col-sm-3" for="name">Nama Vendor:</label>
						    <div class="col-sm-9">
						      <input type="name" class="form-control" id="name" name="name" placeholder="Nama Vendor">
						    </div>
						</div>

						<div class="form-group">
						    <label class="control-label col-sm-3" for="code">Code Vendor:</label>
						    <div class="col-sm-9">
						      <input type="code" class="form-control" id="code" name="code" placeholder="Code Vendor">
						    </div>
						</div>

						<div class="form-group">
						    <label class="control-label col-sm-3" for="currency">Currency:</label>
						    <div class="col-sm-9">
						    	<select class="form-control" id="currency" name="currency">
						    		<option value="0">-- Silahkan pilih -</option>
						    		<?php 
						    			foreach (config('constanta.currency') as $key => $value) {
						    				if($key !=0 )
						    					echo "<option value='".$key."'>".$value."</option>";
						    			}
						    		?>
						    	</select> 
						    </div>
						</div>						

						<div class="form-group">
							<label class="control-label col-sm-3" for="pic">PIC:</label>
							<div class="col-sm-9">
								<input type="text" name="pic" class="form-control" id="pic" placeholder="PIC">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="telephone">Telephone:</label>
							<div class="col-sm-9">
								<input type="text" name="telephone" class="form-control" id="pic" placeholder="Telephone">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="email">Email:</label>
							<div class="col-sm-9">
								<input type="email" name="email" class="form-control" id="email" placeholder="Email">
							</div>
						</div>						

					</form>
				</div>
			
				<div class="modal-footer">
					<a id="submit" class="btn btn-primary">Submit</a>
					<input type="hidden" id="type" value="post">
					<input type="hidden" id="id" value="0" name="id">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

@endsection

@section('script')
	<script>
	    $(function() {
	    	var table = $('#vendor-table').DataTable({
		        processing: true,
		        serverSide: true,
		        ajax: '{{ URL::to("vendor/getData") }}',
		        columns: [
		            { data: 'id', name: 'id' },
		            { data: 'name', name: 'name' },
		            { data: 'code', name: 'code' },
		            { data: 'pic', name: 'pic' },
		            { data: 'telephone', name: 'telephone' },
		            { data: 'email', name: 'email' },
		            { data: 'action', name: 'action' }
		        ]
		    });

	    	$("#add-vendor").click(function(){
	    		$("#type").val('post');
	    		$("#id").val(0);
	    		$("#myModal").modal("show");
	    	});

	    	$(".edit-vendor").click(function(){
	    		var id = $(this).data('id');
	    		alert(id);
	    	});

	    	$(".delete-vendor").click(function(){
	    		var id = $(this).data('id');
	    		alert(id);
	    	});

	    	$("#submit").click(function(){
	    		var type = $("#type").val();
	    		var url = "{{ URL('vendor') }}";

	    		$.ajax({
	    			type: type,
					url: url,
					data : $("#form-vendor").serialize(),
					dataType: 'json',
					success: function(data){
						$("#myModal").modal("hide");
						table.ajax.reload();
					}
	    		});
	    	});

		});
	</script>
@endsection