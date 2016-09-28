@extends('layouts.master')

@include('includes.header')

@section('styles')
    <link rel="stylesheet" href="{{URL::asset('css/sign.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/materialize.css')}}">
@endsection

@include('includes.info')

@section('content')
    <div class="col s12 sign-form">
        <div class="row">
            <form class="col s4 sign-up" method="post" action="{{route('signup')}}">
                <h3>Sign Up</h3>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="first_name" type="text" name="first_name" class="validate">
                        <label for="first_name">First Name</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="last_name" type="text" name="last_name" class="validate">
                        <label for="last_name">Last Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" name="password1" class="validate">
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" name="password2" class="validate">
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" name="email" class="validate">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="button">
                    <button  type="submit" class="waves-effect waves-light btn"><i class="material-icons right">assignment</i>Sign up</button>
                    <input type="hidden" name="_token" value="{{Session::token()}}">

                </div>
            </form>

            <form class="col s8" method="post" action="{{route('signin')}}">
                <div class="row sign-in">
                    <h3>Sign In</h3>
                    <div class="input-field col s12">
                        <input id="signin-email" type="email" name="signin-email" class="validate">
                        <label for="signin-email">Email</label>
                    </div>
                </div>
                <div class="row sign-in">
                    <div class="input-field col s12">
                        <input id="signin-password" type="password" name="signin-password" class="validate">
                        <label for="signin-password">Password</label>
                    </div>
                </div>
                <div class="button">
                    <button type="submit" class="waves-effect waves-light btn sign-in"><i class="material-icons right">vpn_key</i>Sign
                        In</button>
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="{{URL::asset('js/materialize.min.js')}}"></script>
@endsection