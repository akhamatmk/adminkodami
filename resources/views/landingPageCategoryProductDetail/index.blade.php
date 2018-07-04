@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')
	<style type="text/css">
		
		select + .select2-container {
		  width: 100% !important;
		}
	</style>

	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a class="add btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-plus"></i> Edit Product Category {{ $dataCategory->name}}</a>
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
				<h3 class="box-title">Product Pilihan dari Category {{ $dataCategory->name}}</h3>
				<div class="table-responsive">				
					<table class="table color-table info-table" id="landing-category-detail-table">
				        <thead>
				            <tr>
				                <th>No</th>
				                <th>Nama Product</th>
				                <th>Image</th>
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
					<form>
					  	<div class="form-group">
							<label for="name">Name</label>
							<select class="form-control" id="product" multiple="multiple">
								@foreach($KodamiProduct as $key => $value)
									@if(in_array($value->id, $dataProduct))
										@php ($select = 'selected="selected"')
									@else
										@php ($select = '')
									@endIf

									<option {{ $select }} value="{{ $value->id }}">{{$value->name}}</option>
								@endForeach
							</select>
						</div>
					</form>
				</div>
			
				<div class="modal-footer">
					<button type="button" id="submit" class="btn btn-primary">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

@endsection

@section('script')
	<script>
		$('#product').select2({
		    dropdownAutoWidth : true,
		    width: 'auto'
		});

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
				    	document.location = "{{ URL('landing/page/category/product/'.$dataCategory->id.'/detail/delete') }}/"+id;
				  	} else {
				    	swal("Your imaginary file is safe!");
				  	}
				});

			})				
		}
	

		$(".add").click(function(){
			$("#id_landing").val(0);
			$("#type").val("new");
			$("#name").val("");
			$('#myModal').modal('show');
		})

		$("#submit").click(function(){
			$.ajax({
    			type: "POST",
				url: "{{ URL('landing/page/category/product/'.$dataCategory->id.'/detail') }}",
				dataType: 'json',
				data :{
					'_token': '{{ csrf_token() }}',
					'value': $('#product').val()
				},
				success: function(data){
					$('#myModal').modal('hide');
					swal({title: "data has been save", text: "!", icon:"success"}).then(function(){ 
				   		location.reload();
				   	});
				}
    		});
		});

		var table = $('#landing-category-detail-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{{ URL::to("landing/page/category/product/".$dataCategory->id."/detail/data") }}',
	        initComplete: function( settings, json ) {
		        remove();
  			},
	        columns: [
	            { data: 'row', name: 'row' },
	            { data: 'name', name: 'name' },
	            { data: 'image', name: 'image' },
	            { data: 'action', name: 'action' },
	        ]
	    });
	</script>
@endsection