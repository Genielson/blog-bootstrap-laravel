
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">

                        <div class="card-header">
                            <h3 class="card-title">Editar Post </h3>
                        </div>

                        <form method="post" action="{{route('posts.update',['post'=>$post['id']])}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group m-2">
                                <label for="title">Titulo </label>
                                <input type="text" class="form-control" name="title" value="{{$post['title']}}"  placeholder="Meu titulo">
                            </div>

                            <div class="form-group m-2">
                                <label for="slug">Slug </label>
                                <input type="text" class="form-control" name="slug"  placeholder="/meu-post">
                            </div>


                            <div class="form-group m-2">
                                <label for="slug">Categoria </label>
                                @foreach($categorias as $categoria)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" {{(in_array($categoria['id'],$categoriasDoPost)) ? "checked" : "" }}  name="categoria[]"  value="{{$categoria['id']}}" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck"  >
                                            {{$categoria['title']}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="description"> {{$post['description']}}</textarea>
                            </div>
                            <button class="btn btn-success" type="submit"> Salvar </button>
                        </form>

                    </div>

                </div>


                <div class="col-md-6">
                </div>

            </div>

        </div>
    </section>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>

    <script type="text/javascript">

    </script>
@stop


