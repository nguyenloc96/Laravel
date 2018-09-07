@extends('auth.layout')

@section('content')
    <div class="container-fluid mt-3 panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')
        @if (session('error'))
            <div class="container mt-3 alert alert-danger">
                <div> {{ session('error') }} </div>
            </div>
        @endif

        @if (session('success'))
            <div class="container mt-3 alert alert-success">
                <div> {{ session('success') }} </div>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                Login
            </div>
            <div class="card-body"> 
                <form action="{!!route('postLogin')!!}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group row mt-4">
                        <label for="emailUser" class="col-sm-4 col-form-label">
                            <span class="float-right">E-Mail Address</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="email" value="{{old('email')}}" name="email" class="form-control" id="emailUser" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="passlUser" class="col-sm-4 col-form-label">
                            <span class="float-right">Password</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="password" value="{{old('password')}}" name="password" class="form-control" id="passlUser" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">
                            <span class="float-right">&nbsp;</span>
                        </label>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </button>
                            <a class="btn btn-danger" href="{{url('/home')}}">
                                <i class="fas fa-ban"></i> Cannel 
                            </a>
                        </div>
                    </div>
                    <!-- <div class="text-center">
                        <a class="d-block small mt-4 " href="#">Forgot the password</a>
                    </div> -->
                    <div class="text-center">
                        <a class="d-block small " href="{{url('/register')}}">Register an account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection