@extends('dashboard.layout')

@section('content')
<h1>Create User</h1>
@include('dashboard.fragment._errors-form')
<form action="{{ route('user.store') }}" method="post">
    @include('dashboard.user._form')
</form>
@endsection
