@extends('layouts.app')
@section('title', 'Developers | Pedidos')
@section('body-class', 'product-page')


@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
</div>

<div class="main main-raised">
    <div class="container">        

        <div class="section text-center">
            <h2 class="title">Agregar compra</h2>
            <span><strong>(*) Campos Obligatorios</strong></span>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ url('/admin/compra/') }}">
                {{ csrf_field() }}

                <!--div class=" form-group row">
                    <div class="col-sm-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">note_add</i></span>
                            <input type="text" placeholder="Ingrese el numero de compra" name="num_compra" id="num_compra" class="form-control" value="{{ old('num_compra') }}" required pattern="[0-9]{0,15}">
                        </div>
                    </div>
                </div-->
                    
                <div class=" form-group row">
                    <div class="col-sm-8">
                        <select class="form-control" name="id_producto" id="id_producto">
                            <option value="">--Seleccione una prenda--</option>
                                @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                @endforeach
                        </select>                                                                                
                    </div>
                </div>

                <div class=" form-group row">
                    <div class="col-sm-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">note_add</i></span>
                            <input type="number" placeholder="Ingrese la cantidad" name="cantidad" id="cantidad" class="form-control" value="{{ old('cantidad') }}" pattern="[0-9]{0,15}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">note_add</i></span>
                            <input type="number" placeholder="Ingrese el precio" name="precio" id="precio_compra" class="form-control" value="{{ old('cantidad') }}" pattern="[0-9]{0,15}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <button type="button" id="agregar" class="btn btn-primary"> Agregar </button>
                    </div>
                </div>

                <div class="form-group row">
                <h3>Detalle de la compra</h3>
                <div class="table-responsive col-md-12"></div>
                    <table id="detalles" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr class="bg-success">
                                <th>Eliminar</th>
                                <th>Producto</th>
                                <th>Precio(USD$)</th>
                                <th>Cantidad</th>
                                <th>SubTotal(USD$)</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th colspan="4"><p align="right">TOTAL: </p></th>
                                <th><p align="right"><span id="total">USD$ 0.00</span></p></th>                         
                            </tr>
                            <!--tr>
                                <th colspan="4"><p align="right">TOTAL IMPUESTO (20%): </p></th>
                                <th><p align="right"><span id="total_impuesto">USD$ 0.00</span></p></th>    
                            </tr-->
                            <tr>
                                <th colspan="4"><p align="right">TOTAL PAGAR: </p></th> 
                                <th><p align="right"><span align="right" id="total_pagar_html">USD$ 0.00</span><input type="hidden" name="total_pagar" id="total_pagar"></p></th>                       
                            </tr>           
                        </tfoot>

                        <tbody>
                            
                        </tbody>
                    </table>
                </div>

                
                
            <div class="modal-footer form-group row" id="guardar">
                <div class="col-md">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save fa-2x"></i> Registrar
                    </button>
                </div>
            </div>
                
                <!--button class="btn btn-primary">Registrar categoria</button>
                <a href="{{ url('/admin/categories') }}" class="btn btn-default">Cancelar</a-->

            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#agregar").click(function(){
            agregar();
        });
    });

    var cont = 0;
    total = 0;
    subtotal = [];
    $("#guardar").hide();   

    function agregar(){
        id_producto = $("#id_producto").val();
        producto = $("#id_producto option:selected").text();
        cantidad = $("#cantidad").val();

        precio_compra = $("#precio_compra").val();

        if(id_producto != "" || cantidad != "" || cantidad > 0 || precio_compra != ""){
            subtotal[cont] = cantidad * precio_compra;
            total = total + subtotal[cont];

            var fila = '<tr class="selected" id="fila'+cont+'"><td><button class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times fa-2x"></i></button></td><td><input type="hidden" name="id_producto[]" value="'+id_producto+'">'+producto+'</td><td><input type="number" id="precio_compra[]" name="precio_compra[]" value="'+precio_compra+'"></td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td>$'+subtotal[cont]+'</td></tr>';
            cont++;
            limpiar();
            totales();
            evaluar();

            $("#detalles").append(fila);
        }else{
            alert('Error');
        }
    }

    function limpiar(){
        $("#cantidad").val("");
        $("#precio_compra").val("");
    }

    function totales(){
        $("#total").html("USD$ " + total.toFixed(2));
        //total_impuesto = total * (impuesto/100);
        total_pagar = total //+ total_impuesto;
        //$("#total_impuesto").html("USD$ " + total_impuesto.toFixed(2));
        $("#total_pagar_html").html("USD$ " + total_pagar.toFixed(2));
        $("#total_pagar").val(total_pagar.toFixed(2));
    }

    function evaluar(){
        if(total>0){
            $("#guardar").show();
        }else{
            $("#guardar").hide();
        }
    }

    function eliminar(index){
        total = total - subtotal[index];
        //total_impuesto = total * (20/100);
        total_pagar_html = total // + total_impuesto;

        $("#total").html("USD$" + total);
        //$("#total_impuesto").html("USD$" + total_impuesto);
        $("#total_pagar_html").html("USD$" + total_pagar_html);
        $("#total_pagar").html(total_pagar.toFixed(2));
        $("#fila" + index).remove();
        evaluar();
    }

</script>

@endsection
