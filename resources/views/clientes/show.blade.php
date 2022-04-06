@extends('layouts.app')
@section('title', 'Developers | Detalle de Pedido')
@section('body-class', 'product-page')

<style>
    body{
  background-color: #ddd;
}
.container{
  margin: 0 auto;
  display: table;
}
.left{
  float: left;
  width: 214px;
  height: 366px;
}
.right{
  float: right;
  display: table;
  width: 60%;
}
.fa{
  display: inline-block;
}
.image{
  margin: 0 auto;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: 1px solid gray;
  display: inline-block;
  padding: 3px;
  border: 3px solid #d2d6de;
  margin-top: 20px;
  margin-right: 57px;
  margin-left: 57px;

}
.has-feedback .form-control {
    padding-right: 42.5px;
}
select[multiple], select[size] {
    height: auto;
}
.form-control {
    border-radius: 0;
    box-shadow: none;
    border-color: #d2d6de;
}
.form-control {
    display: block;
    width: 100%;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
}
label {
  cursor: default;
}
label {
  display: inline-block;
  max-width: 100%;
  margin-bottom: 5px;
  font-weight: 700;
}
.usuername{
    font-size: 21px;
    margin-top: 5px;
}
.text-center {
    text-align: center;
}
.btn{
  margin: 0 auto;
  padding: 6px 12px;
  margin-bottom: 0;
  font-size: 14px;
  font-weight: 400;
  line-height: 1.42857143;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  cursor: pointer;
  -webkit-user-select: none;
  touch-action: manipulation;
  margin-top: 100px;
}
a {
    color: #3c8dbc;
}
a {
    color: #337ab7;
    text-decoration: none;
}
.btn-primary {
    color: #fff;
    background-color: #337ab7;
    display: block;
}
h3{
    font-family: 'Source Sans Pro',sans-serif;
}

.control-label{
  float: left;
}
.form-horizontal .form-group {
    margin-right: -15px;
    margin-left: -15px;
}
.form-group {
    margin-bottom: 15px;
}

.btn-submit {
  background-color: #dd4b39;
  border-color: red;
}
.btn {
  border-radius: 3px;
  box-shadow: none;
  border: 1px solid transparent;
}

.has-feedback {
    position: relative;
}
.form-group {
    margin-bottom: 15px;
}
.left.box-primary {
    border-top-color: #3c8dbc;
    
}
.left {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;
}
button, meter, progress {
    -webkit-writing-mode: horizontal-tb;
}

</style>

@section('content')

<div class="header header-filter">
</div>

<div class="main main-raised">
    <div class="container">        

        <div class="section text-center">
            
            @if (session('msg'))
                <div class="alert alert-success">
                    {{ session('msg') }}
                </div>
            @endif
  <main>
    <div class="container">
      <div class="left box-primary">
        <img class="image" src="https://yt3.ggpht.com/-Y4ybONkbdYA/AAAAAAAAAAI/AAAAAAAAAAA/SCMi3HFru2w/s100-c-k-no-rj-c0xffffff/photo.jpg" alt="" />
        <h3 class="username text-center">{{$cliente->name}}</h3>
        <p>{{$cliente->email}}</p>
        <!--a href="#" class="btn btn-primary btn-block"><b>Editar foto</b></a-->
      </div>
      <div class="right tab-content">
        <form class="form-horizontal" method="post" action="{{ url('/clientes/'.$cliente->id.'/edit') }}">
        {{ csrf_field() }}
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <input type="text" placeholder="Nombre" name="name" class="form-control" value="{{ old('name', $cliente->name) }}">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="text" placeholder="E-mail" name="email" class="form-control" value="{{ old('email', $cliente->email) }}">
            </div>
          </div>
          
          <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Telefono</label>
            <div class="col-sm-10">
                <input type="text" placeholder="Telefono" name="telefono" class="form-control" value="{{ old('telefono', $cliente->telefono) }}">
            </div>
          </div>
          
          <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Direccion</label>
            <div class="col-sm-10">
                <input type="text" placeholder="Direccion" name="direccion" class="form-control" value="{{ old('direccion', $cliente->direccion) }}">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-danger">Guardar los datos</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
        </div>
    </div>
</div>

@include('includes.footer')
@endsection