@extends('layouts.app')
@section('title', 'Developers | Pedidos')
@section('body-class', 'product-page')

<link rel="stylesheet" href="{{asset('clients/css/cardPrendas.css')}}">

@section('content')

<div class="header header-filter">
</div>

<div class="main main-raised">
    <div class="container">        

        <div class="section text-center">
            <h2 class="title">Pedidos Realizados</h2>
            
                @if (session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                @endif
                    
                <div class="row">
                    <div class="col-sm-8">
                        <ul class="nav nav-pills nav-pills-primary" role="tablist">
                            <li class="active">                                   
                                <a href="#" role="tab" data-toggle="tab">
                                    <i class="material-icons">dashboard</i>
                                        Carrito de compras
                                </a>
                            </li>
                            
                            <li>
                                <a href="{{route('pedidos.index')}}" role="tab">
                                    <i class="material-icons">list</i>
                                        Pedidos realizados
                                </a>
                            </li>
                        </ul>
                    </div>
                        <div class="col-sm-4">                                    
                            <a href="{{ url('/#cats') }}" class="btn btn-default btn-sm">
                                <i class="material-icons">find_in_page</i>
                                    Seguir agregando + productos
                            </a>
                        </div>
                    </div>
                    <hr>

    <div class="header header-filter"></div>

            <div class="team">
                <div class="row">  

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-3 text-center">Fecha de pedido</th>
                                <th class="col-md-3 text-center">Fecha de Entrega</th>
                                <th class='col-md-2 text-center'>Total</th>
                                <th class='col-md-2 text-center'>Estado</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($ventas as $venta)
                                <tr>
                                    <td class="text-center">{{$venta->id }}</td>
                                    <td class="text-center">{{$venta->fecha_pedido}}</td>
                                    @if ($venta->fecha_entrega === null)
                                    <td class="text-center">Aun no entregado</td>
                                    @else
                                    <td class="text-center">{{$venta->fecha_entrega}}</td>
                                    @endif
                                    <td class="text-center">${{number_format($venta->total, 2)}}</td>

                                    @if( $venta->estado === 'Entregado' )
                                        <td class="text-center"><span class="action-button blue">{{ $venta->estado }}</span></td>
                                    @elseif ( $venta->estado === 'Enviandose' )
                                        <td class="text-center"><span class="action-button green">{{ $venta->estado }}</span></td>
                                    @else
                                        <td class="text-center"><span class="action-button red">{{ $venta->estado }}</span></td>
                                    @endif

                                    
                                    <td class="td-actions text-right">
                                        <form method="post" action="{{url('/pedidos/'.$venta->id.'/delete')}}">
                                        {{ csrf_field() }}

                                            <a href="{{route("pedidos.show", $venta)}}" rel="tooltip" title="Detalle del Pedido" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-info"></i>
                                            </a>

                                            <a  href="{{route("pedidos.ticket", ["id"=>$venta->id])}}" rel="tooltip" title="Imprimir" class="btn btn-success btn-simple btn-xs">
                                                <i class="fa fa-print"></i>
                                            </a>                                   
                                        
                                            <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-trash"></i>
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