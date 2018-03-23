@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')
<div class="row">
   <div class="col-sm-8">
      <div class="white-box">
			<h3 class="box-title">Banners</h3>
				<div class="table-responsive">				
					<table class="table color-table info-table" id="users-table">
				        <thead>
				            <tr>
				                <th>id</th>
				                <th>Nama Product</th>
				                <th>Descripsi</th>
				                <th>Image</th>
				                <th>No Urut</th>
				                <th></th>
				            </tr>
				        </thead>
    				</table>
				</div>
			</div>
   </div>
</div>
@endsection

@section('script')

<script>
$(function() {
    $('#users-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: '{{ URL::to("banners/data") }}',
	        columns: [
	            { data: 'id', name: 'id' },
	            { data: 'name_product', name: 'name_product' },
	            { data: 'descripsi', name: 'descripsi' },
	            { data: 'image_base', name: 'image_base' },
	            { data: 'urut', name: 'urut' },
	            { data: 'action', name: 'action' }
	        ]
	    });

	});
</script>
@endsection