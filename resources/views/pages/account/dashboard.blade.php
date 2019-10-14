@extends('layouts.app', ['title' => 'Dashboard'])
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('includes.account_sidenav')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Dashboard Page</div>
            </div>
        </div>
    </div>
</div>
@endsection
