@extends('auth.layout')
@if(Auth::check())
    @section('content')
        <div class="container-fluid mt-3 panel-body">
            <div class="card">
                <div class="card-header">
                    View Information: {{ Auth::user()->name }}
                </div>
                <div class="card-body">
                    <table class="table">
                        <caption> Info: {{ Auth::user()->name }}</caption>
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ Auth::user()->id }}</td>
                                <td>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ Auth::user()->email }}</td>
                                <td>
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>{{ Auth::user()->name }}</td>
                                <td>
                                    <a href="#"> Edit </a>
                                </td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td>{{ Auth::user()->password }}</td>
                                <td>
                                    <a href="#"> Edit </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
@else
    @section('content')
        <div class="container-fluid mt-3 panel-body">
            <div class="text-center">
                Please login to view user information...
                Click on <a href="{{url('/login')}}">here</a> link to login with account user
            </div>
            
        </div>
    @endsection
@endif