
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<style>
    #task{
        border: 1px solid #ccc;
        max-width: 90%;
        padding-left: 10px;
    }
    
</style>
</head>
<body>
@extends('Backend/layout/main')
@section('content')
<div class="container-fluid px-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Task Form</h6>
              </div>
            </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 p-4">
                        <form action="{{route('add_task_member')}}" method="post">
                            @csrf
                            <label for="">Select Members</label>
                            <select name="user_id[]" id="mySelect" class="form-control" multiple="multiple" style="width: 90%">
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                                <br><br>
                            <label for="">Select Task</label>
                            <select name="task_id" id="task" class="form-control">
                                @foreach($tasks as $task)
                                <option value="{{$task->id}}">{{$task->title}}</option>
                                @endforeach
                            </select>
                                <br>
                            <input type="submit" value="Submit" class="btn btn-info">
                        
                        </form>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#mySelect').select2({
        placeholder: "Select options",
        allowClear: true
    });
});
</script>
</body>
</html>
