@extends('frontend.index')
@section('content')
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="post" action="{{ url('index/signin') }}" class="login100-form validate-form p-l-55 p-r-55 p-t-178">
					 {{ csrf_field() }}
					<span class="login100-form-title">
						Sign In
					</span>

					@if ($errors->has('email'))
					    <div class="alert alert-danger">
					        {{ $errors->first('email') }}
					    </div>
					@endif
					@if ($errors->has('password'))
					    <div class="alert alert-danger">
					        {{ $errors->first('password') }}
					    </div>
					@endif

					@if ($errors->has('errorLogin'))
					    <div class="alert alert-danger">
					        {{ $errors->first('errorLogin') }}
					    </div>
					@endif
                    
					<div class="wrap-input100  m-b-16">
						<input class="input100" type="text" name="email" value="{{ old('email')}}" placeholder="Email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 ">
						<input class="input100" type="password" name="password" value="{{ old('password')}}" placeholder="Password">
						<span class="focus-input100"></span>
					</div>

					<div class="text-right p-t-13 p-b-23">
						<!-- <span class="txt1">
							Forgot
						</span>

						<a href="#" class="txt2">
							Username / Password?
						</a> -->
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Sign in
						</button>


					</div>

					<div class="flex-col-c p-t-70 p-b-40">
						
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection