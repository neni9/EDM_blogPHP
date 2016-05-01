@extends('layouts.admin')

@section('title', $title)

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1" >
        <h1 class='text-center formTitle'>{{$title}}</h1>
        <hr>
       
        @include('general.messages')
        
        <div class="well well-sm">
            <form method="POST" action="{{url('post')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="user_id" value="{{$userId}}"></input>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="title">Titre</label>
                                <input type="text" name="title" class='form-control' value="{{old('title')}}">
                                @if($errors->has('title')) <span class="error">{{$errors->first('title')}}@endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content">Catégorie</label>
                            <select name="category_id" class='form-control'>
                                <option value="0" selected>non catégorisé</option>
                                @forelse($categories as $id => $title)
                                <option value="{{$id}}">{{$title}}</option>
                                @empty
                                @endforelse
                            </select>
                            @if($errors->has('category_id')) <span class="error">{{$errors->first('category_id')}}@endif
                        </div>
                        <div class="form-group">
                            <label for="published_at">Date de publication</label>
                            <input placeholder="y-m-d H:i:s" type="text" id="published_at" name="published_at" class='form-control' value="{{old('published_at')}}">
                            @if($errors->has('published_at')) <span class="error">{{$errors->first('published_at')}}@endif
                        </div>
                        <div class="form-group">
                            <label for="tags_id[]">Tags</label>
                            <select multiple="multiple" name="tags_id[]" class='form-control' size="5">
                                @forelse($tags as $id => $name)
                                <option value="{{$id}}">{{$name}}</option>
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
                                <option value="published">Published</option>
                                <option value="unpublished">Unpublished</option>
                            </select>
                            @if($errors->has('status')) <span class="error">{{$errors->first('status')}}@endif
                        </div>
                        <div class="form-group">
                            <label for="picture_name">Nom de l'image</label>
                            <input type="text" class='form-control' name="picture_name" />
                            @if($errors->has('picture_name')) <span class="error">{{$errors->first('picture_name')}}@endif
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class='form-control' name="picture" />
                            @if($errors->has('picture')) <span class="error">{{$errors->first('picture')}}@endif
                        </div>
                    </div>

                    <div class="col-md-12">

                        <div class="form-group content-area">
                            <label for="content">Contenu</label>
                            <textarea name="content" class='form-control' rows="25" style="width:100%;">{{old('content')}}</textarea>
                            @if($errors->has('content')) <span class="error">{{$errors->first('content')}}@endif
                        </div>

                        <div class="row">
                            <button class='btn btn-large btn-block btn-primary full-width' type='submit'>Ajouter l'article</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection