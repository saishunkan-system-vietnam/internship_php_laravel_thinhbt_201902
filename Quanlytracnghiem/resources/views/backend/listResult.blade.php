@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-8 col-xs-offset-2">
	{{-- <div style="margin-bottom:5px;">
		<a href="{{ url('admin/user/add') }}" class="btn btn-success"> + Add user</a>
	</div>  --}}
	
	<div class="panel panel-primary">
		<div class="panel-heading">List Result</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover">
				<tr>
					<th>Name</th>
					<th>Threads</th>
					<th>Answer</th>
					<th>Point</th>
					<th></th>
				</tr>
				@foreach($arr as $rows)
				<tr>
					<td>{{ $rows->name }}</td>
					<td>{{ $rows->threads_id }}</td>
					<td>{{ $rows->answers_id }}</td>
					<td>{{ $rows->users_point }}</td>
					<td style="text-align: center;"><a href="{{ url('admin/result/delete/'.$rows->id) }}" onclick="return window.confirm('Are you sure?');"><i class="fas fa-trash fa-2x"></i></a></td>
				</tr>
				@endforeach
			</table>
			<style type="text/css">
				.pagination{padding:0px; margin:0px;}
			</style>
			
		</div>
	</div>
</div>
@endsection