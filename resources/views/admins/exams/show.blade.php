@extends('layouts.adminApp')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
    @endif

    @if (Session::has('error'))
    <div class="alert alert-danger text-center">{{ Session::get('error') }}</div>
@endif

    <a class="btn btn-primary" href="{{ url('admins/exams/create') }}" style="margin-top: 20px">add exam</a>

    <table class="table" style="margin-top: 20px">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">name</th>
                <th scope="col">level</th>
                <th scope="col">term</th>
                <th scope="col">control</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($exams as $exam)
                <tr>
                    <th scope="row">{{ $exam->id }}</th>
                    <td>{{ $exam->name }}</td>
                    <td>{{ $exam->level_id }}</td>
                    <td>{{ $exam->term }}</td>
                    <td>
                        <a href="{{ url('admins/questions/show/' . $exam->id) }}" class='btn btn-success'>
                            details
                        </a>

                        <a href="{{ url('admins/exams/active/' . $exam->id) }}" class='btn btn-primary'>
                            active
                        </a>

                        <a href="{{ url('admins/exams/edit/' . $exam->id) }}" class='btn btn-info'>
                            edit
                        </a>

                        <button type="button" class="btn btn-secondary edit_modal" 
                        data-toggle="modal"  data-target="#edit_modal" id="{{$exam->id}}">
                            add questions
                        </button>

                        <a href="{{ url('admins/exams/delete/' . $exam->id) }}" class='btn btn-danger'>
                            delete
                        </a>
                        
                        
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

                        <!--   add questions modal  -->
    <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('admins/exams/update/number_questions')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        
                        <label for="">number of questions</label>
                        <input type="number" name="number_of_questions" value="0" id="number" min="1" class="form-control">
                        <input type="hidden" name="id" id="hidden_input">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function(){
            $('.edit_modal').on('click', function () {
                let id=$(this).attr('id');
                $('#hidden_input').val(id);
            });
        })
    </script>
@endsection
