@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')
	
	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a href="{{ URL('advertisement') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-back"></i> Back Special Offer</a>
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
				<form class="form-horizontal" method="POST" action='{{ URL("specialoffer/".$special->id."/edit") }}'>
					@csrf 							
					<div class="form-group">

					    <label class="control-label col-sm-3">Product :</label>
					    <div class="col-sm-5">
					    	<select class="form-control" name="product" id="product">
					    		@foreach($product as $key => $value)
					    			@php
										$select = ""
									@endphp

					    			@if($value->id == $special->kodami_product_id)
					    				@php
											$select = 'selected="selected"'
										@endphp				    			
					    			@endIf
 
					    			<option {{ $select }} value="{{ $value->id }}">{{ $value->name }}</option>
					    		@endForeach
					    	</select>
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3">Short Deskripsi :</label>
					    <div class="col-sm-9">
					    	<textarea name="short_description" class="form-control" rows="4">{{ $special->short_description }}</textarea>
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3">Long Deskripsi :</label>
					    <div class="col-sm-9">
					    	<textarea name="long_description" class="form-control wysy" rows="4">{{ $special->long_description }}</textarea>
					    </div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">Save Money :</label>
						<div class="col-sm-9">
					    	<input type="number" name="save_money" class="form-control" value="{{ $special->save_money }}">
					    </div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">Expired Time :</label>
						<div class="col-sm-9">
					    	<input type="text" name="valid_until" id="expired_time"  class="form-control date" value="{{ $special->expired_time }}" >
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3">Image :</label>
					    <div class="col-sm-5">
					    	<div id="dropzone" class="dropzone"></div>
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3">Old Image :</label>
					    <div class="col-sm-5">
					    	<img src="{{$special->image}}">
					    	<input type="hidden" name="old_image" value="{{ $special->image }}">
					    </div>
					</div>
		      		
					<div id="image">
						
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3"></label>
					    <div class="col-sm-5">
					    	<div id="pretty-scale-test">						        
						        <div class="pretty p-round p-fill p-icon">
						        	@php
										$checked = ''
									@endphp	

						        	@if(1 == $special->status)
					    				@php
											$checked = 'checked="checked"'
										@endphp				    			
					    			@endIf

						            <input {{ $checked }} type="checkbox" name='active' value="1" />
						            <div class="state p-info">
						                <i class="icon mdi mdi-check"></i>
						                <label>Active</label>
						            </div>
						        </div>
						    </div>
					    </div>
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

			CKEDITOR.replaceClass = "wysy"		

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