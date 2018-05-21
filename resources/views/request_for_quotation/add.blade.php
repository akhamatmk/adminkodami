@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')
	
	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a href="{{ URL('requestForQuotation/create') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-plus"></i> Back Request For Quotation</a>
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
				<h3 class="box-title">Form Request For Qoutation</h3>
				<form class="form-horizontal" method="POST" action="{{ URL("requestForQuotation") }}">
					@csrf 

					<div class="form-group">
					    <label class="control-label col-sm-3" for="purchase_type">PURCHASE TYPE:</label>
					    <div class="col-sm-9">
					    	<select class="form-control" id="purchase_type" name="purchase_type">
					    		<option value="0">-- Silahkan Pilih --</option>
				    			@foreach($purchase_type as $key => $value)
				    				@if($key != 0)
				    					<option value="{{ $key }}">{{ $value }}</option>
				    				@endIf
							    @endForeach
					    	</select>
					      
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="document_title">DOCUMENT TITLE:</label>
					    <div class="col-sm-9">
					    	<input type="text" name="document_title" class="form-control">					      
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="solicitation_type">SOLICITATION TYPE:</label>
					    <div class="col-sm-9">
					    	<select class="form-control" id="solicitation_type" name="solicitation_type">
					    		<option value="0">-- Silahkan Pilih --</option>
				    			@foreach($solicitation_type as $key => $value)
				    				@if($key != 0)
				    					<option value="{{ $key }}">{{ $value }}</option>
				    				@endIf
							    @endForeach
					    	</select>
					      
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="currency">CURRENCY:</label>
					    <div class="col-sm-9">
					    	<select class="form-control" id="currency" name="currency">
					    		<option value="0">-- Silahkan Pilih --</option>
				    			@foreach($currency as $key => $value)
				    				@if($key != 0)
				    					<option value="{{ $key }}">{{ $value }}</option>
				    				@endIf
							    @endForeach
					    	</select>
					      
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="delivery_date">DELIVERY DATE:</label>
					    <div class="col-sm-9">
					    	<input type="text" name="delivery_date" class="form-control date">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="expiration_date">EXPIRATION DATE:</label>
					    <div class="col-sm-9">
					    	<input type="text" name="expiration_date" class="form-control date">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="detail_delivery_addres">DETAIL DELIVERY ADDRES:</label>
					    <div class="col-sm-9">
					    	<textarea class="form-control" name="detail_delivery_addres" id="detail_delivery_addres"></textarea>
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="effective_date">EFFECTIVE DATE:</label>
					    <div class="col-sm-9">
					    	<input type="text" name="effective_date" class="form-control date">
					    </div>
					</div>

					<table class="table" style="width: 70%" align="center">
						<thead>
							<th>Product</th>
							<th>Qty</th>
							<th><a style="float: right;" id="add" class="btn btn-primary">Tambah Product</a></th>
						</thead>
						<tbody id="body_content">
							
						</tbody>
					</table>

					<div class="form-group">
					    <label class="control-label col-sm-10"></label>
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
		var t = 0;
		var option = "<option value='0'>- Silahkan Pulih --</option> @foreach($product as $key => $value) <option value='{{ $value->id }}'>{{ $value->name }}</option>  @endForeach";
		$(function() {
			function delete_row()
			{
				$(".delete_row").click(function(){
	    			var id = $(this).data('id');
	    			$("#body_"+id).remove();
	    		});	
			}
			
    		$("#add").click(function(){
    			var tr =	"<tr id='body_"+t+"'>"+
    							"<td><select class='form-control' name='content["+t+"][product]'>"+option+"</select></td>"+
    							"<td><input type='number' class='form-control' name='content["+t+"][qty]'></td>"+
    							"<td><a class='btn btn-danger delete_row' data-id='"+t+"'>Hapus Data</a></td>"+
    						"</tr>";

    			$("#body_content").append(tr);
    			delete_row();
    			t++;
    		});

    		
		});
	</script>
@endsection