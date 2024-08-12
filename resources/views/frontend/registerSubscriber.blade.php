@extends('login.partials.master')

@section('content')
<body class="hold-transition register-page">
    <div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
        </div>
        <div class="card-body">
        <p class="login-box-msg">Register a new membership</p>
    
        <form action="{{ route('subscriber_store') }}" method="post">
            @csrf
            <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Full name" name="nama" value="{{ old('nama') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-user"></span>
                </div>
            </div>
            </div>
            @if ($errors->has('nama'))
                <span class="text-danger">{{$errors->first('nama')}} </span>
            @endif

            <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope"></span>
                </div>
            </div>
            </div>
            @if ($errors->has('email'))
                <span class="text-danger">{{$errors->first('email')}} </span>
            @endif

            <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
            </div>
            @if ($errors->has('password'))
                <span class="text-danger">{{$errors->first('password')}} </span>
            @endif

            <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
            </div>
            @if ($errors->has('password_confirmation'))
                <span class="text-danger">{{$errors->first('password_confirmation')}} </span>
            @endif

            <!-- New fields -->
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Phone Number" name="nomer_telepon" value="{{ old('nomer_telepon') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-phone"></span>
                    </div>
                </div>
            </div>
            @if ($errors->has('nomer_telepon'))
                <span class="text-danger">{{$errors->first('nomer_telepon')}} </span>
            @endif

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Address" name="alamat" value="{{ old('alamat') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-home"></span>
                    </div>
                </div>
            </div>
            @if ($errors->has('alamat'))
                <span class="text-danger">{{$errors->first('alamat')}} </span>
            @endif

            <div class="input-group mb-3">
                <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-calendar"></span>
                    </div>
                </div>
            </div>
            @if ($errors->has('tanggal_lahir'))
                <span class="text-danger">{{$errors->first('tanggal_lahir')}} </span>
            @endif

            <input type="hidden" name="level_user" value="subscriber">

            <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                <label for="agreeTerms">
                I agree to the <a href="#">terms</a>
                </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
            </div>
        </form>
        <div class="social-auth-links text-center mb-3">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
            </div>
    
        <a href="{{ route('subscriber_login') }}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
@endsection
