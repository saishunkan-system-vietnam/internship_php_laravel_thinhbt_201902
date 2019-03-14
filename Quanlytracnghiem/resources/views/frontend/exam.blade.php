@extends('frontend.index')
@section('content')


<!-- header -->
<div class="row" id="header">
    <div id="title" class="col-lg-12 col-md-12 col-sm-12 col-12">
        <h1>Quiz Exam</h1>
    </div>
</div>
<style>
    #scroll{
        display: none;
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 99;
        font-size: 18px;
        border: none;
        outline: none;
        background-color: red;
        color: white;
        cursor: pointer;
        padding: 15px;
        border-radius: 4px;
    }
    #scroll:hover{
        background-color: #555;
    }

    div.sticky{
        position: sticky;
        top: 250px;
    }
</style>

<script>
    
    function reset() {
        document.getElementById("examForm").reset(); 
    }
    //-----------------------------------------------------------------------------------
    //disable sau khi start
    function disableButton(btn){
        document.getElementById(btn.id).disabled = true;
        $("form").show();
        $("button").show();
        alert("Bắt đầu tính giờ làm bài");
        document.onkeydown = function() 
        {
            switch (event.keyCode) 
            {
                case 116 : //F5 button
                    return access();
                case 82 : //R button
                    if (event.ctrlKey) 
                    {
                        return access();
                    }
            }
        }
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    }

    //-----------------------------------------------------------------------------------
    //nop bai truoc khi het gio
    function access(){
        //window.confirm("Nộp bài trước khi hết giờ?");
        var message = confirm("Nộp bài trước khi hết giờ?");
        if (message == true) {
            document.getElementById("examForm").submit();
        }
    }

    //-----------------------------------------------------------------------------------
    //scroll to top
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("scroll").style.display = "block";
        } else {
            document.getElementById("scroll").style.display = "none";
        }
    }

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    //-----------------------------------------------------------------------------------
    //khong cho reload, neu reload se submit form
    

    
</script>
<input type="button" class="btn btn-danger" value="Top" onclick="topFunction()" id="scroll">
        
 <!-- content -->
<div class="row" id="content">
    
    <div id="left" class="col-lg-3 col-md-3 col-sm-12 col-12">
        <div class="sticky">
        <div class="card card-header bg-secondary text-light">Student infomation</div>
        <table class="table table-striped table-bordered">
            <tr>
            <td>Name</td><td>{{Auth::user()->name}}  @if(Auth::user()->type == 1)  <a href="{{ url('admin/user') }}"><i class="fas fa-user-check"></i></a>  @endif</td>
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
                <td>Time</td><td>{{ $time->time }} minutes</td>
            </tr>
        </table>
        <div style="background-color: red;color: white;font-size:30px; text-align: center">Time:  <span id="m">{{ $time->time }}</span>:<span id="s">00</span> </div>
        <br>
        <input type="button" id="btn1" name="start" onclick="start();disableButton(this);" class="btn btn-success btn-lg" value="Start Exam">
        <button type="button" id="done" onclick="access();" class="btn btn-danger btn-lg">
            Done
        </button>

        <button type="reset" id="reset" onclick="reset()" class="btn btn-primary btn-lg">
            Reset All
        </button>
        </div>
    </div>
    


<!-- right -->
    <div id="right" class="col-lg-9 col-md-9 col-sm-12 col-12">
        <form id="examForm" method="POST" action="{{ url('index/results') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="card card-header bg-info text-light">Thread</div>
            <br>
            <table>
                <tr>
                <td><br></td>
                </tr>
                @foreach($threads as $index => $questions)
                <tr>
                    <td><h4 style="font-weight: bold;">Question {{ $index+1 }} :  {{ $questions['content'] }} </h4></td><td style="text-align: right;color: red">{{ $questions['point'] }} point</td>
                </tr>
                <input type="hidden" name="point[{{ $questions['questions_id'] }}]" value="{{$questions['point']}}">
                <tr>
                    <td><br></td>
                </tr>
                {{-- dem so cau tra loi dung cua 1 cau hoi --}}
                <input type="hidden" name="count[{{ $questions['questions_id'] }}]" value="{{ $questions['count'] }}" >
                    {{-- neu so cau tra loi dung chi co 1 thi dung radio --}}
                    @if($questions['count'] == 1)
                        @foreach($questions['answers'] as $answers)
                <tr>
                    <td style="color:blue;" class="custom-control custom-radio">
                        <input type="radio" class="answers custom-control-input" id="{{ $answers->id }}" name="answer[{{ $answers->questions_id }}]" value="{{ $answers->id }}">
                        <label class="custom-control-label" for="{{ $answers->id }}">{{ $answers->answers }}</label>
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                        @endforeach
                    {{-- neu so cau tra loi dung > 1 thi dung checkbox --}}
                    @elseif($questions['count'] > 1)
                        @foreach($questions['answers'] as $answers)
                <tr>
                    <td style="color:blue;" class="custom-control custom-checkbox">
                        <input type="checkbox" class="answers custom-control-input" id="{{ $answers->id }}" name="answer[{{ $answers->questions_id }}][{{ $answers->id }}]" value="{{ $answers->id }}"> 
                        <label class="custom-control-label" for="{{ $answers->id }}">{{ $answers->answers }}</label>
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                        @endforeach
                    @endif
                <input type="hidden" name="total" value="0">
                @endforeach
            </table>
        </form>
    </div>
</div>

<script>
    //var h = 0; // Giờ
    var m = {{ $time->time }}; // Phút
    var s = 0; // Giây
        
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
            clearTimeout(timeout);
            alert('Hết giờ');
            location.href = "results";
            return false;
        }
    
        // Nếu số giờ = -1 tức là đã hết giờ, lúc này:
        //  - Dừng chương trình
        // if (h == -1){
        //     clearTimeout(timeout);
        //     alert('Hết giờ');
        //     location.href = "results";
        //     return false;
        // }
    
        /*BƯỚC 2: HIỂN THỊ ĐỒNG HỒ*/
        // document.getElementById('h').innerText = h.toString();
        document.getElementById('m').innerText = m.toString();
        document.getElementById('s').innerText = s.toString();
    
        /*BƯỚC 3: GIẢM PHÚT XUỐNG 1 GIÂY VÀ GỌI LẠI SAU 1 GIÂY */
        timeout = setTimeout(function(){
            s--;
            start();
        }, 1000);
    }

    //-----------------------------------------------------------------
    $("form").hide();
    $("button").hide();
</script>


<!-- footer -->
<div class="row" id="footer" >
    <div id="title" class="col-lg-12 col-md-12 col-sm-12 col-12" >
        <h1>End Quiz</h1>
    </div>
</div>   

@endsection

