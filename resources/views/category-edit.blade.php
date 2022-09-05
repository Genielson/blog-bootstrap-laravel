
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
                            <h3 class="card-title">Editar categoria </h3>
                        </div>

                        <form method="post" action="{{route('category.update',['category'=>$categoria->id])}}">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">

                                    <label>Nome </label>
                                    <input type="text" name="category" value="{{$categoria->title ?? old('category')}}" class="form-control">
                                    <span style="color: red">
                                    {{
                                          $errors->has('category') ? $errors->first('category')
                                          : ''
                                    }}
                                    </span>
                                </div>
                            </div>

                            @if($categoria->url_image != NULL)
                                <div class="form-group m-2">
                                    <img width="60%" height="60%" src="{{asset('public/image/'.$categoria->url_image)}}" alt="">
                                </div>
                            @else
                                <div class="form-group m-2">
                                    <h3 class="text-center"> Não foi inserida nenhuma imagem de destaque. </h3>
                                </div>
                            @endif

                            <div class="form-group m-2">
                                <label for="slug">Imagem destaque </label>
                                <input required type="file"  class="form-control" name="image" >
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Salvar</button>
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


