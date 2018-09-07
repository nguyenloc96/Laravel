@extends('auth.layout')
@section('content')
    <div class="container-fluid mt-3 panel-body">
        <div class="card">
            <div class="card-header">
                Login
            </div>
            <div class="card-body">
                <div class="text-center">
                    Login unsuccessful. Please try again. 
                    Click on <a href="{{url('/login')}}">here</a> link to login with account user
                </div>
            </div>
        </div>
    </div>
@endsection
