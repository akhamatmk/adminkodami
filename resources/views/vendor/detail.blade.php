@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')
		
	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a href="{{ url('vendor') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-plus"></i> BACK VENDOR</a>
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
				<h3 class="box-title">Vendor</h3>
				<form class="form-horizontal" method="POST" action="{{ URL("vendor/".$koprasi->id."/change/status") }}">
					@csrf

						<div class="form-group">
							<label class="control-label col-sm-3" for="email">Email:</label>
							<div class="col-sm-9">
								<input readonly="readonly" type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ $koprasi->member_2->email }}" >
							</div>
						</div>

						<div class="form-group">
						    <label class="control-label col-sm-3" for="name">Nama Vendor:</label>
						    <div class="col-sm-9">
						      <input value="{{ $koprasi->name }}" readonly="readonly" type="name" class="form-control" id="name" name="name" placeholder="Nama Vendor">
						    </div>
						</div>

						<div class="form-group">
						    <label class="control-label col-sm-3" for="pic_name">Pic Name:</label>
						    <div class="col-sm-9">
						      <input value="{{ $koprasi->member_2->name }}" readonly="readonly" type="name" class="form-control" id="pic_name" name="pic_name" placeholder="Nama PIC Name">
						    </div>
						</div>

						<div class="form-group">
						    <label class="control-label col-sm-3" for="username">User Name Login:</label>
						    <div class="col-sm-9">
						      <input value="{{ $koprasi->member_2->username }}" readonly="readonly" type="username" class="form-control" id="username" name="username" placeholder="User Name">
						    </div>
						</div>						

						<div class="form-group">
							<label class="control-label col-sm-3" for="telephone">Phone Number:</label>
							<div class="col-sm-9">
								<input value="{{ $koprasi->member_2->phone }}" readonly="readonly" type="text" name="telephone" class="form-control" id="telephone" placeholder="Telephone">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="postal_code">Kode Pos:</label>
							<div class="col-sm-9">
								<input value="{{ $koprasi->postal_code }}" readonly="readonly" type="text" name="postal_code" class="form-control" id="postal_code" placeholder="Telephone">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="province">Province Warehouse:</label>
							<div class="col-sm-9">
								<select disabled="disabled" readonly="readonly" name="province" class="form-control" id="province">
									<option value="">--Silahkan Pilih Province--</option>
									@foreach($province as $key => $value)
										@if($regency->province->id == $value->id)
											@php ($select = 'selected="selecter"')
										@else
											@php ($select = '')
										@endIf

										<option {{ $select }} value="{{ $value->id }}">{{ $value->name }}</option>
									@endForeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="regency">Regency Warehouse:</label>
							<div class="col-sm-9">
								<select disabled="disabled" readonly="readonly" name="regency" class="form-control" id="regency">
									@foreach($data_regency as $key => $value)
										@if($koprasi->regency_id == $value->id)
											@php ($select = 'selected="selecter"')
										@else
											@php ($select = '')
										@endIf

										<option {{ $select }} value="{{ $value->id }}">{{ $value->name }}</option>
									@endForeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="detail_address">Detail Alamat Warehouse:</label>
							<div class="col-sm-9">
								<textarea disabled="disabled" class="form-control" name="detail_address" id="detail_address">{{ $koprasi->pickup_address }}</textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="Slogan">Slogan:</label>
							<div class="col-sm-9">
								<textarea disabled="disabled" class="form-control" rows="5" name="Slogan">{{ $koprasi->slogan }}</textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="detail_address">Deskripsi:</label>
							<div class="col-sm-9">
								<textarea disabled="disabled" class="form-control" rows="10" name="detail_address">{{ $koprasi->description }}</textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="Image">Image:</label>
							<div class="col-sm-9">
								<img height="300px" src="{{ $koprasi->image }}">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="Image">Status:</label>
							<div class="col-sm-9" style="margin-top: 5px">
								@if($koprasi->is_verify == 1)
									<b style="color : blue"><u>Verified</u></b>
								@else
									<b style="color : red"><u>Belum Verified</u></b>
								@endIf
							</div>
						</div>

						<div class="form-group">							
							<div class="col-sm-12">
								<button style="float: right;" type="submit" class="btn btn-primary">
									@if($koprasi->is_verify == 1)
										Unverified Vendor
									@else
										Verified Vendor
									@endIf									
								</button>
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
	    		    	
		});
	</script>
@endsection