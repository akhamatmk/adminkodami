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
					    	<select class="form-control cat" name="category" id="category">
					    		<option value="-1">- Silahkan Pilih -</option>
					    		@foreach($category as $key => $value)
					    			<option value="{{ $value->id }}">{{ $value->name }}</option>
					    		@endForeach
					    	</select>

					    	<select style="margin-top: 10px; display: none;" class="form-control cat" name="category2" id="category2">
					    		<option value="0">- Silahkan Pilih -</option>
					    	</select>

					    	<select style="margin-top: 10px ; display: none;" class="form-control cat" name="category3" id="category3">
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
					    <label class="control-label col-sm-3" for="min_order">Min Order :</label>
					    <div class="col-sm-9">
					    	<input type="number" name="min_order" id="min_order" class="form-control">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3">primary Image :</label>
					    <div class="col-sm-5">
					    	<div id="dropzone-primary" class="dropzone"></div>
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="min_order">Upload Image :</label>
					    <div class="col-sm-9">
					    	<div id="dropzone" class="dropzone"></div>
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="short_description">Short Deskripsi :</label>
					    <div class="col-sm-4">
					    	<textarea rows="5" class="form-control" name="short_description" id="short_description"></textarea>
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="long_description">Long Deskripsi :</label>
					    <div class="col-sm-9">
					    	<textarea rows="7" class="form-control" name="long_description" id="long_description"></textarea>
					    </div>
					</div>

					<div id="product-image">
						
					</div>

					<div id="spesification">
						
					</div>

					<div id="criteria">
						
					</div>
					
					<button style="float: right;" type="submit" class="btn btn-primary">Submit</button>
					<div class="clearfix"></div>
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
	            maxFiles: 5,
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
					$("#product-image").append($("<input id='"+file.upload.uuid+"' value='"+response+"' type='hidden' name='product_images[]' >"));
	            }
	        });

	        $("#dropzone-primary").dropzone({ 
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
					$("#product-image").append($("<input id='"+file.upload.uuid+"' value='"+response+"' type='hidden' name='product_image_primary' >"));
	            }
	        });

	        $("#category").change(function(){
	        	var id = $(this).val(); 
	        	$.ajax({
	        		type: 'GET',
					url: '{{ URL("category/ajaxGetChild") }}',
					data : { 'parent_id' : id },
					dataType: 'json',
					success: function(data){
						$("#category2").html('<option value="-1">-- Silahkan Pilih --</option>');
						$("#category2").hide();
						$("#category3").html('<option value="-1">-- Silahkan Pilih --</option>');
						$("#category3").hide();
						
						if(data.length > 0)
							$("#category2").show();
						
						$.each(data, function(key, val){
							$("#category2").append('<option value="'+val.id+'">'+val.name+'</option>');
						});
					}
	        	});
	        });

	        $(".cat").change(function(){
	        	var id = $(this).val();
	        	$.ajax({
	        		type: 'GET',
					url: '{{ URL("category/spesification") }}',
					data : { 'category_id' : id },
					dataType: 'json',
					success: function(data){
						$("#spesification").html("");
						if(data.length > 0)
							$("#spesification").html("<h1 align='center'><u>Spesification</u></h1>");
						$.each(data, function(key, val){
								var tr = '<div class="form-group">'+
					    					'<label class="control-label col-sm-3" for="short_description">'+val.label+':</label>' +
					    					'<div class="col-sm-4">'+
					    						'<input type="text" class="form-control" name="spesification['+key+'][value]" />'+
					    						'<input type="hidden" name="spesification['+key+'][label]" value='+val.id+' />'+
					    					'</div>'+
										'</div>';

							$("#spesification").append(tr);
						});
					}
	        	});

	        	$.ajax({
	        		type: 'GET',
					url: '{{ URL("category/criteria") }}',
					data : { 'category_id' : id },
					dataType: 'json',
					success: function(data){
						$("#criteria").html("");
						if(data.length > 0)
							$("#criteria").html("<h1 align='center'><u>Kriteria</u></h1>");

						$.each(data, function(key, val){

								var option = "";

								$.each(val.selection, function(keySelect, valSelect){
									option =  option+'<option value="'+valSelect.id+'">'+valSelect.value+'</option>';
								});

								var tr = '<div class="form-group">'+
					    					'<label class="control-label col-sm-3" for="short_description">'+val.label+':</label>' +
					    					'<div class="col-sm-4">'+
					    						'<select class="form-control" name="criteria['+key+'][value]" ><option value="0">--Silahkan Pilih--</option>'+option+'</select>'+
					    						'<input type="hidden" name="criteria['+key+'][label]" value='+val.id+' />'+
					    					'</div>'+
										'</div>';

							$("#criteria").append(tr);
						});
					}
	        	});

	        });

	        $("#category2").change(function(){
	        	var id = $(this).val(); 
	        	$.ajax({
	        		type: 'GET',
					url: '{{ URL("category/ajaxGetChild") }}',
					data : { 'parent_id' : id },
					dataType: 'json',
					success: function(data){
						$("#category3").html('<option value="-1">-- Silahkan Pilih --</option>');
						$("#category3").hide();
						if(data.length > 0)
							$("#category3").show();
						
						$.each(data, function(key, val){
							$("#category3").append('<option value="'+val.id+'">'+val.name+'</option>');
						});
					}
	        	});
	        });
		});
	</script>
@endsection