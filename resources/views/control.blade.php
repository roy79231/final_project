<?php use App\Models\User; ?>

@extends('layouts.app')

@section('content')

<style>
    body {
        position: relative;
        font-size: 20px;
        margin: 0;
        padding: 0;
        height: 100%;
    }

    .background-overlay {
        position: fixed; /* Use fixed to cover the entire viewport */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('{{ asset('_25d6b211-50e8-4220-8a01-9fed3ba11c67.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        opacity: 0.35; /* Adjust the opacity value as needed */
        z-index: -3;
    }

    .navbar {
        z-index: 1000; /* 確保導覽列位於最上層 */
    }

    .dropdown-menu {
        z-index: 1001; /* 確保下拉選單位於最上層 */
        background-color: #fff; /* 添加背景色 */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* 添加陰影效果 */
    }

    .content-container {
        position: relative;
        z-index: 0;
    }
</style>
<div class="background-overlay"></div>
<div class="content-container">
<div class="container my-5">
    <div class="d-flex mb-4">
        <h1 class="me-auto" >管理頁</h1>
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
</div>

@endsection
