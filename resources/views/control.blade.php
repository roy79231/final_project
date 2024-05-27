<?php use App\Models\User; ?>

@extends('layouts.app')

@section('content')

<style>
    body{
        background-color: rgb(237, 218, 191);;
    }
</style>

<div class="container my-5">
    <div class="d-flex mb-4">
        <h1 class="me-auto">管理頁</h1>
    </div>
    @foreach($users as $user)
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="col-md-3">
                <p class="mb-0"><strong>ID:</strong> {{$user->id}}</p>
            </div>
            <div class="col-md-3">
                <p class="mb-0"><strong>Name:</strong> {{$user->name}}</p>
            </div>
            <div class="col-md-3">
                <p class="mb-0"><strong>Email:</strong> {{$user->email}}</p>
            </div>
            <div class="col-md-3">
                <p class="mb-0"><strong>Role:</strong> {{$user->role}}</p>
            </div>
        </div>
        <div class="card-body d-flex justify-content-end">
            @if($user->role !== User::ROLE_ADMIN)
            <form action="{{ route('setAdmin', ['user' => $user->id]) }}" method="POST" class="me-2">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-primary">設為 admin</button>
            </form>
            @endif
            @if($user->role !== User::ROLE_USER)
            <form action="{{ route('setUser', ['user' => $user->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-secondary">設為 user</button>
            </form>
            @endif            
        </div>
    </div>
    @endforeach
</div>

@endsection
