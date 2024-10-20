@extends('components.layout')

@section('title', 'User Profile')

@section('content')
    @include('components.userheader')
    <br>
    <h1>User Profile</h1>


    @include('user.profile-components.accountinfo')
    <br>
    <h2>Your Activity log</h2>
    @include('user.profile-components.activitylog')

@endsection
