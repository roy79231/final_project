<?php use App\Models\User;
?>

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="d-flex">
        <h1 class="me-auto">管理頁</h1>
    </div>
    @foreach($users as $user)
    <hr>
    <div class="list-group-item list-group-item-action m-1">
        <div>
            <div class="list-group list-group-horizontal justify-content-between" style="margin-bottom: 20px ">
                <div class="col-md-3">
                    <p style="font-size: 15px" class="list-group-item">ID : {{$user->id}}</p>
                </div >
                <div class="col-md-3">
                    <p style="font-size: 15px" class="list-group-item">Name : {{$user->name}}</p>
                </div>
                <div class="col-md-3">
                    <p style="font-size: 15px" class="list-group-item">Email : {{$user->email}}</p>
                </div>
                <div class="col-md-3">
                    <p style="font-size: 15px" class="list-group-item">Role : {{$user->role}}</p>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            @if($user->role !==User::ROLE_ADMIN)
            <div>
                <form action="{{ route('setAdmin',  ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit">設為admin</button>
                </form>
            </div>
            @endif
            @if($user->role !==User::ROLE_USER)
            <div>
                <form action="{{ route('setUser',  ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit">設為user</button>
                </form>
            </div>
            @endif            
        </div>
    </div>
    @endforeach
</div>

@endsection
