@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-8 col-xs-offset-2">
	{{-- <div style="margin-bottom:5px;">
		<a href="{{ url('admin/user/add') }}" class="btn btn-success"> + Add user</a>
	</div>  --}}
	
	<div class="panel panel-primary">
		<div class="panel-heading">List Detail</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover">
				<tr>
					<th style="width: 100px;">Thread</th>
                    <th>Question</th>
                    <th>Point</th>
					<th style="width: 100px"></th>
				</tr>
				@foreach($details as $rows)
				<tr>
					<td>{{ $rows->threads_id }}</td>
                    <td>{{ $rows->content }}</td>
                    <td>{{ $rows->point }}</td>
					<td>
						<a href="{{ url('admin/detail/delete/'. $rows->id) }}" class="btn btn-sm btn-danger" onclick="return window.confirm('Are you sure?');">Delete</a>
					</td>
				</tr>
                @endforeach
            </table>
            {{ $details->links() }}
		</div>
	</div>
</div>
@endsection