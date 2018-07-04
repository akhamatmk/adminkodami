@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')
	
	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a class="add btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-plus"></i> Tambah Category</a>
				<ol class="breadcrumb">
					<li><a href="javascript:void(0)">Dashboard</a></li>
					<li class="active">Dashboard 1</li>
				</ol>
       	</div>
       <!-- /.col-lg-12 -->
    </div>

	<div class="row">
	   	<div class="col-sm-8">
	      	<div class="white-box">
				<h3 class="box-title">Category</h3>
				<div class="table-responsive">				
					<table class="table color-table info-table" id="landing-category-table">
				        <thead>
				            <tr>
				                <th>No</th>
				                <th>Nama Category</th>
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
							<input type="text" class="form-control" id="name" placeholder="Enter Name">
						</div>
					</form>
				</div>
			
				<div class="modal-footer">
					<input type="hidden" id="id_landing" value="0" >
					<input type="hidden" id="type" value="post" >
					<button type="button" id="submit" class="btn btn-primary">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
				    	document.location = "{{ URL('landing/page/category/product/delete') }}/"+id;
				  	} else {
				    	swal("Your imaginary file is safe!");
				  	}
				});

			})				
		}

		function change()
		{
			$(".change").click(function(){
				var id = $(this).data("id");
				$("#id_landing").val(id);
				$("#type").val("edit");

				$.ajax({
	    			type: "GET",
					url: "{{ URL('landing/page/category/product') }}/"+id+'/edit',
					dataType: 'json',
					success: function(data){
						$("#name").val(data.name);
						$('#myModal').modal('show');
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
				url: "{{ URL('landing/page/category/product') }}",
				dataType: 'json',
				data :{
					'type' : $('#type').val(),
					'name' : $('#name').val(),
					'id' : $('#id_landing').val(),
					'_token': '{{ csrf_token() }}'
				},
				success: function(data){
					$('#myModal').modal('hide');
					swal({title: "data has been save", text: "!", icon:"success"}).then(function(){ 
				   		location.reload();
				   	});
				}
    		});
		});

		var table = $('#landing-category-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{{ URL::to("landing/page/category/product/data") }}',
	        initComplete: function( settings, json ) {
		        remove();
		        change();
  			},
	        columns: [
	            { data: 'row', name: 'row' },
	            { data: 'name', name: 'name' },
	            { data: 'action', name: 'action' },
	        ]
	    });
	</script>
@endsection