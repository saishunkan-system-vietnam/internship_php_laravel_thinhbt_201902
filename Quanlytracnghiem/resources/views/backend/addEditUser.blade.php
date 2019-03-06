@extends("backend.layout")
@section("do-du-lieu")
<div class="col-md-8 col-xs-offset-2">		
	<div class="panel panel-primary">
		<div class="panel-heading"> Add edit user</div>
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
				<div class="col-md-2">Name</div>
				<div class="col-md-10">
					<input type="text" id="name" value="{{ old('name') != '' ? old('name'):isset($record->name)?$record->name:'' }}" name="name" class="form-control" placeholder="Nguyen Van A" >
				</div>
			</div>
			<!-- end rows -->
			<!-- rows -->
			<div class="row" style="margin-top:5px;">
				<div class="col-md-2">Email</div>
				<div class="col-md-10">
                   <input type="text" id="email" value="{{ old('email') != '' ? old('email'):(isset($record->email)?$record->email:'') }}" name="email" class="form-control" placeholder="test@mail.com">
				</div>
			</div>
			<!-- end rows -->
			<!-- rows -->
			<div class="row" style="margin-top:5px;">
				<div class="col-md-2">Phone</div>
				<div class="col-md-10">
					<input type="tel" id="phone" value="{{ old('phone') != '' ? old('phone'):(isset($record->phone)?$record->phone:'') }}" name="phone" class="form-control">
				</div>
			</div>
			<!-- end rows -->
			<!-- rows -->
			<div class="row" style="margin-top:5px;">
				<div class="col-md-2">Password</div>
				<div class="col-md-10">
					<input type="password" name="password" class="form-control" @if(isset($record->email)) placeholder="Không đổi password thì không nhập" @else @endif>
				</div>
			</div>
			<!-- end rows -->
			<!-- rows -->
			<div class="row" style="margin-top:5px;">
				<div class="col-md-2"></div>
				<div class="col-md-10">
					<input type="submit" value="Process" class="btn btn-primary">
					<input type="reset" value="Clear" class="btn btn-danger">
					<a href="{{ url('admin/user')}}" class="btn btn-warning">Cancel</a>
				</div>
			</div>
			<!-- end rows -->
		</form>
		</div>
	</div>
</div>
@endsection