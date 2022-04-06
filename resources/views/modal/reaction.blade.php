<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>

        <form method="post" action="{{url('/reaction')}}">
        {{ csrf_field() }}
            <input type="hidden" name="pedido_id" value="{{$venta->id}}">
            
                <div class="col-sm-11">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">reorder</i></span>   
                        <textarea class="form-control" placeholder="Comentario sobre la entrega" rows="5" name="comentario">{{ old('comentario') }}</textarea>
                    </div>
                </div>
                    
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancelar</button>
            </div>
        </form>

    </div>
  </div>
</div>
