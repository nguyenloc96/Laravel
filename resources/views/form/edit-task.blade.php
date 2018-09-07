@extends('layouts.app')

@section('navbar')
    @if (Auth::check())
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/home')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hi, {{ Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('/infor/user')}}">View Information</a>
                        <a class="dropdown-item" href="{{url('/logout')}}">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
        @section('content')
            <div class="container mt-3 panel-body">
                <!-- Display Validation Errors -->
                @include('common.errors')
                @if (session('success'))
                    <div class="container mt-3 alert alert-success">
                        <div> {{ session('success') }} </div>
                    </div>
                @endif
                <!-- New Task Form -->
                <div class="card">
                    <div class="card-header">
                        Edit Task
                    </div>
                    <div class="card-body">
                        <form action="{!!route('updateTask',$data['id'])!!}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            
                            <!-- Task Name -->
                            <div class="form-group">
                                <label for="task" class="col-sm-3 control-label" id="lable-task">Task</label>

                                <div class="col-sm-12">
                                    <input 
                                        type="text" 
                                        name="name" id="task-name" 
                                        class="form-control"
                                        value="{{ old('name', isset($data)? $data['name'] : null) }}"
                                    >
                                </div>
                            </div>

                            <!-- Add Task Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                    <a class="btn btn-danger" href="{{url('/form/add-task')}}">
                                        <i class="fas fa-ban"></i> Cannel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endsection
    @endif
@endsection

