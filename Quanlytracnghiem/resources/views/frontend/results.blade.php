@extends('frontend.index')
@section('content')

<!-- header -->
<div class="row" id="header">
    <div id="title" class="col-lg-12 col-md-12 col-sm-12 col-12">
        <h1>Quiz Exam</h1>
    </div>
</div>

<!-- result -->
    <div id="right" class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card card-header bg-success text-light">Result</div>
        <table class="table table-bordered">
            <tr>
                <td>Name</td><td>{{ Auth::user()->name }}</td>
            </tr>
            
            <tr>
                <td>Thread Code</td><td>{{ $arr->threads_id }}</td>
            </tr>
            <tr>
                <td>Total point</td><td>{{ $details->point }}</td>
            </tr>
            
            <tr>
                <td>Your point</td><td>{{ $arr->users_point }}</td>
            </tr>
            
        </table>
        <a href="{{ url('index/signout') }}" class="btn btn-lg btn-danger">Logout</a>
    </div>
@endsection