@extends('layouts.master')

@section('title', $title)

@section('content') 

@include('general.messages')

<h1>Catégorie {{$title}}</h1>
<hr>

<div class="wrapper-article">
    <div class="row">
    @forelse($posts as $post)
        <div class="col-md-6">
            <h2 class='text-left title'>{{$post->title}}</h2>
             <span class="metadata">
                <i class="fa fa-clock-o" aria-hidden="true"></i> 
                @if(!is_null($post->published_at))
                    {{$post->published_at->format('d/m/Y H:i:s')}} à {{$post->published_at->format('H:i:s')}}
                @else 
                   {{$post->created_at->format('d/m/Y H:i:s')}}
                @endif
                <i class="fa fa-user" aria-hidden="true"></i> 
                @if(!is_null($post->user))
                    <b class='auteur'>{{$post->user->name}}</b>
                @else
                    Aucun auteur 
                @endif
                <br>
            </span>
            

             @if(!is_null($post->picture))
            <div class='img-post' >
                <img class="img img-responsive" src="/uploads/{{$post->picture->uri}}">
                <p class='text-center'>{{$post->picture->name}}</p>
            </div>
            @else
            <p>pas d'images</p>
            @endif
           
            @if(!empty($post->content))
            <p class='text-justify well post-content'>{{Illuminate\Support\Str::limit($post->content, 300)}}...
                <a href="/article/{{$post->id}}"><button class='btn btn-primary pull-right btn-xs btn-more'>Lire la suite</button></a>
            </p>
            @else
            <p>pas de contenu</p>
            @endif
            
            @if(!empty($post->score_avg))
                 <span class="note-xs margin-sides" >Note : {{$post->score_avg}} / 20 ({{$post->rate}} vote(s))</span>
            @else 
                 <span class="note-xs margin-sides" >Note :Aucune ({{$post->rate}} vote(s))</span>
            @endif
            <span  class='pull-left margin-sides'>
                <i class="fa fa-tags" aria-hidden="true"></i>  Mots-clés : 
                @forelse($post->tags as $tag)
                <span class="label label-default">{{$tag->name}}</span>
                @empty
                <span class="label label-default">Aucun</span>
                @endforelse
            </span>
            <span class="margin-sides">
            @if(!is_null($post->category))
                <i class="fa fa-list" aria-hidden="true"></i> Catégorie: <span>{{$post->category->title}}</span> 
            @else
                <i class="fa fa-list" aria-hidden="true"></i> Catégorie : <span>Non Catégorisé</span> 
            @endif
            </span>
            
            <hr>
        </div>
    @empty
    @endforelse
    </div>
</div>

@endsection