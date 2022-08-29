
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    <a class="btn btn-success mb-5" href="{{route('posts.create')}}"> Novo Post </a>

    @if(isset($posts) && count($posts) <= 0)
        <h1> Não existe nenhum post cadastrado </h1>
    @else

        <table class="table table-striped mb-5">

            @foreach($posts as $post)
                <tr>
                    <td> {{$post['title']}}</td>
                    <td> <a href="{{route('posts.edit',['post'=> $post->id])}}" class="btn btn-success"> Editar </a></td>
                    <td> <form method="post" action="{{route('posts.destroy',['post' => $post->id])}}" >
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">
                                Deletar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </table>

    @endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


