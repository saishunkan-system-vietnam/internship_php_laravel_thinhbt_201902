@extends('frontend.index')
@section('content')


<!-- header -->
<div class="row" id="header">
    <div id="title" class="col-lg-12 col-md-12 col-sm-12 col-12">
        <h1>Quiz Exam</h1>
    </div>
</div>

<script>
    function disableButton(btn){
        document.getElementById(btn.id).disabled = true;
        alert("Bắt đầu tính giờ làm bài");
    }
    
</script>

<script>
    function confirm(){
        //window.confirm("Nộp bài trước khi hết giờ?");
        var message = confirm("Nộp bài trước khi hết giờ?");
        // if (message == true) {
        //     document.getElementById("examForm").submit();
        // }
    }
</script>

 <!-- content -->
<div class="row" id="content">
    <div id="left" class="col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="card card-header bg-secondary text-light">Student infomation</div>
        <table class="table table-striped table-bordered">
            <tr>
                <td>Name</td><td>{{Auth::user()->name}}</td>
            </tr>
            <tr>
                <td>Email</td><td>{{Auth::user()->email}}</td>
            </tr>
            <tr>
                <td>Phone</td><td>{{Auth::user()->phone}}</td>
            </tr>
            <tr>
                <td>Student code</td><td>{{Auth::user()->id}}</td>
            </tr>
            <tr>
                <td>Time</td><td>45 minutes</td>
            </tr>
        </table>
        <input type="button" id="btn1" name="start" onclick="start();disableButton(this);" class="btn btn-success btn-lg" value="Start Exam">
    </div>


<!-- right -->
    <div id="right" class="col-lg-9 col-md-9 col-sm-12 col-12">
        <form id="examForm" action="{{ url('index/results') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="card card-header bg-info text-light">Thread</div>
            <br>
            <div style="color: red;font-size:30px; text-align: left">Time:  <span id="m"></span> : <span id="s"></span> </div>
            <table>
                <tr>
                <td><br></td>
                </tr>
                @foreach($threads as $questions)
                <tr>
                    <td>Question :  {{ $questions['content'] }} </td><td style="text-align: right">{{ $questions['point'] }} point</td>
                </tr>
                <input type="hidden" name="point[{{ $questions['questions_id'] }}]" value="{{$questions['point']}}">
                <tr>
                    <td><br></td>
                </tr>
                <input type="hidden" name="count[{{ $questions['questions_id'] }}]" value="{{ $questions['count'] }}" >
                    @if($questions['count'] == 1)
                        @foreach($questions['answers'] as $answers)
                <tr>
                    <td><input type="radio" name="answer[{{ $answers->questions_id }}]" value="{{ $answers->id }}"> {{ $answers->answers }}</td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                        @endforeach
                    @elseif($questions['count'] > 1)
                        @foreach($questions['answers'] as $answers)
                <tr>
                    <td><input type="checkbox" name="answer[{{ $answers->questions_id }}][{{ $answers->id }}]" value="{{ $answers->id }}"> {{ $answers->answers }}</td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                        @endforeach
                    @endif
                <input type="hidden" name="total" value="0">
                @endforeach
            </table>
            
            <button type="button" onclick="confirm();" class="btn btn-danger btn-lg">
                Done
            </button>
        </form>
    </div>
</div>

<script>
    var h = 0; // Giờ
    var m = 0; // Phút
    var s = 30; // Giây
        
    var timeout = null; // Timeout
    function start()
    {
    
        /*BƯỚC 1: CHUYỂN ĐỔI DỮ LIỆU*/
        // Nếu số giây = -1 tức là đã chạy ngược hết số giây, lúc này:
        //  - giảm số phút xuống 1 đơn vị
        //  - thiết lập số giây lại 59
        if (s === -1){
            m -= 1;
            s = 59;
        }
    
        // Nếu số phút = -1 tức là đã chạy ngược hết số phút, lúc này:
        //  - giảm số giờ xuống 1 đơn vị
        //  - thiết lập số phút lại 59
        if (m === -1){
            h -= 1;
            m = 59;
        }
    
        // Nếu số giờ = -1 tức là đã hết giờ, lúc này:
        //  - Dừng chương trình
        if (h == -1){
            clearTimeout(timeout);
            alert('Hết giờ');
            location.href = "results";
            return false;
        }
    
        /*BƯỚC 1: HIỂN THỊ ĐỒNG HỒ*/
        // document.getElementById('h').innerText = h.toString();
        document.getElementById('m').innerText = m.toString();
        document.getElementById('s').innerText = s.toString();
    
        /*BƯỚC 1: GIẢM PHÚT XUỐNG 1 GIÂY VÀ GỌI LẠI SAU 1 GIÂY */
        timeout = setTimeout(function(){
            s--;
            start();
        }, 1000);
    }

</script>


<!-- footer -->
<div class="row" id="footer" >
    <div id="title" class="col-lg-12 col-md-12 col-sm-12 col-12" >
        <h1>End Quiz</h1>
    </div>
</div>   
@endsection
