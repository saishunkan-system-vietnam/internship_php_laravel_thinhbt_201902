@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-8 col-xs-offset-2">
	<div style="margin-bottom:5px;">
		<a href="{{ url('admin/thread/add') }}" class="btn btn-success"> + Add thread</a>
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
						{{-- <a href="{{ url('admin/thread/detailAdd/'.$rows->id) }}" class="btn btn-sm btn-success">+ Detail</a> --}}
						<a href="{{ url('admin/thread/edit/'.$rows->id) }}" class="btn btn-sm btn-info">Edit</a>&nbsp;
						<a href="{{ url('admin/thread/delete/'.$rows->id) }}" class="btn btn-sm btn-danger" onclick="return window.confirm('Are you sure?');">Delete</a>
					</td>
				</tr>
				@endforeach
			</table>
			{{$arr->links()}}
		</div>
	</div>


	{{-- <div style="margin-bottom:5px;">
		<a href="{{ url('admin/detail/add') }}" class="btn btn-success"> + Add question</a>
	</div> --}}
	<div class="panel panel-primary">
		<div class="panel-heading">List Detail</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover">
				<tr>
					<th style="width: 100px;">Thread</th>
					<th>Question</th>
					<th style="width: 100px">Total Point</th>
					<th style="width: 100px"></th>
					{{-- <th style="width: 100px"></th> --}}
				</tr>
				@foreach($details as $rowsde)
				<tr>
					<td>{{ $rowsde->threads_id }}</td>
					<td>{{ $rowsde->content }}</td>
					<td>{{ $rowsde->point }}</td>
					<td><a href="{{ url('admin/detail/add/'.$rowsde->threads_id) }}" class="btn btn-success"> + Add question</a></td>
					{{-- <td>
						<a href="{{ url('admin/thread/delete/'.$rowsde->threads_id) }}" class="btn btn-sm btn-danger" onclick="return window.confirm('Are you sure?');">Delete</a>
					</td> --}}
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection