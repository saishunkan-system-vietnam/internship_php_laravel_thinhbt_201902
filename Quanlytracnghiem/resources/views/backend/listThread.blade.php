@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-8 col-xs-offset-2">
	<div style="margin-bottom:5px;">
		<a href="{{ url('admin/thread/add') }}" class="btn btn-success"><i class="fas fa-plus"></i> Add thread</a>
	</div>
	
	<div class="panel panel-primary">
		<div class="panel-heading">List Thread</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover">
				<tr>
					<th>Thread</th>
					<th>Time</th>
					<th>Total Questions</th>
					<th>Student</th>
					<th style="width:200px;"></th>
				</tr>
				@foreach($arr as $rows)
				<tr>
					<td>{{ $rows->id }}</td>
					<td>{{ $rows->time }}</td>
					<td>{{ $rows->total_questions }}</td>
					<td>{{ $rows->name }}</td>
					<td style="text-align:center;">
						<a href="{{ url('admin/thread/edit/'.$rows->id) }}"><i class="fas fa-pen-square fa-2x"></i></a>&nbsp;
						<a href="{{ url('admin/thread/delete/'.$rows->id) }}" onclick="return window.confirm('Are you sure?');"><i class="fas fa-trash fa-2x"></i></a>
					</td>
				</tr>
				@endforeach
			</table>
			{{$arr->links()}}
		</div>
	</div>


	
	<div class="panel panel-primary">
		<div class="panel-heading">List Detail</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover">
				<tr>
					<th style="width: 100px;">Thread</th>
					<th>Question</th>
					<th style="width: 100px">Total Point</th>
					<th></th>
				</tr>
				@foreach($details as $rowsde)
				<tr>
					<td>{{ $rowsde->threads_id }}</td>
					<td>{{ $rowsde->content }}</td>
					<td>{{ $rowsde->point }}</td>
					<td><a href="{{ url('admin/detail/add/'.$rowsde->threads_id) }}"><i class="fas fa-plus fa-2x"></a></td>
					
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection