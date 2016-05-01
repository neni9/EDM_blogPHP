@extends('layouts.admin')

@section('title', $title)

@section('content')

<div class="page-header">
    <h1>{{$title}} <small>Published ({{$total['published']}}), Unpublished ({{$total['unpublished']}}) </small></h1>
</div>

@include('general.messages')

<div class="table-responsive">
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Statut</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Date de publication</th>
                <th>Catégorie</th>
                <th>Mots-clés</th>
                <th>Score</th>
                <th>Image</th>
                <th class='text-center button-control'>
                    Editer
                </th>
                <th class='text-center button-control'>
                    Supprimer
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td class='text-center' ><span class="label label-{{$post->status == 'Published' ? 'success' : 'default' }}">{{$post->status}}</span></td>
                <td><a href="/post/{{$post->id}}/edit" class="linkTitle">{{$post->title}}</a></td>
                <td>{{$post->user ? $post->user->name : 'Aucun auteur'}}</td>
                <td>{{!is_null($post->published_at) ? $post->published_at->format('d/m/Y H:i:s') : 'NC'}}</td>
                @if(empty($post->category->title))
                <td>N/A</td>
                @else 
                <td>{{$post->category->title}}</td>
                @endif
                <td>
                    @forelse($post->tags as $tag)
                    {{$tag->name}}
                    @empty
                    Aucun 
                    @endforelse
                </td>
                <td>
                    @if(!is_null($post->score_avg) && $post->score_avg != 0)
                        {{$post->score_avg}}/20
                    @else 
                        Aucune note
                    @endif
                </td>
                <td class='text-center'>
                    @if($post->picture)
                    <i class="fa fa-check success" aria-hidden="true"></i>
                    @else
                    <i class="fa fa-times error" aria-hidden="true"></i>
                    @endif
                </td>
                <td class='text-center button-control' >
                    <a href="/post/{{$post->id}}/edit">
                    <button class='btn btn-primary btn-xs '>
                    <i class="fa fa-pencil-square" aria-hidden="true"></i>
                    </button>
                    </a>
                </td>
                <td class='text-center button-control'>
                    <button class='btn btn-danger btn-xs deleteBtn ' data-toggle="modal" data-target="#delete" data-id="{{$post->id}}">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                    <div class="modal fade" id="delete">
                        <form id="deleteForm" class="form-horizontal" action="{{url('post',[$post->id])}}"  method="POST">
                            {{csrf_field()}}
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        <h4 class="modal-title custom_align" id="Heading">Supprimer un post</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger"> Voulez-vous vraiment supprimer ce post?</div>
                                        {{ Form::hidden('_method', 'DELETE') }}
                                    </div>
                                    <div class="modal-footer ">
                                        <button type="submit" class="btn btn-success" >Supprimer</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <p>Il n'y a aucun post à administrer.</p>
            @endforelse
        </tbody>
    </table>
</div>
<div class='row'>
    <div class="col-md-6 pull-left">
        {{ $posts->links() }}
    </div>
</div>
@endsection