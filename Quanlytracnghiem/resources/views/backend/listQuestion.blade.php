@extends("backend.layout")
@section("do-du-lieu")
    <div class="col-md-8 col-xs-offset-2">
    <div style="margin-bottom:5px;">
		<a href="{{ url('admin/question/add') }}" class="btn btn-success"> + Add question</a>
	</div>

        <div class="panel panel-primary">
            <div class="panel-heading">List Question</div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Question</th>
                        <th>Answer</th>
                        <th style="width: 50px;">Point</th>
                        <th></th>
                    </tr>
                    @foreach($questions as $rows)
                        <tr>
                            <td>{{ $rows->content }}</td>
                            <td>{{ $rows->answers }}</td>
                            <td>@if(($rows->type) == 0) {{ $rows->point = "0" }} @else {{ $rows->point }} @endif </td>
                            <td style="text-align:center;width: 184px;">
                            <a href="{{ url('admin/question/answerAdd/'.$rows->id) }}" class="btn btn-sm btn-success">+Ans</a>&nbsp;
                            <a href="{{ url('admin/question/edit/'.$rows->id) }}" class="btn btn-sm btn-info">Edit</a>&nbsp;
                            <a href="{{ url('admin/question/delete/'.$rows->id) }}" onclick="return window.confirm('Are you sure?'); " class="btn btn-sm btn-danger">Delete</a>

                            </td>
                        </tr>
                    @endforeach

                </table>
                {{ $questions->links() }}
            </div>
        </div>
    </div>
@endsection