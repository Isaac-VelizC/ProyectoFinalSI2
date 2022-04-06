@extends('layouts.app')
@section('title', 'Listado de Pedidos a enviar')
@section('body-class', 'product-page')


@section('content')
<div class="header header-filter">
</div>

<div class="main main-raised">
    <div class="container">        

    <div class="section text-center">
            <div class="row">
                
            <div class="col-sm-3">
                    <form  class="form-inline" method="get" action="{{ url('/admin/clientes') }}">
                        <input id="search"type="text" class="form-control" placeholder="¿Buscar por nombre?" name="query">
                        <button class="btn btn-primary btn-fab btn-fab-mini btn-round">
                            <i class="material-icons">search</i>
                        </button>
                    </form>
                </div>
                <div class="col-sm-7 text-center">
                    <h2 class="title">Listado de Clientes</h2>
                </div>
                <div class="col-sm-2">
                    <a href ="#" class="btn btn-primary btn-just-icon" title="Nuevo cliente">
                        <i class="material-icons">note_add</i>
                    </a>                   
                </div>
            </div>

            @if (Session::has('msg'))
                <div class="alert alert-info">
                  <strong> {{ Session::get('msg') }}</strong>
                </div>
           
            @endif

            <div class="team">
                <div class="row">  

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-md-2 text-center">nombre</th>
                                <th class='col-md-3 text-center'>G-mail</th> 
                                <th class='col-md-2 text-center'>Telefono</th>
                                <th class='col-md-2 text-center'>Direccion</th>                        
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->name }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->telefono }}</td>
                                <td>{{ $cliente->direccion }}</td>
                                <td class="td-actions text-right">
                                    <form method="post" action="{{ url('/admin/clientes/'.$cliente->id ) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}                         
                                        <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $clientes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')
@endsection

