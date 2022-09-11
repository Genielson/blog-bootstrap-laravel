
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
                            <h3 class="card-title">Atualizar Aparencia </h3>
                        </div>

                        @if(Session::has('message'))
                            <p class="alert text-center alert-info"> {{Session::get('message')}} </p>
                        @endif

                        <form method="post" action="{{route('site.update',['site'=>$id])}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="card-body">

                                <div class="form-group m-2">
                                    <label for="slug">Imagem Logo </label>
                                    <input required type="file" class="form-control" name="image" >
                                </div>


                                <div class="form-group m-2">
                                    <label for="slug">Titulo do site </label>
                                    <input required type="text" class="form-control" name="title" >
                                </div>


                                <div class="form-group m-2">
                                    <label for="header">Cor do Header </label>
                                    <input required type="color" class="form-control" name="header" >
                                </div>


                                <div class="form-group m-2">
                                    <label for="footer">Cor do Footer </label>
                                    <input required type="color" class="form-control" name="footer" >
                                </div>

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


