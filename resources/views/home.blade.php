@extends('layouts.app')
@section('title', 'Developers | Dashboard')
@section('body-class', 'product-page')

@section('content')

<div class="header header-filter">
</div>

<div class="main main-raised">
    <div class="container">        

        <div class="section text-center">
            <h2 class="title">Carrito</h2>
            
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
                        
                       <p>Tu carrito de compras tiene {{ auth()->user()->cart->detalles->count() }} productos</p>
                            
                         <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nombre</th>                               
                                <th class="text-right">Precio</th>
                                <th class='text-center'>Cantidad</th>
                                <th class="text-center">Subtotal</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                       @foreach (auth()->user()->cart->detalles as $detail)
                        <tr>
                            <td class="text-center">
                               <img src="{{ $detail->prenda->featured_image_url }}" height="50px">
                            </td>
                            <td>{{ $detail->prenda->nombre }}</td>
                            <td class="text-right">$ {{ $detail->prenda->precioUnit }}</td>
                            <td>{{$detail->cantidad}}</td>
                            @if ($detail->prenda->descuento != 0)
                            <td>${{ $detail->cantidad * ($detail->prenda->precioUnit - $detail->prenda->precioUnit * $detail->prenda->descuento /100) }} dto.</td>
                            @else
                            <td>${{ $detail->cantidad * $detail->prenda->precioUnit }} </td>
                            @endif
                            
                            <td class="td-actions text-right">
                              
                                <form method="post" action="{{ url('/cart') }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="hidden" name="cart_detail_id" value="{{ $detail->id }}">
                                    
                                    <a href="{{ url('products/'. $detail->prenda->id) }}" rel="tooltip" title="Ver Producto" class="btn btn-info btn-simple btn-xs">
                                        <i class="fa fa-info"></i>
                                    </a>

                                    <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    
                    <p class='text-right'><strong>Importe a pagar: </strong>{{ auth()->user()->cart->total }}</p>

                    <form method="post" action="{{ url('/order') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="total" value="{{ auth()->user()->cart->total }}">
                        <button class="btn btn-primary btn-around">
                            <i class="material-icons">done</i> Realizar pedido
                        </button>
                     </form>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
