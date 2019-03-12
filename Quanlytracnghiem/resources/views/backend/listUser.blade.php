@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-8 col-xs-offset-2">
	
	<div style="margin-bottom:5px;">
		<a href="{{ url('admin/user/add') }}" class="btn btn-success"><i class="fas fa-plus"></i> Add user</a>
	</div>
	
	<div class="panel panel-primary">
		<div class="panel-heading">List User</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover">
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>

					<th style="width:130px;"></th>
				</tr>
				@foreach($arr as $rows)
				<tr>
					<td>{{ $rows->name }}</td>
					<td>{{ $rows->email }}</td>
					<td>{{ $rows->phone }}</td>
					<td style="text-align:center;">
						<a href="{{ url('admin/user/edit/'.$rows->id) }}"><i class="fas fa-pen-square fa-2x"></i></a>&nbsp;
						<a href="{{ url('admin/user/delete/'.$rows->id) }}" onclick="return window.confirm('Are you sure?');"><i class="fas fa-trash fa-2x"></i></a>
					</td>
				</tr>
				@endforeach
			</table>
			{{ $arr->links() }}
		</div>
	</div>
</div>
@endsection