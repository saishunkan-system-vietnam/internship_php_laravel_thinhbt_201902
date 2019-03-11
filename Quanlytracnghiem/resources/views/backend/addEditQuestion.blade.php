@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-8 col-xs-offset-2">		
	<div class="panel panel-primary">
		<div class="panel-heading"> Add edit Question</div>
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
				<div class="col-md-2">Question</div>
				<div class="col-md-10">
					<input type="text" autofocus name="content" id="content" value="{{ old('content') != '' ?old('content'):(isset($record->content)?$record->content:'') }}" placeholder="Câu hỏi" class="form-control">
					
				</div>
			</div>
			<!-- end rows -->
			<!-- rows -->
			<div class="row" style="margin-top:5px;">
				<div class="col-md-2">Point</div>
				<div class="col-md-10">
                   <input type="text" id="point" value="{{ old('point') !='' ?old('point'):(isset($record->point)?$record->point:'') }}" name="point" class="form-control" placeholder="Điểm">
				</div>
			</div>
			<!-- end rows -->
			<!-- rows -->
			<div class="row" style="margin-top:5px;">
				<div class="col-md-2"></div>
				<div class="col-md-10">
					<input type="submit" value="Process" class="btn btn-primary">
					<input type="reset" value="Clear" class="btn btn-danger">
					<a href="{{ url('admin/question')}}" class="btn btn-warning">Cancel</a>
				</div>
			</div>
			<!-- end rows -->
		</form>
		</div>
	</div>
</div>
@endsection