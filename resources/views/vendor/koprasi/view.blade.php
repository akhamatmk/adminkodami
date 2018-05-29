@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')

	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a href="{{ URL('vendor/koprasi') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-back"></i> Back To Unregister VENDOR</a>
				<ol class="breadcrumb">
					<li><a href="javascript:void(0)">Dashboard</a></li>
					<li class="active">Dashboard</li>
				</ol>
       	</div>
       <!-- /.col-lg-12 -->
    </div>

	<div class="row">
	   	<div class="col-sm-12">
	      	<div class="white-box">
				<h3 class="box-title">View Koprasi</h3>
				<form class="form-horizontal">
					
					<div class="form-group">
						<label class="control-label col-sm-3" for="email">Name Koprasi:</label>
						<div class="col-sm-9" style="margin-top: 7px">
							<b>{{ ucwords($koprasi->name) }}</b>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="email">Name Pemilik Koprasi:</label>
						<div class="col-sm-9" style="margin-top: 7px">
							<b>{{ ucwords($koprasi->member_2->name) }}</b>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="email">Email Pemilik Koprasi:</label>
						<div class="col-sm-9" style="margin-top: 7px">
							<b>{{ $koprasi->member_2->email }}</b>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="email">Telephone Pemilik Koprasi:</label>
						<div class="col-sm-9" style="margin-top: 7px">
							<b>{{ $koprasi->member_2->phone }}</b>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="email">Image Pemilik Koprasi:</label>
						<div class="col-sm-9" style="margin-top: 7px">
							<img src="{{ $koprasi->member_2->image }}" width="150px" />
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="email">Slogan:</label>
						<div class="col-sm-9" style="margin-top: 7px">
							<b>{{ ucwords($koprasi->slogan) }}</b>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="email">Regency Warehouse:</label>
						<div class="col-sm-9" style="margin-top: 7px">
							<b>
								@if(isset($koprasi->regency))
									{{ $koprasi->regency->name }}
								@endIf								
							</b>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="email">Province Warehouse:</label>
						<div class="col-sm-9" style="margin-top: 7px">
							<b>
								@if(isset($koprasi->regency->province))
									{{ $koprasi->regency->province->name }}
								@endIf								
							</b>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="email">Postal Code Warehouse:</label>
						<div class="col-sm-9" style="margin-top: 7px">
							<b>{{ $koprasi->postal_code }}</b>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="email">Detail Pickup Address:</label>
						<div class="col-sm-9" style="margin-top: 7px">
							<b>{{ $koprasi->pickup_address }}</b>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="email">Image Koprasi:</label>
						<div class="col-sm-9" style="margin-top: 7px">
							<img src="{{ $koprasi->image }}" width="150px" />
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3" for="email">Deskripsi</label>
						<div class="col-sm-9" style="margin-top: 7px">
							<b>{{ $koprasi->description }}</b>
						</div>
					</div>

						<a style="float: right;" href="{{ URL('vendor/koprasi/'.$koprasi->id.'/process') }}" class="btn btn-primary"> Process to Vendor </a>
						<div class="clearfix"></div>
				</form>
			</div>
	   </div>
	</div>

@endsection

@section('script')
	<script>
		
	</script>
@endsection