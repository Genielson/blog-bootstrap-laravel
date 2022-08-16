
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    <a class="btn btn-success" href="{{route('admin/new-category')}}"> Nova categoria </a>

    @if(isset($categorias) && count($categorias) <= 0)
         <h1> Não existe nenhuma categorias cadastradas</h1>
    @else

        @foreach($categorias as $categoria)
            <tr class="table">
                <td> {{$categoria['title']}}</td>
                <td> <a href="" class="btn btn-success"> Editar </a></td>
                <td> <a href="" class="btn btn-danger"> Deletar </a></td>
            </tr>
        @endforeach

   @endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


