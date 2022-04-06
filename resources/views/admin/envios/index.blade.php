@extends('layouts.app')
@section('title', 'Listado de Pedidos a enviar')
@section('body-class', 'product-page')

<style>
.action-button
{
	padding: 0px 20px;
    margin: 0px 5px 5px 0px;
    float: left;
	border-radius: 20px;
	font-size: 12px;
	color: #FFF;
}

.blue
{
	background-color: #3498DB;
	border-bottom: 3px solid #2980B9;
	text-shadow: 0px -2px #2980B9;
}

.red
{
	background-color: #E74C3C;
	border-bottom: 3px solid #BD3E31;
	text-shadow: 0px -2px #BD3E31;
}

.green
{
	background-color: #82BF56;
	border-bottom: 3px solid #669644;
	text-shadow: 0px -2px #669644;
}

</style>


@section('content')
<div class="header header-filter">
</div>

<div class="main main-raised">
    <div class="container">        

    <div class="section text-center">
            <div class="row">
                <div class="col-sm-9 text-center">
                    <h2 class="title">Listado de Pedidos en Envio</h2>
                </div>
                <div class="col-sm-3">
                    <a href ="/admin/envios/create" class="btn btn-primary btn-just-icon" title="Nueva envio">
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
                                <th class="col-md-1 text-center">Codigo</th>
                                <th class='col-md-3 text-center'>Metodo de envio</th> 
                                <th class='col-md-2 text-center'>Fecha de envio</th>
                                <th class='col-md-2 text-center'>Costo de envio</th> 
                                <th class='col-md-2 text-center'>Estado de entrega</th>                           
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($envios as $envio)
                            <tr>
                                <td class="text-center">
                                    <a href="{{ url('/admin/envios/'.$envio->pedido->id) }}" rel="tooltip" title="Ver detalle">{{ $envio->pedido->id }}</a>
                                </td>
                                <td>{{ $envio->metodo }}</td>
                                <td>{{ $envio->fecha_envio }}</td>
                                <td class="text-center">{{ $envio->costo_envio }}</td>
                                @if( $envio->pedido->estado === 'Entregado' )
                                    <td><span class="action-button blue">{{ $envio->pedido->estado }}</span></td>
                                @else
                                    <td><span class="action-button green">{{ $envio->pedido->estado }}</span></td>
                                @endif
                                <td class="td-actions text-right">
                                
                                    <form method="post" action="{{ url('/admin/envios/'.$envio->id ) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                        <a  href="{{ url('/admin/envios/'.$envio->id.'/edit') }}" rel="tooltip" title="Editar Envio" class="btn btn-primary btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>                                   
                                        <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                                @if( $envio->pedido->estado === 'Entregado' )
                                <td class="td-actions text-right">
                                    <form method="post" action="">
                                    {{ csrf_field() }}
                                        <button type="submit" rel="tooltip" title="Cancelar" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-ban"></i>
                                        </button>
                                    </form>
                                </td>
                                @else
                                <td class="td-actions text-right">
                                    <form method="post" action="{{ url('/admin/envios/'.$envio->pedido->id.'/actEstPed') }}">
                                    {{ csrf_field() }}
                                        <button type="submit" rel="tooltip" title="Entregar" class="btn btn-success btn-simple btn-xs">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $envios->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@include('includes.footer')
@endsection

