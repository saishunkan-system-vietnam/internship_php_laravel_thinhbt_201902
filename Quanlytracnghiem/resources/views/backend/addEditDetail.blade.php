@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-8 col-xs-offset-2">		
	<div class="panel panel-primary">
		<div class="panel-heading"> Add edit Detail</div>
		<div class="panel-body">
		<form method="post" action="">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<!-- rows -->
			<div class="row" style="margin-top:5px;">
				<div class="col-md-12">
					@if ($errors->any())
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
				</div>
			</div>
			<!-- end rows -->
			<!-- rows -->
			<div class="row" style="margin-top:5px;">
				<div class="col-md-2">Thread</div>
				<div class="col-md-10">
					<input type="text" class="form-control" value="{{$arr->id}}" disabled>
				</div>
			</div>
			<!-- end rows -->
			<!-- rows -->
			<div class="row" style="margin-top:5px;">
				<div class="col-md-2">Question</div>
				<div class="col-md-10">
                   <select name="questions_id" class="btn btn-default btn-block" >
                   		@foreach($questions as $rows)
						<option value="{{$rows->id}}">{{$rows->content}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<!-- end rows -->
			<!-- rows -->
			<div class="row" style="margin-top:5px;">
				<div class="col-md-2"></div>
				<div class="col-md-10">
					<input type="submit" value="Process" class="btn btn-primary">
					<input type="reset" value="Clear" class="btn btn-danger">
					<a href="{{ url('admin/thread')}}" class="btn btn-warning">Cancel</a>
				</div>
			</div>
			<!-- end rows -->
		</form>

		
	
		</div>
	</div>

	<div class="panel panel-primary">
			<div class="panel-heading">List Question</div>
			<div class="panel-body">
				<table class="table table-bordered table-hover">
					<tr>
						<th>Question</th>
						<th>Answer</th>
						<th>Type</th>
						<th>Point</th>
					</tr>
					@foreach($answers as $rows)
					<tr>
						<td>{{$rows->content}}</td>
						<td>{{$rows->answers}}</td>
						<td>@if(($rows->type) == 1) {{ "True" }} @else {{ "False" }} @endif </td>
						<td>{{$rows->point}}</td>
					</tr>
					@endforeach
				</table>
				{{$answers->links()}}
				
			</div>
		</div>
</div>
@endsection