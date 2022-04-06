@extends('layouts.app')
@section('title', 'Developers | Detalle de Pedido')
@section('body-class', 'product-page')

<style>

p{
  font-size: .9em;
  color: #666;
  line-height: 1.2em;
}

#invoiceholder{
  width:100%;
  padding-top: 50px;
}

#invoice{
  position: relative;
  top: -290px;
  margin: 0 auto;
  width: 700px;
  background: #FFF;
}

[id*='invoice-']{
  border-bottom: 1px solid #EEE;
  padding: 30px;
}


.info{
  display: block;
  float:left;
  margin-left: 20px;
}
#project{margin-left: 70%;}

table{
  width: 100%;
  border-collapse: collapse;
}
td{
  padding: 5px 0 5px 15px;
  border: 1px solid #EEE
}
.tabletitle{
  padding: 5px;
  background: #EEE;
}
.service{border: 1px solid #EEE;}
.item{width: 50%;}
.itemtext{font-size: .9em;}

#legalcopy{
  margin-top: 30px;
}

.effect2
{
  position: relative;
}
.effect2:before, .effect2:after
{
  z-index: -1;
  position: absolute;
  content: "";
  bottom: 15px;
  left: 10px;
  width: 50%;
  top: 80%;
  max-width:300px;
  background: #777;
  -webkit-box-shadow: 0 15px 10px #777;
  -moz-box-shadow: 0 15px 10px #777;
  box-shadow: 0 15px 10px #777;
  -webkit-transform: rotate(-3deg);
  -moz-transform: rotate(-3deg);
  -o-transform: rotate(-3deg);
  -ms-transform: rotate(-3deg);
  transform: rotate(-3deg);
}
.effect2:after
{
  -webkit-transform: rotate(3deg);
  -moz-transform: rotate(3deg);
  -o-transform: rotate(3deg);
  -ms-transform: rotate(3deg);
  transform: rotate(3deg);
  right: 10px;
  left: auto;
}

</style>

@section('content')

<div class="header header-filter">
</div>

<div class="main">
    <div class="container">        
        <div class="section text-center">
            <div id="invoiceholder">
                <div id="invoice" class="effect2">
                    <div id="invoice-mid">
                        <div class="info">
                            <h2>{{$pedido->cliente->name}}</h2>
                            <p>{{$pedido->cliente->email}}</br>
                            {{$pedido->cliente->telefono}}</br>
                        </div>
                        <div id="project">
                            <p>{{$pedido->cliente->direccion}}</p>
                            <p>{{$pedido->fecha_reserva}}</p>
                        </div>   
                    </div><!--End Invoice Mid-->
                    
                        <div id="invoice-bot">
                        
                            <div id="table">
                                <table>
                                <tr class="tabletitle">
                                    <td class="item">Prendas</td>
                                    <td class="Hours">Cantidad</td>
                                    <td class="Rate">Precio</td>
                                    <td class="subtotal">Sub-total</td>
                                </tr>

                                @foreach($detailPedido as $detalle)
                                    <tr class="service">
                                        <td class="tableitem"><p class="itemtext">{{$detalle->prenda->nombre}}</p></td>
                                        <td class="tableitem"><p class="itemtext">{{$detalle->cantidad}}</p></td>
                                        <td class="tableitem"><p class="itemtext">{{$detalle->prenda->precioUnit}}</p></td>
                                        @if ($detalle->conDescuento === null)
                                        <td class="tableitem"><p class="itemtext">${{ $detalle->subTotal }}</p></td>
                                        @else
                                        <td class="tableitem"><p class="itemtext">${{ $detalle->conDescuento }} dto.</p></td>
                                        @endif
                                    </tr>
                                @endforeach
                                <tr class="tabletitle">
                                    <td></td>
                                    <td></td>
                                    <td class="Rate">Total</td>
                                    <td class="payment">${{ $total }}</td>
                                </tr>
                                </table>
                            </div>
                            
                            <div id="legalcopy">
                                <p class="legal"><strong>Thank you for your business!</strong>  Payment is expected within 31 days; please process this invoice within that time. There will be a 5% interest charge per month on late invoices. 
                                </p>
                            </div>
                        
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')
@endsection