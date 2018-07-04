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
				<a href="{{ url('vendor/'.$vendor->id.'/product') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-plus"></i> BACK VENDOR {{ $vendor->name }}</a>
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
				<h3 class="box-title">Product Detail</h3>
				<form class="form-horizontal" method="POST" action="{{ URL("product") }}">
					@csrf 

					<div class="form-group">
					    <label class="control-label col-sm-3" for="name">Name Product:</label>
					    <div class="col-sm-9">
					    	<input type="text" name="name" id="name" class="form-control" readonly="readonly" value="{{ $product->name }}">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="category">Category:</label>
					    <div class="col-sm-9">
					    	<input type="text" name="category" id="category" class="form-control" readonly="readonly" value="{{ $product->category->name }}">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="weight">Berat Barang :</label>
					    <div class="col-sm-9">
					    	<input type="number" step="0.01" name="weight" id="weight" class="form-control" readonly="readonly" value="{{ $product->weight }}">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3">primary Image :</label>
					    <div class="col-sm-5">
					    	<img height="100px" src="{{ $product->primary_image }}">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="short_description">Short Deskripsi :</label>
					    <div class="col-sm-4">
					    	<textarea rows="5" disabled="disabled" class="form-control" name="short_description" id="short_description">{{ $product->description }}</textarea>
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="long_description">Long Deskripsi :</label>
					    <div class="col-sm-9">
					    	<textarea rows="7" class="form-control" disabled="disabled" name="long_description" id="long_description"> {{ $product->long_description }}</textarea>
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="long_description">Long Deskripsi :</label>
					    <div class="col-sm-9">
					    	<textarea rows="7" class="form-control" disabled="disabled" name="long_description" id="long_description"> {{ $product->long_description }}</textarea>
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="status">Status :</label>
					    <div class="col-sm-9" style="margin-top: 5px">
					    	<span >
					    		<b >
					    			@if($product->is_validate == 1)
					    				Validated
					    			@else
					    				Not Validated
					    			@endIf
					    		</b>
					    	</span>
					    </div>
					</div>
					
					<div class="clearfix"></div>
				</form>
			</div>
	   </div>
	</div>
	
	@if($product->is_validate == 0)					    			
		<div class="row">
		   	<div class="col-sm-12">
		      	<div class="white-box">
					<h3 class="box-title">Choose Product Kodami To Validated</h3>
					<form class="form-horizontal" method="POST" action="{{ URL("vendor/".$vendor->id."/product/".$product->id."/change/status") }}">
						@csrf
						
						<div class="form-group">
						    <label class="control-label col-sm-3" for="category">Kodami Product:</label>
						    <div class="col-sm-9">
						    	<select name="Kodami_product_id" class="form-control" id="Kodami_product_id">
						    		@foreach($kodami_product as $key => $value)
						    			<option value="{{ $value->id }}">{{ $value->name }}</option>
						    		@endForeach
						    	</select>
						    </div>
						</div>
						
						<button style="float: right;" type="submit" class="btn btn-primary">Validated</button>
						<div class="clearfix"></div>
					
					</form>
				</div>
			</div>
		</div>
	@else
		<div class="row" >
		   	<div class="col-sm-12">
		      	<div>
					<form class="form-horizontal" method="POST" action="{{ URL("vendor/".$vendor->id."/product/".$product->id."/change/status") }}">
						@csrf
						
						
					<button style="float: right;" type="submit" class="btn btn-primary">Un Validated</button>
					<div class="clearfix"></div>
					
					</form>
				</div>
			</div>
		</div>
	@endIf

@endsection

@section('script')
	<script>
	    $('#Kodami_product_id').select2();
	</script>
@endsection