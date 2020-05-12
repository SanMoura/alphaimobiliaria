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
                                <h3 class="mb-0">Dados Pessoais</h3>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                      <form autocomplete="off" action="{{ route('cliente.store') }}" method="POST">
                        @csrf
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                    Nome
                                  <input type="text" class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" placeholder="" value="{{ old('nome') }}">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                    CPF
                                    <input type="text" id="cpf" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }} " name="cpf" placeholder="" value="{{ old('cpf') }}">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                    RG
                                    <input type="text" class="form-control{{ $errors->has('rg') ? ' is-invalid' : '' }} " name="rg" placeholder="" value="{{ old('rg') }}">
                                </div>
                              </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group">
                                      Telefone:
                                    <input type="text" class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }} " id="telefone" name="telefone" placeholder="" value="{{ old('telefone') }}">
                                  </div>
        
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        Renda:
                                        <input type="text" class="form-control{{ $errors->has('renda') ? ' is-invalid' : '' }} " id="renda" name="renda" placeholder="" value="{{ old('renda') }}">
                                    </div>
                                  </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                      Fonte:
                                      <input type="text" class="form-control{{ $errors->has('fonte') ? ' is-invalid' : '' }} " name="fonte" placeholder="" value="{{ old('fonte') }}">
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                      Data:
                                      <input type="date" class="form-control{{ $errors->has('data') ? ' is-invalid' : '' }} " name="data" placeholder="" value="{{ old('data') }}">
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
                                    Observações:
                                    <textarea name="observacoes" class="form-control " rows="10"></textarea>
                                </div>
                              </div>

                              
                              <div class="row">
                                <div class="col-md-12 text-right">
                                    <br/>
                                    <button class="btn btn-secondary" style="border-radius:0 !important">Avançar</button>
                                </div>
                              </div>
                              <br/>
                       

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