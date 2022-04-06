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
                    <form  class="form-inline" method="get" action="{{ url('/admin/descuentos') }}">
                        <input id="search"type="text" class="form-control" placeholder="¿Buscar por nombre?" name="query">
                        <button class="btn btn-primary btn-fab btn-fab-mini btn-round">
                            <i class="material-icons">search</i>
                        </button>
                    </form>
                </div>
                <div class="col-sm-8 text-center">
                   <h2 class="title">Prendas en Descuento</h2>
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
                                <th class="col-md-2 text-center">Prenda</th>
                                <th class='col-md-3 text-center'>Precio Unitario</th> 
                                <th class='col-md-2 text-center'>Descuento</th> 
                                <th class='col-md-2 text-center'>Precio con Descuento</th>                  
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($descu as $descuento)
                            <tr>
                                <td>{{ $descuento->nombre }}</td>
                                <td>{{ $descuento->precioUnit }}</td>
                                <td>{{ $descuento->descuento }} %</td>
                                <td>{{ $descuento->precioUnit - $descuento->precioUnit * $descuento->descuento /100}}</td>
                                <td class="td-actions text-right">
                                
                                <form method="post" action="{{ url('/admin/descuentos/'.$descuento->id ) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                    
                                        <a  href="{{ url('/admin/descuentos/'.$descuento->id.'/edit') }}" rel="tooltip" title="Cambiar" class="btn btn-success btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>             

                                        <button type="submit" rel="tooltip" title="Quitar Descuento" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')
@endsection

