@extends('layouts.master')

@section('title', $title)

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')
    @if($post)
        <div class="article-details">
            <h1>
                <a href="{{url('article',[$post->id])}}" class="">{{$post->title}}</a>
                @if($post->score_avg)
                <span class="pull-right notes">Note : {{$post->score_avg}}/20</span>
                @else 
                <span class="pull-right notes">Non noté</span>
                @endif
            </h1>
            @if(!is_null($post->user))
            <span class="well well-block" >Posté par {{$post->user->name}} 
            @else
            <span class="well metadata">Posté par Anonyme
            @endif
            @if(!is_null($post->published_at))
            le {{$post->published_at->format('d/m/Y H:i:s')}}</span>
            @else 
            le {{$post->created_at->format('d/m/Y H:i:s')}}</span>
            @endif
            <hr>
            <div class="row">
                <div class="col-md-12">
                    @if(!is_null($post->picture))
                    <div class='img-post'>
                        <img class="img img-responsive" src="/uploads/{{$post->picture->uri}}">
                        <p class='text-center'>{{$post->picture->name}}</p>
                    </div>
                    @else
                    <p>pas d'images</p>
                    @endif
                    <div class='post-content'>
                        @if(!empty($post->content))
                        <hr>
                        <p class='text-justify '>{{$post->content}} </p>
                        @else
                        <p>pas de contenu</p>
                        @endif
                    </div>
                </div>
            </div>
            <hr>
            @if(!is_null($post->category))
            <span  class='pull-right'>Catégorie: <span class="label label-success">{{$post->category->title}}</span> </span>
            @else
            <span  class='pull-right'>Catégorie : <span class="label label-default">Non Catégorisé</span> </span>
            @endif
            Mots-clés : 
            @forelse($post->tags as $tag)
            <span class="label label-primary">{{$tag->name}}</span>
            @empty
            <span class="label label-default">Aucun</span>
            @endforelse
        </div>
        <hr>
        @if(\Auth::check())
        <div class="col-md-10 col-md-offset-1 rateBlock">
            <div class="well">
                <h1>Notez cet article ! </h1>
                @can('authorizeRate',$post)
                <p>Cet article vous a plu? Ou tout le contraire? Notez-le !</p>
                <div class="col-md-12">
                    <div class="rating rating2" id="note">
                        <!--
                            --><a href="#note" data-note="20" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 20 étoiles">★</a><!--
                            --><a href="#note" data-note="19" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 19 étoiles">★</a><!--
                            --><a href="#note" data-note="18" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 18 étoiles">★</a><!--
                            --><a href="#note" data-note="17" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 17 étoiles">★</a><!--
                            --><a href="#note" data-note="16" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 16 étoiles">★</a><!--
                            --><a href="#note" data-note="15" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 15 étoiles">★</a><!--
                            --><a href="#note" data-note="14" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 14 étoiles">★</a><!--
                            --><a href="#note" data-note="13" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 13 étoiles">★</a><!--
                            --><a href="#note" data-note="12" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 12 étoiles">★</a><!--
                            --><a href="#note" data-note="11" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 11 étoiles">★</a><!--
                            --><a href="#note" data-note="10" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 10 étoiles">★</a><!--
                            --><a href="#note"  data-note="9" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 9 étoiles">★</a><!--
                            --><a href="#note"  data-note="8" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 8 étoiles">★</a><!--
                            --><a href="#note"  data-note="7" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 7 étoiles">★</a><!--
                            --><a href="#note"  data-note="6" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 6 étoiles">★</a><!--
                            --><a href="#note"  data-note="5" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 5 étoiles">★</a><!--
                            --><a href="#note"  data-note="4" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 4 étoiles">★</a><!--
                            --><a href="#note"  data-note="3" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 3 étoiles">★</a><!--
                            --><a href="#note"  data-note="2" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 2 étoiles">★</a><!--
                            --><a href="#note"  data-note="1" data-toggle="modal" data-target="#noteConfirm" data-id="{{$post->id}}" title="Donner 1 étoile">★</a><!--
                            -->
                    </div>
                </div>
                <div class="modal fade" id="noteConfirm">
                    <form id="noteForm" class="form-horizontal" action=""  method="POST">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
                                    <h4 class="modal-title custom_align" id="Heading">Confirmation de vote</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-info noteInfo"> Voulez-vous vraiment attribuer la note de <span class="userNote"></span> / 20 ?</div>
                                    <div class="alert alert-success confirmInfo"> Merci d'avoir voté!</div>
                                    <input type="hidden" name="post_id" value="">
                                    <input type="hidden" name="note" value="">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </div>
                                <div class="modal-footer ">
                                    <button type="submit" class="btn btn-success" id='confirmVoteBtn' >Confirmer le vote</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <p>Vos votes permettent d'établir un classement des articles sur le site.</p>
                @else 
                <div class="alert alert-info">Vous avez déjà voté pour cet article.</div>
                @endif
            </div>
        </div>
    @endif
    @else
    <p>pas de d'article</p>
    @endif
@stop