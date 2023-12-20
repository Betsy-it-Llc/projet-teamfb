@extends('layouts.navadmin')
 
@section('content')
    <div class="row" style="margin-top: 5rem;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gestions des posts</h2>
                <br>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('posts.create') }}"> Create New Post</a>
            </div>
            <br>
        </div>
    </div>
   <br><br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="table">
        <table class="table">
            <thead class="thead" style="background:#bfbfbf">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Details</th>
                <th scope="col">Date</th>
                <th scope="col">Author</th>
                <th width="150px"></th>
            </tr>
            </thead>
            @foreach ($data as $key => $value)
            <tr>
                <th  scope="row">{{ ++$i }}</th>
                <td>{{ $value->title }}</td>
                <td>{{ \Str::limit($value->description, 30) }}</td>
                <td>{{ $value->date }}</td>
                <td>{{ $value->author }}</td>
                <td>
                    <form action="{{ route('posts.destroy',$value->id) }}" method="POST">  
                    <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-info" href="{{ route('posts.show',$value->id) }}"><i style="color : black" class="fas fa-info"></i></a>    
                        <a style="background-color : #fafafa ; border : #fafafa" class="btn btn-primary" href="{{ route('posts.edit',$value->id) }}"><i style="color : black"  class="fas fa-edit"></i></a>   
                        @csrf
                        @method('DELETE')      
                        <button  style="background-color : #fafafa ; border : #fafafa"  type="submit" class="btn btn-danger"><i style="color : black"   class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>  
    </div>
        {!! $data->links() !!}      
    @endsection