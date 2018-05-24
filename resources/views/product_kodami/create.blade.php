@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')

	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a href="{{ URL('product') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-reply"></i> Back Product</a>
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
				<h3 class="box-title">Form Add Product</h3>
				<form class="form-horizontal" method="POST" action="{{ URL("product") }}">
					@csrf 

					<div class="form-group">
					    <label class="control-label col-sm-3" for="name">Name Product:</label>
					    <div class="col-sm-9">
					    	<input type="text" name="name" id="name" class="form-control">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="category">Category:</label>
					    <div class="col-sm-3">
					    	<select class="form-control" name="category" id="category">
					    		<option value="0">- Silahkan Pilih -</option>
					    		@foreach($category as $key => $value)
					    			<option value="{{ $value->id }}">{{ $value->name }}</option>
					    		@endForeach
					    	</select>

					    	<select style="margin-top: 10px; display: none;" class="form-control" name="category2" id="category2">
					    		<option value="0">- Silahkan Pilih -</option>
					    	</select>

					    	<select style="margin-top: 10px ; display: none;" class="form-control" name="category3" id="category3">
					    		<option value="0">- Silahkan Pilih -</option>					    		
					    	</select>
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="weight">Berat Barang :</label>
					    <div class="col-sm-9">
					    	<input type="number" step="0.01" name="weight" id="weight" class="form-control">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="stock">Stock :</label>
					    <div class="col-sm-9">
					    	<input type="number" name="stock" id="stock" class="form-control">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="min_order">Min Order :</label>
					    <div class="col-sm-9">
					    	<input type="number" name="min_order" id="min_order" class="form-control">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="min_order">Upload Image :</label>
					    <div class="col-sm-9">
					    	<div id="dropzone" class="dropzone"></div>
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
	            maxFilesize: 8, 
	            paramName: "image", 
	            addRemoveLinks: true,
	            sending: function(file, xhr, formData) {
    				formData.append("_token", "{{ csrf_token() }}");
				},
	        });
		});
	</script>
@endsection