@extends('auth.layout')

@section('content')
    <div class="container-fluid mt-3 panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
        @if (session('error'))
            <div class="container mt-3 alert alert-danger">
                <div> Account registration failed </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                Register
            </div>
            <div class="card-body">
                <form action="{!!route('postRegister')!!}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group row mt-4">
                        <label for="nameUser" class="col-sm-4 col-form-label">
                            <span class="float-right">Name</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" name="name" class="form-control" id="nameUser" placeholder="Username" value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="emailUser" class="col-sm-4 col-form-label">
                            <span class="float-right">E-Mail Address</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="email" name="email" class="form-control" id="emailUser" placeholder="Email" value="{{old('email')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="passlUser" class="col-sm-4 col-form-label">
                            <span class="float-right">Password</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="password" name="password" class="form-control" id="passlUser" placeholder="Password" value="{{old('password')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">
                            <span class="float-right">&nbsp;</span>
                        </label>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-registered"></i> Register
                            </button>
                            <a class="btn btn-danger" href="{{url('/login')}}">
                                <i class="fas fa-ban"></i> Cannel 
                            </a>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection