@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-8 col-xs-offset-2">		
	<div class="panel panel-primary">
		<div class="panel-heading"> Add edit Answer</div>
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
				<div class="col-md-2">Answer</div>
				<div class="col-md-10">
                   <input type="text" autofocus name="answers" id="answers" value="{{ old('answers') !='' ? old('answers'):(isset($answers->answers)?$answers->answers:'') }}" placeholder="Câu trả lời" class="form-control">
				</div>
			</div>
			<!-- end rows -->
			<!-- rows -->
			<div class="row" style="margin-top:5px;">
				<div class="col-md-2">Type</div>
				<div class="col-md-10">
                   <select name="type" class="btn btn-default btn-block" >
                   		<option value="0">False</option>
                   		<option value="1">True</option>
						
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
					<a href="{{ url('admin/question')}}" class="btn btn-warning">Cancel</a>
					<a href="{{ url('admin/answer')}}" class="btn btn-success">Answer</a>
				</div>
			</div>
			<!-- end rows -->
		</form>

		
	
		</div>
	</div>
</div>
@endsection