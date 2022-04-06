@extends('layouts.app')
@section('title', 'Listado de Pedidos')
@section('body-class', 'product-page')

<link rel="stylesheet" href="{{ asset('/clients/css/tabPedido.css')}}">

@section('content')
<div class="header header-filter">
</div>

<div class="main main-raised">
    <div class="container">        

    <div class="section text-center">
            <div class="row">
                <div class="col-sm-10 text-center">
                    <h2 class="title">Listado de Pedidos</h2>
                </div>
                <div class="col-sm-2">
                    <a href ="{{ url('/admin/opinion') }}" class="btn btn-primary btn-just-icon" title="Nueva categoria">
                        <i class="fa fa-comment"></i>
                    </a>                   
                </div>
            </div>

            @if (Session::has('msg'))
                <div class="alert alert-info">
                  <strong> {{ Session::get('msg') }}</strong>
                </div>
            @endif

            <div class="container"> 
                <section id="fancyTabWidget" class="tabs t-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                            
                        <li class="tab fancyTab active">
                        <div class="arrow-down"><div class="arrow-down-inner"></div></div>	
                            <a id="tab0" href="#tabBody0" role="tab" aria-controls="tabBody0" aria-selected="true" data-toggle="tab" >Todos</a>
                            <div class="whiteBlock"></div>
                        </li>
                        <li class="tab fancyTab">
                        <div class="arrow-down"><div class="arrow-down-inner"></div></div>
                            <a id="tab1" href="#tabBody1" role="tab" aria-controls="tabBody1" aria-selected="true" data-toggle="tab" >Pendiente</a>
                            <div class="whiteBlock"></div>
                        </li>
                        <li class="tab fancyTab">
                        <div class="arrow-down"><div class="arrow-down-inner"></div></div>
                            <a id="tab2" href="#tabBody2" role="tab" aria-controls="tabBody2" aria-selected="true" data-toggle="tab" >Entregandose</a>
                            <div class="whiteBlock"></div>
                        </li>
                        <li class="tab fancyTab">
                        <div class="arrow-down"><div class="arrow-down-inner"></div></div>
                            <a id="tab3" href="#tabBody3" role="tab" aria-controls="tabBody3" aria-selected="true" data-toggle="tab" >Entregados</a>
                            <div class="whiteBlock"></div>
                        </li>
                                        
                    </ul>
                    <div id="myTabContent" class="tab-content fancyTabContent" aria-live="polite">
                        <div class="tab-pane fade active in" id="tabBody0" role="tabpanel" aria-labelledby="tab0" aria-hidden="false" tabindex="0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            
                                            <th class="col-md-2 text-center">Cliente</th>
                                            <th class="col-md-1 text-center">Telefono</th>
                                            <th class="col-md-1 text-center">Direccion</th>
                                            <th class="col-md-2 text-center">Fecha</th>
                                            <th class='col-md-2 text-center'>Total</th>
                                            <th class='col-md-2 text-center'>Estado</th>
                                            <th class="text-right">Acciones</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @foreach($ventas as $venta)
                                            <tr>
                                                <td class="text-center">{{ $venta->id }}</td>
                                                <td class="text-center">{{$venta->cliente->name}}</td>
                                                <td class="text-center">{{$venta->cliente->telefono}}</td>
                                                <td class="text-center">{{$venta->cliente->direccion}}</td>
                                                <td class="text-center">{{$venta->fecha_pedido}}</td>
                                                <td class="text-right">${{number_format($venta->total, 2)}}</td>

                                                    @if( $venta->estado === 'Entregado' )
                                                        <td class="text-center"><span class="action-button blue">{{ $venta->estado }}</span></td>
                                                    @elseif ( $venta->estado === 'Enviandose' )
                                                        <td class="text-center"><span class="action-button green">{{ $venta->estado }}</span></td>
                                                    @else
                                                        <td class="text-center"><span class="action-button red">{{ $venta->estado }}</span></td>
                                                    @endif
                                                        
                                                <td class="td-actions text-right">
                                                    <a href="{{ url('/admin/envios/'.$venta->id) }}" rel="tooltip" title="Detalle del Pedido" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-info"></i>
                                                    </a>

                                                    <a  href="{{route("pedidos.ticket", ["id"=>$venta->id])}}" rel="tooltip" title="Imprimir" class="btn btn-success btn-simple btn-xs">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                        <div class="tab-pane  fade" id="tabBody1" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="col-md-2 text-center">Cliente</th>
                                                <th class="col-md-1 text-center">Telefono</th>
                                                <th class="col-md-1 text-center">Direccion</th>
                                                <th class="col-md-2 text-center">Fecha</th>
                                                <th class='col-md-2 text-center'>Total</th>
                                                <th class='col-md-2 text-center'>Estado</th>
                                                <th class="col-md-2 text-right">Acciones</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            @foreach($pendientes as $venta)
                                                <tr>
                                                    <td class="text-center">{{ $venta->id }}</td>
                                                    <td class="text-center">{{$venta->cliente->name}}</td>
                                                    <td class="text-center">{{$venta->cliente->telefono}}</td>
                                                    <td class="text-center">{{$venta->cliente->direccion}}</td>
                                                    <td class="text-center">{{$venta->fecha_pedido}}</td>
                                                    <td class="text-right">${{number_format($venta->total, 2)}}</td>
                                                    <td class="text-center"><span class="action-button red">{{ $venta->estado }}</span></td>
                                                            
                                                    <td class="td-actions text-right">
                                                        <a href="/admin/envios/create" rel="tooltip" title="Enviar" class="btn btn-info btn-simple btn-xs">
                                                            <i class="fa fa-paper-plane"></i>
                                                        </a>
                                                        <a href="{{ url('/admin/envios/'.$venta->id) }}" rel="tooltip" title="Detalle del Pedido" class="btn btn-info btn-simple btn-xs">
                                                            <i class="fa fa-info"></i>
                                                        </a>
                                                        <a  href="{{route("pedidos.ticket", ["id"=>$venta->id])}}" rel="tooltip" title="Imprimir" class="btn btn-success btn-simple btn-xs">
                                                            <i class="fa fa-print"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                        </div>
                        <div class="tab-pane  fade" id="tabBody2" role="tabpanel" aria-labelledby="tab2" aria-hidden="true" tabindex="0">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="col-md-2 text-center">Cliente</th>
                                                <th class="col-md-1 text-center">Telefono</th>
                                                <th class="col-md-1 text-center">Direccion</th>
                                                <th class="col-md-2 text-center">Fecha</th>
                                                <th class='col-md-2 text-center'>Total</th>
                                                <th class='col-md-2 text-center'>Estado</th>
                                                <th class="text-right">Acciones</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            @foreach($enEnvio as $venta)
                                                <tr>
                                                    
                                                    <td class="text-center">{{ $venta->id }}</td>
                                                    <td class="text-center">{{$venta->cliente->name}}</td>
                                                    <td class="text-center">{{$venta->cliente->telefono}}</td>
                                                    <td class="text-center">{{$venta->cliente->direccion}}</td>
                                                    <td class="text-center">{{$venta->fecha_pedido}}</td>
                                                    <td class="text-right">${{number_format($venta->total, 2)}}</td>
                                                    <td class="text-center"><span class="action-button green">{{ $venta->estado }}</span></td>
                                                            
                                                    <td class="td-actions text-right">
                                                        <a href="{{ url('/admin/envios/'.$venta->id) }}" rel="tooltip" title="Detalle del Pedido" class="btn btn-info btn-simple btn-xs">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                        <a  href="{{route("pedidos.ticket", ["id"=>$venta->id])}}" rel="tooltip" title="Imprimir" class="btn btn-success btn-simple btn-xs">
                                                            <i class="fa fa-print"></i>
                                                        </a>
                                                    </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                        </div>
                        <div class="tab-pane  fade" id="tabBody3" role="tabpanel" aria-labelledby="tab3" aria-hidden="true" tabindex="0">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="col-md-1 text-center">Cliente</th>
                                                <th class="col-md-1 text-center">Telefono</th>
                                                <th class="col-md-1 text-center">Direccion</th>
                                                <th class="col-md-2 text-center">Fecha Pedido</th>
                                                <th class="col-md-2 text-center">Fecha Entrega</th>
                                                <th class='col-md-1 text-center'>Total</th>
                                                <th class='col-md-1 text-center'>Estado</th>
                                                <th class="col-md-2 text-right">Acciones</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            @foreach($entregados as $venta)
                                                <tr>
                                                    <td class="text-center">{{ $venta->id }}</td>
                                                    <td class="text-center">{{$venta->cliente->name}}</td>
                                                    <td class="text-center">{{$venta->cliente->telefono}}</td>
                                                    <td class="text-center">{{$venta->cliente->direccion}}</td>
                                                    <td class="text-center">{{$venta->fecha_pedido}}</td>
                                                    @if ($venta->fecha_entrega === null)
                                                    <td class="text-center">Aun no entregado</td>
                                                    @else
                                                    <td class="text-center">{{$venta->fecha_entrega}}</td>
                                                    @endif
                                                    <td class="text-right">${{number_format($venta->total, 2)}}</td>
                                                    <td class="text-center"><span class="action-button blue">{{ $venta->estado }}</span></td>
                                                
                                                    <td class="td-actions text-right">
                                                        <a href="{{ url('/admin/envios/'.$venta->id) }}" rel="tooltip" title="Detalle del Pedido" class="btn btn-info btn-simple btn-xs">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                        <a  href="{{route("pedidos.ticket", ["id"=>$venta->id])}}" rel="tooltip" title="Imprimir" class="btn btn-success btn-simple btn-xs">
                                                            <i class="fa fa-print"></i>
                                                        </a>
                                                    </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>


@include('includes.footer')
@endsection

<script>
    
$(document).ready(function() {
  

	  
  var numItems = $('li.fancyTab').length;
      
  
            if (numItems == 12){
                  $("li.fancyTab").width('8.3%');
              }
            if (numItems == 11){
                  $("li.fancyTab").width('9%');
              }
            if (numItems == 10){
                  $("li.fancyTab").width('10%');
              }
            if (numItems == 9){
                  $("li.fancyTab").width('11.1%');
              }
            if (numItems == 8){
                  $("li.fancyTab").width('12.5%');
              }
            if (numItems == 7){
                  $("li.fancyTab").width('14.2%');
              }
            if (numItems == 6){
                  $("li.fancyTab").width('16.666666666666667%');
              }
            if (numItems == 5){
                  $("li.fancyTab").width('20%');
              }
            if (numItems == 4){
                  $("li.fancyTab").width('25%');
              }
            if (numItems == 3){
                  $("li.fancyTab").width('33.3%');
              }
            if (numItems == 2){
                  $("li.fancyTab").width('50%');
              }
        
   

  
      });

$(window).load(function() {

$('.fancyTabs').each(function() {

  var highestBox = 0;
  $('.fancyTab a', this).each(function() {

    if ($(this).height() > highestBox)
      highestBox = $(this).height();
  });

  $('.fancyTab a', this).height(highestBox);

});
});
</script>