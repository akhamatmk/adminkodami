@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')
	
	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a href="{{ URL('salesAndDistribution') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-back"></i> BACK SALES AND DISTRIBUTION</a>
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
				<h3 class="box-title">Form Sales And Distribution</h3>
				<form class="form-horizontal" method="POST" action="{{ URL("salesAndDistribution") }}">
					@csrf 

					<div class="form-group">
					    <label class="control-label col-sm-3" for="vendor_id">Vendor:</label>
					    <div class="col-sm-9">
					    	<select class="form-control" id="vendor_id" name="vendor_id">
					    		<option value="0">-- SIlahkan Pilih Vendornya --</option>
				    			@foreach($vendor as $key => $value)
				    				<option value="{{ $value->id }}">{{ $value->name }}</option>
							    @endForeach
					    	</select>
					      
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="kodami_product_id">Product:</label>
					    <div class="col-sm-9">
					    	<select class="form-control" id="kodami_product_id" name="kodami_product_id">
					    		<option value="0">-- SIlahkan Pilih Product --</option>
				    			@foreach($product as $key => $value)
				    				<option value="{{ $value->id }}">{{ $value->name }}</option>
							    @endForeach
					    	</select>
					      
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="price">Price:</label>
					    <div class="col-sm-9">
					    	<input type="text" name="price" id="price" data-precision="0" placeholder="Price" class="form-control money">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="valid_until">Valid Until:</label>
					    <div class="col-sm-9">
					    	<input type="text" name="valid_until" id="valid_until" placeholder="Valid Until" class="form-control date">
					    </div>
					</div>
					
					<div class="form-group">
					    <label class="control-label col-sm-3" for="min_order">Min Order</label>
					    <div class="col-sm-9">
					    	<input type="number" name="min_order" id="min_order" placeholder="Min Order" class="form-control">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-10" for="min_order"></label>
					    <div class="col-sm-2">
					    	<a style="float: right;" id="add" class="btn btn-primary">Add</a>
					    </div>
					</div>

					<table class="table">
		      			<thead>
		      				<tr>
		      					<th>Product</th>
		      					<th>Vendor</th>
		      					<th>Price (Rp.)</th>
		      					<th>Valid Until</th>
		      					<th>Min Order</th>
		      				</tr>
		      			</thead>
		      			<tbody id="body">
		      				
		      			</tbody>
		      		</table>

		      		<div class="form-group">
					    <label class="control-label col-sm-10" for="min_order"></label>
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

		
    	function delete_tr(id)
    	{
    		$("#body_"+id).remove();	
    	}



	    $(function() {
	    	$('.money').maskMoney();
	    	$("#add").click(function(){
	    		var product_text = $("#kodami_product_id option:selected").text();
	    		var product = $("#kodami_product_id option:selected").val();
	    		var vendor_text = $("#vendor_id option:selected").text();
	    		var vendor = $("#vendor_id option:selected").val();
	    		var price = $("#price").val();
	    		var valid_until = $("#valid_until").val();
	    		var min_order = $("#min_order").val();

	    		var input = "<input type='hidden' name='Sales["+t+"][product_id]' value='"+product+"'>"+
	    					"<input type='hidden' name='Sales["+t+"][vendor_id]' value='"+vendor+"'>"+
	    					"<input type='hidden' name='Sales["+t+"][price]' value='"+price+"'>"+
	    					"<input type='hidden' name='Sales["+t+"][valid_until]' value='"+valid_until+"'>"+
	    					"<input type='hidden' name='Sales["+t+"][min_order]' value='"+min_order+"'>"+
	    					"<a onClick='delete_tr("+t+")' class='btn btn-danger'>Hapus Data</a>";

	    		var tr = 	"<tr id='body_"+t+"'>"+
	    						"<td>"+product_text+"</td>"+
	    						"<td>"+vendor_text+"</td>"+
	    						"<td>"+price+"</td>"+
	    						"<td>"+valid_until+"</td>"+
	    						"<td>"+min_order+"</td>"+
	    						"<td>"+input+"</td>"+
	    					"</tr>";

	    		$(".table").append(tr);		

	    		$("#kodami_product_id").val(0);
	    		$("#vendor_id").val(0);
	    		$("#price").val("");
	    		$("#valid_until").val("");
	    		$("#min_order").val(0);
	    		
	    		t++;
	    	});

		});

	</script>
@endsection