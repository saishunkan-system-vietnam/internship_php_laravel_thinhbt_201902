@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-8 col-xs-offset-2">
	
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
					<td>@if (($rows->answers_id) == 0) {{ 0 }} @else {{ $rows->answers_id }} @endif</td>
					<td>{{ $rows->users_point }}</td>
					<td style="text-align: center;"><a href="{{ url('admin/result/delete/'.$rows->id) }}" onclick="return window.confirm('Are you sure?');"><i class="fas fa-trash fa-2x"></i></a></td>
				</tr>
				@endforeach
			</table>
			{{ $arr->links() }}
		</div>
	</div>
</div>
@endsection