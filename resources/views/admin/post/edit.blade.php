@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1" >
        <h1 class='text-center formTitle'>{{$title}}</h1>
        <hr>
       
       @include('general.messages')

        @can('update',$post)
        <div class="well well-sm">
            <form method="POST" action="{{url('post',[$post->id])}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="user_id" value="{{$userId}}"></input>
                {{ Form::hidden('_method', 'PUT') }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="title">Titre</label>
                                <input type="text" name="title" class='form-control' value="{{$post->title}}">
                                @if($errors->has('title')) <span class="error">{{$errors->first('title')}}@endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content">Catégorie</label>
                            <select name="category_id" class='form-control'>
                                <option value="0">non catégorisé</option>
                                @forelse($categories as $id => $title)
                                <option {{$post->hasCat($id) ? 'selected' : ''}} value="{{$id}}">{{$title}}</option>
                                @empty
                                @endforelse
                            </select>
                            @if($errors->has('category_id')) <span class="error">{{$errors->first('category_id')}}@endif
                        </div>
                        <div class="form-group">
                            <label for="published_at">Date de publication</label>
                            <input placeholder="y-m-d H:i:s" type="text" id="published_at" name="published_at" class='form-control' value="{{$post->published_at}}">
                            @if($errors->has('published_at')) <span class="error">{{$errors->first('published_at')}}@endif
                        </div>
                        <div class="form-group">
                            <label for="tags_id[]">Tags</label>
                            <select multiple="multiple" name="tags_id[]" class='form-control' size="5">
                            @forelse($tags as $id => $name)
                            <option {{$post->hasTag($id) ? 'selected' : ''}} value="{{$id}}">{{$name}}</option>
                            @empty
                            @endforelse
                            </select>
                            @if($errors->has('tags_id')) <span class="error">{{$errors->first('tags_id')}}@endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Statut</label>
                            <select name='status' class='form-control'>
                            <option value="published" {{ ($post->status == 'Published') ? 'selected' : ''}} >Published</option>
                            <option value="unpublished" {{ ($post->status == 'Unpublished') ? 'selected' : ''}}>Unpublished</option>
                            </select>
                            @if($errors->has('status')) <span class="error">{{$errors->first('status')}}@endif
                        </div>
                        <div class="form-group">
                            <label>Nom de l'image</label>
                            <input type="text" class='form-control' name="picture_name" value="{{ ($post->picture ? $post->picture->name : '') }}" />
                            @if($errors->has('picture_name')) <span class="error">{{$errors->first('picture_name')}}@endif
                        </div>
                        <div class="form-group">
                            <label>Ajouter/Remplacer l'image</label>
                            <input type="file" class='form-control' name="picture" />
                            <label>Supprimer l'image ? Oui </label> <input type="checkbox" name="deleteImage">
                        </div>
                    </div>
                    <div class="col-md-12">

                        <div class="row content-area">
                            @if($post->picture)
                            <p class='text-center'><b>Image actuelle :</b></p>
                            <img class='img-responsive' style="display:block;margin:auto;" src="/uploads/{{$post->picture->uri}}">
                            @else 
                            <p class='text-center'>Aucune image n'est rattachée à ce post.</p>
                            @endif
                            @if($errors->has('picture')) <span class="error">{{$errors->first('picture')}}@endif
                        </div>


                        <div class="form-group content-area" >
                            <label for="content">Contenu</label>
                            <textarea name="content" class='form-control' rows="25">{{$post->content}}</textarea>
                            @if($errors->has('content')) <span class="error">{{$errors->first('content')}}@endif
                        </div>

                        <div class="row">
                            <button class='btn btn-large btn-block btn-primary full-width' type='submit'>Mettre à jour</button>  
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @else 
        <div class="alert alert-danger full-width">
            <p>Vous n'avez pas les droits requis pour éditer cet article. <br>
            Seul le créateur de l'article ou l'administrateur peut le modifier <strong>(Créateur de l'article : {{$post->user->name}})</strong></p>
        </div>

        <a href="/post"><button class='btn btn-primary'> <i class="fa fa-arrow-left" aria-hidden="true"></i> Retourner au dashboard</button></a>
        @endcan
    </div>
</div>
@endsection