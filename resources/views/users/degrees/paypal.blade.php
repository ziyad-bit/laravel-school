@extends('layouts.app')

@section('content')
    <div class="card bg-light mb-3" style="max-width: 18rem;">
        <div class="card-header">paypal</div>
        <div class="card-body">
            <form action="{{url('paypal/post')}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">paypal</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
   
   
@endsection
