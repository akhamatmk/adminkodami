@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')

	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a href="{{ URL('purchase-order') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-plus"></i> Back PO</a>
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
				<h3 class="box-title">Purchase Order</h3>
				<form class="form-horizontal" method="POST" action="{{ URL("purchase-order") }}">
					@csrf 

					<div class="form-group">
					    <label class="control-label col-sm-3" for="rfq_id">RFQ NUMBER:</label>
					    <div class="col-sm-9">
					    	<select class="form-control" id="rfq_id" name="rfq_id">
					    		<option value="0">-- Silahkan Pilih --</option>
				    			@foreach($rfq as $key => $value)
				    				<option value="{{ $value->id }}">{{ $value->case_id }}</option>
							    @endForeach
					    	</select>					      
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="vendor_id">Vendor:</label>
					    <div class="col-sm-9">
					    	<select class="form-control" id="vendor_id" name="vendor_id">
					    		<option value="0">-- Silahkan Pilih --</option>
				    			@foreach($vendor as $key => $value)
				    				<option value="{{ $value->id }}">{{ $value->name }}</option>
							    @endForeach
					    	</select>					      
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="doc_date">Doc. Date:</label>
					    <div class="col-sm-9">
					    	<input type="text" name="doc_date" id="doc_date" class="form-control date">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="email">Email Addres:</label>
					    <div class="col-sm-9">
					    	<input type="email" name="email" id="email" class="form-control">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="ship_via">Ship Via:</label>
					    <div class="col-sm-9">
					    	<input type="text" name="ship_via" id="ship_via" class="form-control">
					    </div>
					</div>

					<div class="form-group">
					    <label class="control-label col-sm-3" for="tax">Tax:</label>
					    <div class="col-sm-9">
					    	<input type="number" step="0.01" name="tax" id="tax" class="form-control">
					    </div>
					</div>

					<table class="table" style="width: 70%" align="center">
						<thead>
							<tr>
								<th>Product</th>
								<th>Qty</th>
								<th>Delivery Date</th>
								<th>Unit Price</th>
								<th>Line Total</th>
								<th><a id="add" class="btn btn-primary"> Add Product</a></th>
							</tr>
						</thead>
						<tbody id="body">
							
						</tbody>

						<tfoot>
							<tr>
								<td colspan="3"></td>
								<td>Total</td>
								<td><input type="text" id="total" class="form-control" value="0" readonly="readonly" style=' direction: rtl;'></td>
							</tr>

							<tr>
								<td colspan="3"></td>
								<td>Sales Tax <span id="tax_tfoot"></span></td>
								<td><input type="text" id="total_tax" class="form-control" value="0" readonly="readonly" style=' direction: rtl;'></td>
							</tr>

							<tr>
								<td colspan="3"></td>
								<td>Total All</span></td>
								<td><input type="text" id="total_all" class="form-control" value="0" readonly="readonly" style=' direction: rtl;'></td>
							</tr>

						</tfoot>
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
		var option = "<option value='0'>- Silahkan Pulih --</option> @foreach($product as $key => $value) <option value='{{ $value->id }}'>{{ $value->name }}</option>  @endForeach";
		var t = 0;
	    $(function() {
	    	$("#add").click(function(){
	    		var tr =	"<tr id='body_content_"+t+"'>"+
	    						"<td><select class='form-control product' name='content["+t+"][product]'>"+option+"</select></td>"+
	    						"<td><input onChange='sum_line("+t+")' type='number' class='form-control qty' value='0' id='qty_"+t+"' name='content["+t+"][qty]'/></td>"+
	    						"<td><input  class='form-control delivery_date date' id='delivery_date_"+t+"' name='content["+t+"][delivery_date]'/></td>"+
	    						"<td><input  onChange='sum_line("+t+")' data-precision='0' class='form-control unit_price money'  id='unit_price_"+t+"' name='content["+t+"][unit_price]' value='0' /></td>"+
	    						"<td><input value='0' style=' direction: rtl;' readonly='readonly' class='form-control line_total' id='line_total_"+t+"'/></td>"+
	    						"<td><a data-id='"+t+"' onClick='delete_row("+t+")' class='btn btn-warning detele-row'>delete row</a></td>"+
	    					"</tr>";
	    		$("#body").append(tr);

	    		$(".date").datepicker({
			       dateFormat: 'yy-mm-dd',
			       minDate: 0,
			   	});

	    		$('.money').maskMoney();
	    		t++;
	    	});
		});

		function sum_line(id)
		{
			var qty = parseInt($("#qty_"+id).val());
			var price = $("#unit_price_"+id).val();
			price = parseInt(price.replace(/\,/g, ''));

			var total = qty * price;

			var result = total.toFixed(1).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
			$("#line_total_"+id).val(result);
			sum_all();
		}

		function delete_row(id)
		{
			$("#body_content_"+id).remove();
			sum_all();
		}

		$("#rfq_id").change(function(){

			var id = $(this).val();
			$("#body").html("");
			sum_all();
			if(id != 0)
			{
				$.ajax({
	    			type: 'GET',
					url: "{{ URL('purchase-order/ajax_rfq_product') }}/"+id,
					dataType: 'json',
					success: function(data){
						$.each(data, function(k, v) {

							var tr =	"<tr id='body_content_"+t+"'>"+
				    						"<td><select class='form-control product' id='product_"+t+"' name='content["+t+"][product]'>"+option+"</select></td>"+
				    						"<td><input onChange='sum_line("+t+")' type='number' class='form-control qty' value='0' id='qty_"+t+"' name='content["+t+"][qty]'/></td>"+
				    						"<td><input  class='form-control delivery_date date' id='delivery_date_"+t+"' name='content["+t+"][delivery_date]'/></td>"+
				    						"<td><input  onChange='sum_line("+t+")' data-precision='0' class='form-control unit_price money'  id='unit_price_"+t+"' name='content["+t+"][unit_price]' value='0' /></td>"+
				    						"<td><input value='0' style=' direction: rtl;' readonly='readonly' class='form-control line_total' id='line_total_"+t+"'/></td>"+
				    						"<td><a data-id='"+t+"' onClick='delete_row("+t+")' class='btn btn-warning detele-row'>delete row</a></td>"+
				    					"</tr>";
				    		
				    		$("#body").append(tr);

				    		$(".date").datepicker({
						       dateFormat: 'yy-mm-dd',
						       minDate: 0,
						   	});

				    		$('.money').maskMoney();
				    		$("#product_"+t).val(v.kodami_product_id);

				    		t++;
						});
					}
	    		});	
			}			
		});


		$("#tax").change(function(){
			$("#tax_tfoot").html("( "+$(this).val()+" %)");
			sum_all();
		})

		function sum_all()
		{
			var total = 0;
			$(".line_total").each(function(key , val){
				var price = $(this).val();
				price = price.replace('.0','');
				price = parseInt(price.replace(/\,/g, ''));
				total+= price;
			});

			var tax = $("#tax").val();
			if(isNaN(tax) ||  tax == "")
				tax = 0

			$("#tax_tfoot").html("( "+tax+" %)");
			tax = parseInt(tax);

			var total_tax = (total * tax) / 100;
			var total_all = total_tax + total;

			var result = total.toFixed(1).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
			var result_tax = total_tax.toFixed(1).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
			var result_all = total_all.toFixed(1).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');		

			$("#total").val(result);
			$("#total_tax").val(result_tax);
			$("#total_all").val(result_all);
		}
	</script>
@endsection