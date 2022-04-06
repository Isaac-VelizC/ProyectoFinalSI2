@extends('layouts.app')
@section('title', 'Resultados de búsqueda')
@section('body-class', 'profile-page')

<link rel="stylesheet" href="{{asset('clients/css/cardPrendas.css')}}">

@section('styles')
    <style>
            
         .team {
            margin-bottom: 50px;
         }
         .row {
            margin-top: 20px;
         }

    </style>
@endsection

@section('content')    
<div class="header header-filter" style="background-image: url('/img/examples/city.jpg');"></div>

<div class="main main-raised">
<div class="profile-content">
    <div class="container">
        <div class="rows">
            <div class="profile">
                <div class="avatar">
                    <img src="clients/img/search.png" alt="Imágen representativa de la búsqueda" class="img-rounded img-responsive">
                </div>
                <div class="name">
                    <h3 class="title">Resultados de búsqueda</h3>                   
                </div>

                 @if (session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                @endif
                
            </div>
        </div>
        <div class="description text-center">
            <p>Se encontraron {{ $products->count() }}  resultados para el término: <b>{{$query}}</b></p>
        </div>
    
            
           <div class="team text-center">
                      <div class="row">
                               @foreach ($products as $key => $product)
                                
                                @if(!($key % 3) and $key > 0)
                                </div>
                                <div class="row">
                                @endif
                                
                                <div class="col-md-4">
                                    <figure class="snip1249">
                                        <div class="image">
                                            <img src="{{ $product->featured_image_url }}" alt="Thumbnail Image"/>
                                        </div>
                                        <figcaption>
                                            <h3>{{ $product->nombre }}</h3>
                                            @if($product->stock === 0)
                                                <span class="action-button red">agotado</span>
                                            @else
                                                <span class="action-button green">disponible</span>
                                            @endif
                                            <p>{{ $product->description }}</p>
                                            <div class="price">
                                            <!--s>${{number_format($product->precioUnit, 2)}}</s-->${{number_format($product->precioUnit, 2)}}
                                            </div>
                                            <a href="{{ url('/products/'. $product->id) }}" class="add-to-cart">Ver</a>
                                        </figcaption>
                                    </figure>
                                </div> 
                                @endforeach
                    </div>

                <div class="text-center">
                    {{ $products->links() }}
                </div>
    
            </div>
        </div>
    </div>
</div>
</div>

@include('includes.footer')
@endsection




