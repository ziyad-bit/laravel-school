@extends('layouts.adminApp')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger text-center">{{ Session::get('error') }}</div>
    @endif

    <table class="table" style="margin-top: 20px">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">question</th>
                <th scope="col">choice 1</th>
                <th scope="col">choice 2</th>
                <th scope="col">choice 3</th>
                <th scope="col">choice 4</th>
                <th scope="col">choice 5</th>
                <th scope="col">correct answer</th>
                <th scope="col">control</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $question)
                <tr>
                    <th scope="row">{{ $question->id }}</th>
                    <td>{{ $question->question }}</td>
                    <td>{{ $question->choice1 }}</td>
                    <td>{{ $question->choice2 }}</td>

                    @if (isset($question->choice3 ))
                        <td>{{ $question->choice3 }}</td>
                    @else
                        <td>empty</td>
                    @endif
                    
                    @if (isset($question->choice4 ))
                        <td>{{ $question->choice4 }}</td>
                    @else
                        <td>empty</td>
                    @endif

                    @if (isset($question->choice5 ))
                        <td>{{ $question->choice5 }}</td>
                    @else
                        <td>empty</td>
                    @endif

                    <td>{{$question->correct_ans}}</td>

                    <td>
                        <a href="{{ url('admins/questions/edit/' . $question->id) }}" class='btn btn-primary'>
                            edit
                        </a>

                        <a href="{{ url('admins/questions/delete/' . $question->id) }}" class='btn btn-danger'>
                            delete
                        </a>
                        
                        
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="questionpleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="questionpleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('admins/questions/update/number_questions')}}" method="POST">
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

