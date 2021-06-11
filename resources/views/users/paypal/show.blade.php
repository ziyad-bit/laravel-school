@extends('layouts.app')

@section('content')
    @if (Session::has('error'))
        <div class="alert alert-danger text-center">{{ Session::get('error') }}</div> 
    @endif

    <div class="d-flex justify-content-center">
        <div class="card bg-light mb-3" style="max-width: 26rem; margin-top: 10%">
            <div class="card-header">
                <p>Are you want to make grievance for this degree ?</p>
                <form action="{{url('paypal/post/'.$id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">(20 EUR) paypal</button>
                </form>
            </div>
        </div>
    </div>
    
@endsection
