@extends('layouts.adminApp')

@section('content')
    <a class="btn btn-primary" href="{{url('admins/exams/create')}}">add exam</a>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">name</th>
                <th scope="col">level</th>
                <th scope="col">term</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            
        </tbody>
    </table>
@endsection
