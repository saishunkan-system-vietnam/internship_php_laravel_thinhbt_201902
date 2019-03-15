@extends("backend.layout")
@section("do-du-lieu")
<input type="hidden" id="leftActive" value="answer">
    <div class="col-md-8 col-xs-offset-2">
    {{-- <div style="margin-bottom:5px;">
		<a href="{{ url('admin/question/add') }}" class="btn btn-success"> + Add question</a>
    </div> --}}
    
        <div class="panel panel-primary">
            <div class="panel-heading">List Answer</div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Type</th>
                        <th></th>
                    </tr>
                    
                    @foreach($answers as $rows)
                        <tr>
                            <td>{{ $rows->content }}</td>
                            <td>{{ $rows->answers }}</td>
                            <td>@if(($rows->type) == 1) {{ "True" }} @else {{ "False" }} @endif </td>
                            <td style="text-align: center;width: 150px;">
                                <a href="{{ url('admin/answer/answerEdit/'.$rows->id) }}" ><i class="fas fa-pen-square fa-2x"></i></a>
                                <a href="{{ url('admin/answer/delete/'.$rows->id) }}" onclick="return window.confirm('Are you sure?');"><i class="fas fa-trash fa-2x"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $answers->links() }}
            </div>
        </div>
    </div>
@endsection