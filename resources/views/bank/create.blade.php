@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')
	
	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a href="{{ URL('bank') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-back"></i> Back Bank</a>
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
				<h3 class="box-title">Form Bank</h3>
				<form class="form-horizontal" method="POST" action="{{ URL("bank") }}">
					@csrf 
							

					<div class="form-group">
					    <label class="control-label col-sm-3">Nama Bank :</label>
					    <div class="col-sm-5">
							<input type="text" class="form-control" name="name" id="name">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3">Atas Nama :</label>
					    <div class="col-sm-5">
							<input type="text" class="form-control" name="owner" id="owner">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3">No Rekening :</label>
					    <div class="col-sm-5">
							<input type="text" class="form-control" name="no_rekening" id="no_rekening">
					    </div>
					</div>


					<div class="form-group">
					    <label class="control-label col-sm-3"> Image :</label>
					    <div class="col-sm-5">
					    	<div id="dropzone" class="dropzone"></div>
					    </div>
					</div>

					
		      		
					<div id="image">
						
					</div>

					<div class="form-group">
					    <div class="col-sm-2">
					    	<button type="submit" style="float: right;" id="add" class="btn btn-primary">Submit</button>
					    </div>
					</div>

				</form>
			</div>
	   </div>
	</div>	
@endsection

@section('script')
	<script>
		$(function() {

	        $("#dropzone").dropzone({ 
	            url: "{{ URL('upload/image') }}", 
	            maxFiles: 1,
	            paramName: "image", 
	            addRemoveLinks: true,
	            sending: function(file, xhr, formData) {
    				formData.append("_token", "{{ csrf_token() }}");
				},
				removedfile: function(file) {
				    $("#"+file.upload.uuid).remove();
				    file.previewElement.remove();
			    },
				success: function (file, response) {
					$("#image").append($("<input id='"+file.upload.uuid+"' value='"+response+"' type='hidden' name='image' >"));
	            }
	        });

		});		
	</script>
@endsection