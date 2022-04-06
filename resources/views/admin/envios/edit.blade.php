@extends('layouts.app')
@section('title', 'Bienvenido a App Shop')
@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
</div>

<div class="main main-raised">
    <div class="container">        

        <div class="section text-center">
            <h2 class="title">Actualizar Envio</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ url('/admin/envios/'.$enviarEdit->id.'/edit') }}">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                            <i class="material-icons"></i></span>
                            <input type="text" placeholder="Metodo de envio" name="metodo" class="form-control" value="{{ old('metodo', $enviarEdit->metodo) }}">
                        </div>
                    </div>

                     <div class="col-sm-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                            <i class="material-icons"></i></span>
                            <input type="number" step="0.01" placeholder="Costo del envio" name="costo_envio" class="form-control" value="{{ old('costo_envio', $enviarEdit->costo_envio )}}">
                        </div>                        
                    </div>
                </div>

                 <div class="row">
                    <div class="col-sm-6">
                        <select class="form-control" name="pedido_id">
                            <option value="0">Codigo del Pedido</option>
                            @foreach ($pedidosPendientes as $pedido)
                            <option value="{{ $pedido->id }}" @if($pedido->id == old('pedido_id', $enviarEdit->pedido_id)) selected @endif>{{ $pedido->id }}</option>
                            @endforeach
                        </select>                                                                                
                    </div>
                </div>
                
                <button class="btn btn-primary">Guardar cambios</button>
                <a href="{{ url('/admin/envios') }}" class="btn btn-default">Cancelar</a>

            </form>
        </div>       
    </div>
</div>

@include('includes.footer')
@endsection

