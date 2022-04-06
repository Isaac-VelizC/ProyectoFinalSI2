@extends('layouts.app')
@section('title', 'Bienvenido a App Shop')
@section('body-class', 'product-page')

<style>
.card-image {
	display: block;
	background: #fff center center no-repeat;
	background-size: cover;
}

.card-image > img {
	opacity: 0; /* visually hide the img element */
}

.card {
	max-width: 40rem;
}

</style>

@section('content')

<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
</div>

<div class="main main-raised">
    <div class="container">        

        <div class="section text-center">
            <h2 class="title">Añadir Descuento</h2>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="row">
                    <div class="col-sm-6">
                            <div class="card">
                            <h2>{{$descuento->nombre}}</h2>
                                <a class="card-image" target="_blank" style="background-image: url( {{$descuento->featured_image_url}} );" data-image-full="{{ $descuento->featured_image_url }}">
                                    <img src="{{ $descuento->featured_image_url }}" alt="Jane Doe" />
                                </a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                    <form method="post" action="{{ url('/admin/descuentos/'.$descuento->id.'/edit') }}">
                        {{ csrf_field() }}

                        <div class="input-group">
                            <i class="material-icons"></i></span>
                            <input type="number" step="0.01" placeholder="Descuento" name="descuento" class="form-control" value="{{ old('descuento', $descuento->descuento )}}">
                        </div>
                        <br><br>

                        <button class="btn btn-primary">Guardar</button>
                        <a href="{{ url('/admin/products') }}" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@include('includes.footer')
@endsection

