@extends('layouts.app')
@section('title', 'Listado de categorias')
@section('body-class', 'product-page')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php echo $chartData?>
        ]);

        var options = {
          title: 'Reacciones',
          //pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

@section('content')
<div class="header header-filter">
</div>

<div class="main main-raised">
    <div class="container">        

        <div class="section text-center">
            <div id="piechart" style="width: 700px; height: 300px;"></div>
            
            <div class="row">
                <div class="col-sm-3">
                    <form  class="form-inline" method="get" action="{{ url('/admin/opinion') }}">
                        <input id="search"type="text" class="form-control" placeholder="¿Buscar por tipo de comentario?" name="query">
                        <button class="btn btn-primary btn-fab btn-fab-mini btn-round">
                            <i class="material-icons">search</i>
                        </button>
                    </form>
                </div>
                <div class="col-sm-8 text-center">
                    <h2 class="title">Comentarios</h2>
                </div>
            </div>

            <div class="team">
                <div class="row">  
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-md-1 text-center">#</th>
                                <th class="col-md-2 text-center">Cliente</th>
                                <th class='col-md-2 text-center'>Pedido</th>                               
                                <th class='col-md-5 text-center'>Comentario</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($coment as $comentario)
                          <tr>
                              <td class="text-center">{{ $comentario->id }}</td>
                              <td class="text-center">{{ $comentario->cliente->name }}</td>
                              <td class="text-center">{{ $comentario->pedido->id }}</td>
                              <td class="text-center">{{ $comentario->comentario }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>        
    </div>
</div>
@include('includes.footer')
@endsection


