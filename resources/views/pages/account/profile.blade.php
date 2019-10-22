@extends('layouts.app', ['title' => 'Profile'])
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('includes.account_sidenav')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    @if(Session::has('sucessUpdate'))
                        <div class="alert alert-success" role="alert">
                        <strong>Successfully Updated </strong>
                        </div>
                    @endisset

                    <legend>Profile Setting</legend>
                    <form method="POST" action="{{ route('accnt_profile_submit_update') }}" enctype="multipart/form-data">
                        @csrf

                         <img src="{{ $profileIMG }}" class="img-fluid w-25 mb-3 mt-3" alt="">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="UserFname">{{ __('Firstname') }}</label>
                                <input type="text" name="UserFname" id="UserFname" class="form-control @error('UserFname') is-invalid @enderror" value="{{ Auth::user()->UserFname }}" placeholder="Firstname">
                                @error('Username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="UserLname">{{ __('Lastname') }}</label>
                                <input type="text" name="UserLname" id="UserLname" class="form-control @error('UserLname') is-invalid @enderror" value="{{ Auth::user()->UserLname }}" placeholder="Lastname">
                                @error('Username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="UserBirthDate">{{ __('Birth Date') }}</label>
                                <input type="date" name="UserBirthDate" id="UserBirthDate" class="form-control @error('UserBirthDate') is-invalid @enderror" value="{{ Auth::user()->UserBirthDate }}" placeholder="Birth Date">
                                @error('UserBirthDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="UserCountry">{{ __('Country') }}</label>
                                <input type="text" name="UserCountry" id="UserCountry" class="form-control @error('UserCountry') is-invalid @enderror" value="{{ Auth::user()->UserCountry }}" placeholder="Country">
                                @error('UserCountry')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="UserImage">{{ __('Profile Image') }}</label>
                                <input type="file" name="UserImage" id="UserImage" class="form-control @error('UserImage') is-invalid @enderror">
                                @error('UserImage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
