@extends('layouts.app')
@section('title', 'Listado de prendas')
@section('body-class', 'product-page')

<link rel="stylesheet" href="{{ asset('/clients/css/tabPedido.css')}}">

@section('content')
<div class="header header-filter">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section text-center">
            <div class="row">
                <div class="col-sm-3">
                    <form  class="form-inline" method="get" action="{{ url('/admin/compra') }}">
                        <input id="search" type="date" class="form-control" placeholder="¿Buscar por fecha?" value="{{$buscarTexto}}" name="buscarTexto">
                        <button class="btn btn-primary btn-fab btn-fab-mini btn-round">
                            <i class="material-icons">search</i>
                        </button>
                    </form>
                </div>
                <div class="col-sm-7 text-center">
                   <h2 class="title">Listado de Compras</h2>
                </div>
                <div class="col-sm-2">
                    <a href ="{{ url('/admin/compra/create') }}" class="btn btn-primary btn-just-icon" title="Nuevo producto">
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
                                <th class="col-md-1 text-center">Ver Detalle</th>
                                <th class='col-md-3 text-center'>Fecha de Compra</th>
                                <th class="text-center">Numero de Compra</th>
                                <th class="text-center">Comprador</th>
                                <th class="text-center">Total (USD)</th>
                                <th class="text-center">Estado</th>
                                <th class="text-right">Cambiar Estado</th>
                                <!--th class="text-right">Acciones</th-->
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($compras as $compra)
                        <tr>
                            <td>
                                <a href="{{ url('admin/compra/'.$compra->id) }}" rel="tooltip" title="Detalle" class="btn btn-warning btn-simple btn-xs">
                                    <i class="fa fa-eye fa-2x"></i>
                                </a>
                            </td>
                            <td class="text-center">{{ $compra->fecha_compra }}</td>
                            <td class="text-center">{{ $compra->num_compra }}</td>
                            <td>{{ $compra->user->name  }}</td>
                            <td>${{ number_format($compra->total, 2) }}</td>
                            <td class="text-center">
                                @if($compra->estado == "Registrado")
                                <button type="button" class="action-button blue">
                                    <i class="fa fa-check"></i> Registrado
                                </button>
                                @else
                                <button type="button" class="action-button red">
                                    <i class="fa fa-check fa-2x"></i>Anulado
                                </button>
                                @endif
                            </td>
                            
                            <td class="td-actions text-right">
                                @if($compra->estado == "Registrado")
                                <form method="post" action="{{ url('/admin/compra/'.$compra->id.'/delete') }}">
                                {{ csrf_field() }}
                                    <button type="submit" rel="tooltip" title="Anular Compra" class="btn btn-danger btn-simple btn-xs">
                                        <i class="fa fa-times fa-2x"></i>
                                    </button>
                                </form>
                                @else
                                <button type="button" rel="tooltip" title="Anulado" class="btn btn-danger btn-simple btn-xs">
                                    <i class="fa fa-lock fa-2x"></i>Anulado
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $compras->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')
@endsection

