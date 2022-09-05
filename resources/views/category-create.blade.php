
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
                            <h3 class="card-title">Nova categoria </h3>
                        </div>

                        <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">

                                    <label>Nome </label>
                                    <input type="text" name="category" class="form-control" placeholder="Nova categoria">
                                    <span style="color: red">
                                    {{
                                          $errors->has('category') ? $errors->first('category')
                                          : ''
                                    }}
                                    </span>
                                </div>

                                <div class="form-group m-2">
                                    <label for="slug">Imagem destaque </label>
                                    <input required type="file" class="form-control" name="image" >
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
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
@stop


