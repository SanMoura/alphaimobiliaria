@extends('layouts.app')

@section('content')
    @include('layouts.headers.index')
    
    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Dados da Postagem</h3>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                      <form autocomplete="off" action="{{ route('updatePostagem') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @foreach ($postagens as $postagem)
                        <input name="postagem_id" type="text" value="{{ $postagem->id }}" hidden>
                        
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                    Título
                                  <input type="text" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" name="titulo" placeholder="" value="{{ $postagem->titulo }}">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    Sub Título
                                    <input type="text" class="form-control{{ $errors->has('subTitulo') ? ' is-invalid' : '' }} " name="subTitulo" placeholder="" value="{{ $postagem->sub_titulo }}">
                                </div>
                              </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group">
                                      Data:
                                    <input type="date" class="form-control{{ $errors->has('data') ? ' is-invalid' : '' }} "  name="data" placeholder="" value="{{ date('Y-m-d', strtotime($postagem->data)) }}">
                                  </div>
        
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        Imagem:
                                        <input type="file" class="form-control" id="imagem" name="file" placeholder="" value="">
                                    </div>
                                  </div>
                              </div>

                              {{-- <div class="row">
                                <div class="col-md-12 text-right">
                                    Anexos:
                                    <input type="file" name="anexos" class="form-controll">
                                </div>
                              </div> --}}


                              <div class="row">
                                <div class="col-md-12">
                                    Descrição:
                                    <textarea name="descricao" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }} "  rows="10">{{$postagem->descricao}}</textarea>
                                </div>
                              </div>

                              
                              <div class="row">
                                <div class="col-md-12 text-right">
                                    <br/>
                                    <button class="btn btn-secondary" style="border-radius:0 !important">Salvar</button>
                                </div>
                              </div>
                              <br/>
                              @endforeach
                          </form>

                    </div>
                </div>
            
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')

@endpush