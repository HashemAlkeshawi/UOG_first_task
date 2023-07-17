@extends('mainTemplate')
@section('title')
<title>Home</title>
@endsection
@section('navbar')
@include('components\navBar')
@endsection
@section('content')
<div style="margin-top: 50;" class="container">
    <div class="page-header">
        <h1 class="header">Home page</h1>
    </div>
    <form method="GET" action="{{URL('/d_user/filterd_users')}}">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <label for="filter_by1">Search by email</label>
                    <input class="form-control" type="email" placeholder="email" name="EmailFilter" @if(@isset($filters)) value="{{$filters->EmailFilter}}" @endif>

                </li>
                <li class="list-group-item">
                    <label for="filter_by2">Search by username</label>
                    <input class="form-control" type="string" placeholder="username" name="UsernameFilter" @if(@isset($filters)) value="{{$filters->UsernameFilter}}" @endif>

                </li>
                <li class="list-group-item">
                    <label for="filter_by3">Search by name</label>
                    <input class="form-control" type="string" placeholder="full name" name="NameFilter" @if(@isset($filters) ) value="{{$filters->NameFilter}}" @endif>
                </li>

            </ul>
        </div>
        <br>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="search_is_active" name="ActivationFilter" value="1" @if(@isset($filters) && $filters->ActivationFilter == '1')checked @endif>
            <label class="form-check-label">Active Users Only</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="search_is_admin" name="AdministrationFilter" value="1" @if(@isset($filters) && $filters->AdministrationFilter == '1 ')checked @endif>
            <label class="form-check-label">Admins Only</label>
        </div>
        <br>
        <button class="btn btn-primary" type="submit">Apply filters</button>
        <a href="{{URL('d_user/')}}" class="btn btn-danger">Remove filters</a>
        <br>
        <br>

    </form>
    <h6 class="well well-lg">Loged in user id: {{Auth::user()->id}}</h6>
    <h6 class="well well-lg">Loged in username: {{Auth::user()->username}}</h6><br>
    @if(@isset($d_users) && ! $d_users->isEmpty())
    <ul class="list-group">
        @foreach($d_users as $d_user)

        <li class="list-group-item  well"><span class="text-primary">email:</span> {{$d_user->email}}</li>
        <li class="list-group-item  well"><span class="text-primary">User Status 'Admin/User':</span> @if($d_user->is_admin ==1) Admin @else User @endif</li>
        <li class="list-group-item  well"><span class="text-primary">Account Status: </span>@if($d_user->is_active ==1) <span class="text-success">Active</span>@else <span class="text-danger">Inactive</span> @endif</li>


        <br>
        <div class="row">
            <div class="col-auto">
                    <a href="{{URL('d_user/'.$d_user->id .'/edit')}}" class="btn btn-primary" name="edit" >Edit</a>
            </div>
            <div class="col-auto">
                <form method="POST" action="{{URL('d_user/'.$d_user->id)}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" name="Delete" type="submit">Delete</button>
                </form>
            </div>
        </div>
        <hr>
        @endforeach
    </ul>
    <div>
        {{ $d_users->links('pagination::bootstrap-4') }}
    </div>
    @else
    <div class="alert alert-danger">
        <p>No useres found!</p>
    </div>

    @endif

</div>
@endsection