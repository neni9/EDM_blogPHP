@extends('layouts.master')

@section('title', $title)

@section('content')
<div class="row top-margin" >
    <div class="col-md-6 col-md-offset-3"  id='authForm'>
        <h1 class='text-center'>{{$title}}</h1>
        <hr>
        <div class="text-center"><i class="fa fa-user-plus fa-5x" aria-hidden="true"></i></div>
        <p class='text-justify' style="margin-top:2%;">
            <a href="/login" id='connexionLink'>Déjà inscrit? Cliquez ici pour vous connecter. </a>
        </p>
       
       @include('general.messages')
       
        <form method="POST" action="{{url('register')}}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">Nom d'utilisateur</label>
                <input type="name" class="form-control" name="name" placeholder="Username">
                @if($errors->has('name')) <span class="error">{{$errors->first('name')}}</span> @endif
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                @if($errors->has('email')) <span class="error">{{$errors->first('email')}}</span> @endif
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
                @if($errors->has('password')) <span class="error">{{$errors->first('password')}}</span> @endif
            </div>
            <div class="form-group">
                <label for="password">Confirmation du mot de passe</label>
               <input type="password" name="password_confirmation" class='form-control' placeholder="Password">
                @if($errors->has('password')) <span class="error">{{$errors->first('password')}}</span> @endif
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <button class='btn btn-large btn-block btn-warning full-width' type='submit'>Inscription <i class="fa fa-sign-in" aria-hidden="true"></i></button>
        </form>
    </div>
</div>
@stop