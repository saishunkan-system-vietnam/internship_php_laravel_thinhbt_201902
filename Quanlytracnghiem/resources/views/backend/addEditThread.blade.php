@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-8 col-xs-offset-2">		
	<div class="panel panel-primary">
		<div class="panel-heading"> Add edit Thread</div>
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
					<div class="col-md-2">Time</div>
					<div class="col-md-10">
					<input type="text" autofocus id="time" value="{{ old('time') !='' ? old('time'):(isset($record->time)?$record->time:'') }}" name="time" class="form-control" placeholder="Thời giam làm bài">
					</div>
				</div>
				<!-- end rows -->
				<!-- rows -->
				<div class="row" style="margin-top:5px;">
					<div class="col-md-2">Total Point</div>
					<div class="col-md-10">
						<input type="text" id="total_point" value="{{ old('total_point') !='' ? old('total_point'):(isset($record->total_point)?$record->total_point:'') }}" name="total_point" class="form-control" placeholder="Tổng điểm">
					</div>
				</div>
				<!-- end rows -->
				<!-- rows -->
				<div class="row" style="margin-top:5px;">
					<div class="col-md-2">Total Question</div>
					<div class="col-md-10">
						<input type="text" id="total_questions" value="{{ old('total_questions') !='' ? old('total_questions'):(isset($record->total_questions)?$record->total_questions:'') }}" name="total_questions" class="form-control" placeholder="Tổng câu hỏi">
					</div>
				</div>
				<!-- end rows -->
				<!-- rows -->
				<div class="row" style="margin-top:5px;">
					<div class="col-md-2">Student</div>
					<div class="col-md-10">
						<select name="user_id" class="btn btn-default btn-block" >
							@foreach($arr as $rows)
								<option value="{{$rows->id}}" @if(isset($record->users_id) == isset($rows->id)) selected="selected" @endif >{{$rows->name}}</option>
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
</div>
@endsection