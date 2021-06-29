@foreach ($active_exams as $active_exam)
    <a href="{{url('exams/show/'.$active_exam->token.'?page=1')}}" class="list-group-item list-group-item-action ">
        <div class="d-flex w-100 justify-content-between">
            <img src="{{asset('images/profile/'.$active_exam->admins->photo)}}" class="rounded-circle"  alt="loading">
            <h5 class="mb-1">{{$active_exam->admins->name}} added:</h5>
            <small>{{diff_date($active_exam->updated_at)}}</small>
        </div>
        <p class="mb-1">{{$active_exam->subjects->name}} exam</p>
    </a>
@endforeach


