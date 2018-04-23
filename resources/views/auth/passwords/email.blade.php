@extends('layouts.app')

@section('title', 'Vecto: Password Recover Password')

@section('content')

<div class="container passwordForgotten">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="text-center">
                <h3><i class="fa fa-lock fa-4x"></i></h3>
                <h2 class="text-center">Forgot Password?</h2>
                <p>You can reset your password here.</p>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('password.email') }}">
                        @include("partials.errors")
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                <input name="email" placeholder="email address" class="form-control" type="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection