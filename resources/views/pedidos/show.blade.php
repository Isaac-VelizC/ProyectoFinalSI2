@extends('layouts.app')
@section('title', 'Developers | Detalle de Pedido')
@section('body-class', 'product-page')

<link rel="stylesheet" href="{{asset('clients/css/reactions.css')}}">


@section('content')

<div class="header header-filter">
</div>

<div class="main main-raised">
    <div class="container">        
        
        <div class="section text-center">
            <h2 class="title">Detalle del Pedido</h2>
            <div class="form-group row">
                <div class="col-md-1">
                        @if ($opinion === 'happy')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM164.1 325.5C158.3 318.8 148.2 318.1 141.5 323.9C134.8 329.7 134.1 339.8 139.9 346.5C162.1 372.1 200.9 400 255.1 400C311.1 400 349.8 372.1 372.1 346.5C377.9 339.8 377.2 329.7 370.5 323.9C363.8 318.1 353.7 318.8 347.9 325.5C329.9 346.2 299.4 368 255.1 368C212.6 368 182 346.2 164.1 325.5H164.1zM176.4 176C158.7 176 144.4 190.3 144.4 208C144.4 225.7 158.7 240 176.4 240C194 240 208.4 225.7 208.4 208C208.4 190.3 194 176 176.4 176zM336.4 240C354 240 368.4 225.7 368.4 208C368.4 190.3 354 176 336.4 176C318.7 176 304.4 190.3 304.4 208C304.4 225.7 318.7 240 336.4 240z"/></svg>
                        @elseif ($opinion === 'sad')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M352 493.4C322.4 505.4 289.9 512 256 512C222.1 512 189.6 505.4 160 493.4V288C160 279.2 152.8 272 144 272C135.2 272 128 279.2 128 288V477.8C51.48 433.5 0 350.8 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 350.8 460.5 433.5 384 477.8V288C384 279.2 376.8 272 368 272C359.2 272 352 279.2 352 288V493.4zM217.6 236.8C224.7 231.5 226.1 221.5 220.8 214.4C190.4 173.9 129.6 173.9 99.2 214.4C93.9 221.5 95.33 231.5 102.4 236.8C109.5 242.1 119.5 240.7 124.8 233.6C142.4 210.1 177.6 210.1 195.2 233.6C200.5 240.7 210.5 242.1 217.6 236.8zM316.8 233.6C334.4 210.1 369.6 210.1 387.2 233.6C392.5 240.7 402.5 242.1 409.6 236.8C416.7 231.5 418.1 221.5 412.8 214.4C382.4 173.9 321.6 173.9 291.2 214.4C285.9 221.5 287.3 231.5 294.4 236.8C301.5 242.1 311.5 240.7 316.8 233.6zM208 368C208 394.5 229.5 416 256 416C282.5 416 304 394.5 304 368V336C304 309.5 282.5 288 256 288C229.5 288 208 309.5 208 336V368z"/></svg>
                        @elseif ($opinion === 'angry')
                            <svg  viewBox="0 0 512 512"><path d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM339.9 373.3C323.8 355.4 295.7 336 256 336C216.3 336 188.2 355.4 172.1 373.3C166.2 379.9 166.7 389.1 173.3 395.9C179.9 401.8 189.1 401.3 195.9 394.7C207.6 381.7 227.5 368 255.1 368C284.5 368 304.4 381.7 316.1 394.7C322 401.3 332.1 401.8 338.7 395.9C345.3 389.1 345.8 379.9 339.9 373.3H339.9zM176.4 272C194 272 208.4 257.7 208.4 240C208.4 238.5 208.3 237 208.1 235.6L218.9 239.2C227.3 241.1 236.4 237.4 239.2 229.1C241.1 220.7 237.4 211.6 229.1 208.8L133.1 176.8C124.7 174 115.6 178.6 112.8 186.9C110 195.3 114.6 204.4 122.9 207.2L153.7 217.4C147.9 223.2 144.4 231.2 144.4 240C144.4 257.7 158.7 272 176.4 272zM358.9 217.2L389.1 207.2C397.4 204.4 401.1 195.3 399.2 186.9C396.4 178.6 387.3 174 378.9 176.8L282.9 208.8C274.6 211.6 270 220.7 272.8 229.1C275.6 237.4 284.7 241.1 293.1 239.2L304.7 235.3C304.5 236.8 304.4 238.4 304.4 240C304.4 257.7 318.7 272 336.4 272C354 272 368.4 257.7 368.4 240C368.4 231.1 364.7 223 358.9 217.2H358.9z"/></svg>
                        @else
                            <p>Aun no lo iso</p>
                        @endif
                </div>
                <div class="col-md-3">
                    <label class="form-control-label" for="nombre">Cliente</label>
                    <p>{{$venta->cliente->name}}</p>
                </div>	
                <div class="col-md-4">
                    <label class="form-control-label" for="documento">Fecha de Pedido</label>
                    <p>{{$venta->fecha_pedido}}</p>
                </div>			
                <div class="col-md-4">
                    <label class="form-control-label" for="num_compra">Fecha de Entrega</label>
                    <p>{{$venta->fecha_entrega}}</p>
                </div>
            </div>
                <hr>  
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Imagen</th>                              
                                <th class="text-center">Prenda</th>
                                <th class='text-center'>Cantidad</th>
                                <th class="text-center">Precio</th>
                                <th class="text-center">Subtotal</th>
                                <th class="text-center">Con Descuento</th>
                            </tr>
                        </thead>
                        <tbody>
                       @foreach ($detailPedido as $detail)
                        <tr>
                            <td>
                               <img src="{{ $detail->prenda->featured_image_url }}" height="50px">
                            </td>
                            <td class="text-center">{{ $detail->prenda->nombre }}</td>                            
                            <td class="text-center">{{ $detail->cantidad }} </td>
                            <td class="text-right">$ {{ $detail->prenda->precioUnit }}</td>
                            <td class="text-right">${{ number_format($detail->subTotal, 2)}} </td>
                            <td class="text-right">${{number_format($detail->conDescuento, 2)}} dto.</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                        
                    <p class='text-right'><strong>Importe a pagar: </strong>${{ $total }}</p>

                @if($venta->estado === 'Entregado')
                <a class="btn btn-info" href="#" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-comment"></i>&nbsp;Comentar
                </a>
                @endif
            <a class="btn btn-success" href="{{route("pedidos.ticket", ["id" => $venta->id])}}">
                <i class="fa fa-print"></i>&nbsp;Ticket
            </a>

            <br>
            <div class="form-group row">
                @foreach($comentario as $comentario)
                <div class="col-md-6">
                    <label class="form-control-label">Comentario</label>
                    <p>{{$comentario->comentario}}</p>
                </div>
                <div class="col-md-3">
                    <label class="form-control-label">Reacciones</label>
                    @include('modal.emojis')
                </div>
                <div class="col-md-3">
                    <label class="form-control-label">Borrar</label>
                        <form method="post" action="{{url('/reaction/'.$comentario->id.'/delete')}}">
                            {{ csrf_field() }}
                            <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('modal.reaction')


@include('includes.footer')
@endsection