@extends('layouts.app')

@section('title', 'Modart Boutique')

@section('body-class', 'landing-page')

@section('styles')
<style type="text/css">    
            .team .row .col-md-4 
            {
                margin-bottom: 3em;
            }
            .row {
           display: flex;
          display: -webkit-flex;
          flex-wrap: wrap;
        }
</style>

<link rel="stylesheet" type="text/css" href="css/typeahead.css">

@endsection

@section('content')
  
<div class="header header-filter">
 

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="title">Bienvenidos a "ModArt Boutique"</h1>
                <h4>Moda a tu personalidad.</h4>
                <br />
                <a href="https://www.youtube.com/watch?v=MrAx-ie8yQ0" class="btn btn-danger btn-raised btn-lg">
                    <i class="fa fa-play"></i> DESCUBRENOS!
                </a>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section text-center section-landing">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="title">¿Por qué comprar en Modart Boutique?</h2>
                    <h5 class="description">Nuestra variedad de productos te permiten una elección perfecta, además de que manejamos los precios más accesibles del mercado. !Checa y Compara¡</h5>
                </div>
            </div>
        </div>

        <div class="section text-center">
            <h2 class="title" id="cats">Visita nuestras categorías</h2>

            <form  class="form-inline" method="get" action="{{ url('/search') }}">
                <input id="search"type="text" class="form-control" placeholder="¿Qué productos buscas?" name="query">
                <button class="btn btn-primary btn-fab btn-fab-mini btn-round">
                    <i class="material-icons">search</i>
                </button>
            </form>
    
            <div class="team">
                <div class="row">
                    @foreach ($categories as $category)
                    <div class="col-md-4">
                        <div class="team-player">
                            <img src="{{ $category->featured_image_url }}" alt="Imágen de la categoria {{ $category->nombre }}" class="img-rounded">
                            <h4 class="title">
                           <a href="{{ url('/categories/'. $category->id) }}"> {{ $category->nombre }}</a> 
                            <br>
                                <small class="text-muted">{{ $category->category_name }}</small>
                            </h4>
                            <p class="description">{{ $category->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="section landing-section">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="text-center title">¿Aún no te has registrado?</h2>
                    <h4 class="text-center description">Obtén tu cuenta ingresando los datos siguientes y podrás realizar tus pedidos a través de nuestro carrito de compras. Al registrarte podrás hacer consultas sin compromiso y recibir ofertas especiales!</h4>                    
                <form class="contact-form" method="get" action="{{ url('/register') }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Escribe tu nombre:</label>
                                    <input name="name" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Ingresa el Email</label>
                                    <input name="email" type="email" class="form-control" required>
                                </div>
                            </div>
                        </div>
                       

                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 text-center">
                                <button type="submit" class="btn btn-primary btn-raised">
                                    Iniciar registro
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

@include('includes.footer')
@endsection

@section('scripts')
    <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
        
    <script>
        $(function(){
            var products = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.whitespace,
              queryTokenizer: Bloodhound.tokenizers.whitespace,              
              prefetch: '{{ url("products/json")}}'
            });

            //inicializamos typeahead sobre el input de búsqueda
            $('#search').typeahead({
                hint: true,
                hightlight: true, //resultados en negrita
                minLenght: 1 //mostrar resultados a partir de un caracter
            }, {
                name: 'products',
                source: products    

            })
        });
    </script>
@endsection
