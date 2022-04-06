@extends('layouts.app')
@section('title', 'Listado de prendas')
@section('body-class', 'product-page')

<!--link rel="stylesheet" href="{{asset('clients/css/search.scss')}}"-->

@section('content')
<div class="header header-filter">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section text-center">
            <div class="row">
                <div class="col-sm-3">
                    <form  class="form-inline" method="get" action="{{ url('/admin/products') }}">
                        <input id="search"type="text" class="form-control" placeholder="¿Buscar por nombre?" name="query">
                        <button class="btn btn-primary btn-fab btn-fab-mini btn-round">
                            <i class="material-icons">search</i>
                        </button>
                    </form>
                </div>
                <div class="col-sm-7 text-center">
                   <h2 class="title">Listado de Prendas</h2>
                </div>
                <div class="col-sm-2">
                    <a href ="{{ url('/admin/products/create') }}" class="btn btn-primary btn-just-icon" title="Nuevo producto">
                        <i class="material-icons">note_add</i>
                    </a>                   
                </div>
            </div>

             @if (Session::has('msg'))
            <div class="alert alert-info">
              <strong> {{ Session::get('msg') }}</strong>
            </div>
       
            @endif
            
            <div class="row">
                <div class="col-sm-3">
                    <a href="{{ url('/admin/descuentos') }}"> <i class="fa fa-percent"></i>Prendas en descuento</a>
                </div>
            </div>

            <div class="team">
                <div class="row">    
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-1 text-center">Nombre</th>
                                <th class='col-md-3 text-center'>Descripción</th>
                                <th class="text-center">Marca</th>
                                <th class="text-center">Talla</th>
                                <th class="text-center">Color</th>
                                <th class="text-center">Stock</th>
                                <th class="text-right">Precio</th>
                                <th class="text-right">Descuento</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($prendas as $product)
                        <tr>
                            <td class="text-center">{{ $product->id }}</td>
                            <td>{{ $product->nombre }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->marcas->nombre  }}</td>
                            <td>{{ $product->tallas->talla }}</td>
                            <td>{{ $product->colors->color  }}</td>
                            <td>{{ $product->stock  }}</td>
                            <td class="text-right">&euro; {{ $product->precioUnit }}</td>
                            <td class="text-right">{{ $product->descuento }}%</td>
                            <td class="td-actions text-right">
                              <form method="post" action="{{ url('/admin/products/'.$product->id.'/delete') }}">
                              {{ csrf_field() }}

                                <a href="{{ url('/products/'.$product->id) }}" rel="tooltip" title="Ver Producto" class="btn btn-info btn-simple btn-xs">
                                    <i class="fa fa-info"></i>
                                </a>

                                <a  href="{{ url('/admin/products/'.$product->id.'/edit') }}" rel="tooltip" title="Editar Producto" class="btn btn-success btn-simple btn-xs">
                                    <i class="fa fa-edit"></i>
                                </a>                                   
                                
                                 <a href="{{ url('/admin/products/'.$product->id.'/images') }}" rel="tooltip" title="Imágenes del producto" class="btn btn-warning btn-simple btn-xs">
                                    <i class="fa fa-image"></i>
                                </a>

                                <a  href="{{ url('/admin/descuentos/'.$product->id.'/edit') }}" rel="tooltip" title="Descuento" class="btn btn-success btn-simple btn-xs">
                                    <i class="fa fa-percent"></i>
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
                    {{ $prendas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')
@endsection

