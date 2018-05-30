@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')
	
	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a href="{{ URL('banners') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-back"></i> BACK BANNER</a>
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
				<h3 class="box-title">Form Banner</h3>
				<form class="form-horizontal" method="POST" action="{{ URL("banners") }}">
					@csrf 

					<div class="form-group">
					    <label class="control-label col-sm-3" for="order">Order:</label>
					    <div class="col-sm-9">
					      	<input type="number" class="form-control" name="order" id="order">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="vendor_id">Deksripsi:</label>
					    <div class="col-sm-9">
					      	<textarea name="deskripsi" rows="5" class="form-control"></textarea>
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3">primary Image :</label>
					    <div class="col-sm-5">
					    	<div id="dropzone" class="dropzone"></div>
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3"></label>
					    <div class="col-sm-5">
					    	<div id="pretty-scale-test">						        
						        <div class="pretty p-round p-fill p-icon">
						            <input type="checkbox" name='active' value="1" />
						            <div class="state p-info">
						                <i class="icon mdi mdi-check"></i>
						                <label>Active</label>
						            </div>
						        </div>
						    </div>
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
					$("#image").append($("<input id='"+file.upload.uuid+"' value='"+response+"' type='hidden' name='banner_image' >"));
	            }
	        });

		});		
	</script>
@endsection