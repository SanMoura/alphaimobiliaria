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

                      <form autocomplete="off" method="POST">

                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                    Nome
                                  <input type="text" class="form-control " name="nome" placeholder="">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                    CPF
                                    <input type="text" class="form-control " name="cpf" placeholder="">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                    RG
                                    <input type="text" class="form-control " name="rg" placeholder="">
                                </div>
                              </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group">
                                      Telefone:
                                    <input type="text" class="form-control " name="telefone" placeholder="">
                                  </div>
        
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        Renda:
                                        <input type="text" class="form-control " name="renda" placeholder="">
                                    </div>
                                  </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                      Fonte:
                                      <input type="text" class="form-control " name="fonte" placeholder="">
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                      Data:
                                      <input type="date" class="form-control " name="data" placeholder="">
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
                                    <button class="btn btn-primary">Avançar</button>
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
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush