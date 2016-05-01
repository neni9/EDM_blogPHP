@extends('layouts.master')
@section('title', $title)
@section('content')
<div class="row top-margin">
    <div class="col-md-6 col-md-offset-3"  id='authForm'>
        <h1 class='text-center'>{{$title}}</h1>
        <hr>
        <div class="text-center"><i class="fa fa-user fa-5x" aria-hidden="true"></i></div>
        <p class='text-justify registerMsg'>
            <a href="register" id='registerLink'>Pas encore inscrit? Cliquez ici pour afficher le formulaire d'inscription. </a>
        </p>
        
        @include('general.messages')

        <form method="POST" action="{{url('login')}}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                @if($errors->has('email')) <span class="error">{{$errors->first('email')}}</span> @endif
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" name="password" placeholder="Email">
                @if($errors->has('password')) <span class="error">{{$errors->first('password')}}</span> @endif
            </div>
            <div class="form-group">
                <label>Remember me</label>
                <input id="remember" type="radio" name="remember" value="remember">
            </div>
            <button class='btn btn-large btn-block btn-warning full-width' type='submit'>Connexion <i class="fa fa-sign-in" aria-hidden="true"></i></button>
        </form>
        
    </div>
</div>
@stop