
            <div class="row">
                <div class="col-sm-4">
                    <form method="post" action="{{url('/reaction/'.$comentario->id.'/edit')}}">
                    {{ csrf_field() }}
                        <div class="modal-body">
                            <input type="hidden" class="form-control" name="opinion" value="sad">
                            <button type="submit" class="btn btn-info btn-simple" rel="tooltip" title="Triste">
                                <div class="emoji-kapsa">
                                    <div class="emoji-sad">
                                        <div class="eyes"></div>
                                        <div class="eyes"></div>
                                        <div class="tears"></div>
                                        <div class="mouth"></div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-sm-4">
                    <form method="post" action="{{url('/reaction/'.$comentario->id.'/edit')}}">
                    {{ csrf_field() }}
                            <div class="modal-body">
                                <input type="hidden" class="form-control" name="opinion" value="happy">
                                <button type="submit" class="btn btn-info btn-simple" rel="tooltip" title="Feliz">
                                    <div class="emoji-kapsa">
                                        <div class="emoji-happy">
                                            <div class="eyes"></div>
                                            <div class="eyes"></div>
                                            <div class="tears"></div>
                                            <div class="tears"></div>
                                            <div class="mouth">
                                                <div class="teeth"></div>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </div>
                    </form>
                </div>
                
                <div class="col-sm-4">
                    <form method="post" action="{{url('/reaction/'.$comentario->id.'/edit')}}">
                    {{ csrf_field() }}
                            <div class="modal-body">
                                <input type="hidden" class="form-control" name="opinion" value="angry">
                                <button type="submit" class="btn btn-info btn-simple" rel="tooltip" title="Enojado">
                                    <div class="emoji-kapsa">
                                        <div class="emoji-angry">
                                            <div class="eyes"></div>
                                            <div class="eyes"></div>
                                            <div class="mouth"></div>
                                        </div>
                                    </div>
                                </button>
                            </div>
                    </form>
                </div>
            </div>