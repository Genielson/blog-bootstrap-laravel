
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
                            <h3 class="card-title">Novo Post </h3>
                        </div>

                        <form method="post" action="{{route('posts.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group m-2">
                                <label for="title">Titulo </label>
                                <input type="text" class="form-control" name="title"  placeholder="Meu titulo">
                            </div>

                            <span style="color: red">
                                    {{
                                          $errors->has('title') ? $errors->first('title')
                                          : ''
                                    }}
                                    </span>

                            <div class="form-group m-2">
                                <label for="slug">Slug </label>
                                <input type="text" class="form-control" name="slug"  placeholder="/meu-post">
                            </div>

                            <span style="color: red">
                                    {{
                                          $errors->has('slug') ? $errors->first('slug')
                                          : ''
                                    }}
                                    </span>

                            <div class="form-check m-2 mt-5">
                                <input class="form-check-input" type="checkbox" name="emphasis" value="emphasis"  >
                                <label class="form-check-label" for="gridCheck">
                                    Destaque do blog
                                </label>
                            </div>

                            <div class="form-group m-2">
                                <label for="slug">Imagem destaque </label>
                                <input required type="file" class="form-control" name="image" >
                            </div>

                            <span style="color: red">
                                    {{
                                          $errors->has('image') ? $errors->first('image')
                                          : ''
                                    }}
                                    </span>

                            <div class="form-group m-2">
                                <label for="slug">Categoria </label>
                                    @foreach($categorias as $categoria)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="categoria[]"  value="{{$categoria['id']}}" id="gridCheck">
                                            <label class="form-check-label" for="gridCheck">
                                                {{$categoria['title']}}
                                            </label>
                                        </div>
                                    @endforeach
                            </div>


                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="description"></textarea>
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


