@extends('layouts.navadmin')
  
@section('content')
    <div class="container" style="border : 1px black solid ; width : 600px">
    
    <div class="row center">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <br><br>
                <h2 style="text-align : center"> Show Product</h2>
                <br>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" style="text-align : center">
            <div class="form-group">
                <strong>Title:</strong>
                {{ $post->title }}
            </div>
            
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" style="text-align : center">
                <strong>Description:</strong>
                <p style="color : black; word-wrap: break-word;">{{ $post->description }}</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" style="text-align : center">
                <strong>Date:</strong>
                {{ $post->date }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" style="text-align : center">
            <div class="form-group">
                <strong>Author:</strong>
                {{ $post->author }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" style="text-align : center">
            <div class="form-group">
            <a style="margin : 20px" class="btn btn-primary" href="{{ route('posts.index') }}"> Back</a>
            </div>
        </div>
           
    </div>
    </div>
@endsection