@extends('layouts.app')
@section('navbar')
    @if (Auth::check())
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/home')}}">
                        <i class="fas fa-home"></i> Home <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hi, {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('/infor/user')}}">
                            <i class="fas fa-street-view"></i> View Information
                        </a>
                        <a class="dropdown-item" href="{{url('/logout')}}">
                            <i class="fas fa-sign-out-alt"></i> Logout 
                        </a>
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
                        New Task
                    </div>
                    <div class="card-body">
                        <form action="{!!route('addTask')!!}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <!-- Task Name -->
                            <div class="form-group">
                                <label for="task" class="col-sm-3 control-label">Task</label>

                                <div class="col-sm-12">
                                    <input type="text" name="name" id="task-name" class="form-control">
                                </div>
                            </div>

                            <!-- Add Task Button -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Add Task
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="container mt-3 mb-3 panel-body">
            @if (count($tasks) > 0)
            
                <div class="card">
                    <div class="card-header">
                        Current Tasks
                    </div>

                    <div class="ml-3 mr-3 card-body">
                        <table class="table table-hover task-table">

                            <!-- Table Headings -->
                            <thead>
                                <th>Task</th>
                                <th>&nbsp;</th>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <!-- Task Name -->
                                        <td style="max-width: 700px !important;">
                                            <div>{{ $task->name }}</div>
                                        </td>

                                        <td>
                                            <a class="btn btn-success btn-delete-task" href="edit-task/{{$task->id}}">
                                                <i class="fas fa-edit"></i> Edit 
                                            </a>

                                            <a class="btn btn-danger btn-edit-task" href="delete-task/{{$task->id}}">
                                                <i class="fas fa-trash-alt"></i> Delete 
                                            </a>
                                        </td>   
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            </div>

        @endsection
    @endif
@endsection

