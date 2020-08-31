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
                                <h3 class="mb-0">Dados da Proposta</h3>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                      
                      @foreach ($proposta_clientes as $proposta_cliente)
                          
                      
                        <div class="row">
                          <div class="col-md-2">
                            Nº Proposta:
                            <input type="text" class="form-control" name="n_proposta" disabled value="{{ $proposta_cliente->id }}">
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                                Cliente:
                              <input type="text" class="form-control " name="nome" disabled value="{{ $proposta_cliente->cliente->nome }}">
                              <input type="text" class="form-control " value="{{ $proposta_cliente->cliente->id }}" name="cliente_id" hidden value="">
                            </div>
                          </div>
                          <div class="col-md-2">
                            Status:
                        
                            <input type="text" class="form-control"  disabled value="{{ $ultimo_status ?? '' }}">
                          </div>
                          <div class="col-md-2">
                            <br/>
                            <button id="{{ $proposta_cliente->id }}" onclick="proposta_id(this)" class="btn btn-secondary" style="border-radius: 0 !important" data-toggle="modal" data-target=".modal-proposta">Atualizar</button>
                            <a class="btn btn-secondary" data-toggle="modal" data-target=".modal-finalizacao" style="border-radius: 0 !important" >Finalizar</a>
                          </div>
                        </div>  
                        @endforeach
                    </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Data Atendimento</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Observação</th>
                                        <th scope="col">Anexos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($log_propostas as $log_proposta)
                                          
                                            <tr>
                                                <th scope="row">
                                                    {{ date('d/m/Y', strtotime($log_proposta->dt_atendimento)) }}
                                                </th>
                                                <td>
                                                    {{ $log_proposta->status->ds_status }}
                                                </td>
                                                <td>
                                                    {{ $log_proposta->observacoes }}
                                                </td>
                                                <td>
                                                <button class="btn btn-secondary btn-sm" style="border-radius: 0 !important" data-toggle="modal" data-target=".modal-ver-anexos" id="{{ $log_proposta->id }}" onclick="exibe_anexos(this)">VER</a>    
                                              </td>
                                            </tr>    
                                        
                                    @empty
                                    <tr>
                                        <th scope="row">
                                            {{ __('Sem resultados') }}
                                        </th>
                                    </tr>     
                                    @endforelse
                                    
                                </tbody>
                            </table>
                        </div>
                        </div>
                      </div>

                
              </div>
            
            </div>
        </div>

        <div class="row">
          
          <div class="col-md-12">
            
            <br/>
            {{ $log_propostas->appends([ 'cliente_id' => $proposta_cliente->id ])->links() }}
          
          </div>
          
        </div>

        <div class="modal fade bd-example-modal-xl modal-proposta" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('propostaLog.store') }}" id="formLogProposta" enctype="multipart/form-data" method="post">
                      @csrf
                      <input type="text" hidden="false" name="proposta_id" id="proposta_id">
                      <input type="text" hidden="false" name="cliente_id_att" value="{{ $proposta_cliente->cliente->id  }}">
                      <div class="row">
                          <div class="col-md-3">
                              Status:
                              
                            <select name="status_id" id="status_id" class="form-control" required>
                                <option value="">Selecione</option>
                                @foreach ($status as $stat)
                                    <option value="{{ $stat->id }}">{{ $stat->ds_status }}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="col-md-3">
                              Data:
                              <input type="date" name="dt_atendimento" id="dt_atendimento" class="form-control" required> 
                        </div> 
                        <div class="col-md-6">
                          Usuário Adicional:
                          <select name="userAdicional" class="form-control">
                          <option value="{{ $usuario_add }}"> {{ $userAddNome }} </option>

                            @foreach ($usuarios as $usuario)

                              <option value="{{ $usuario->id }}"> {{ $usuario->name }} </option>

                            @endforeach
                          </select>
                    </div> 
                      </div> <br/>
                      <div class="row">
                        <div class="col-md-9">
                          Imóvel:
                          <input type="text" name="imovel" id="imovel" class="form-control" value="{{ $imovel }}"> 
                    </div>  
                    <div class="col-md-3">
                      Valor:
                      <input type="text" name="valorImovel" id="valorImovel" class="form-control" value="{{ $valorImovel }}"> 
                </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <br/>
                            Observações:
                            <textarea name="observacoes" class="form-control" rows="10"></textarea>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-12">
                            Anexos:
                            <input type="file" multiple name="file[]" class="form-control">
                        </div>
                    </div>
                    
                  </div>
                </form>
                  <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary" style="border-radius: 0 !important; border-shadow:0"  data-dismiss="modal">Fechar</button>
                    <button class="btn btn-primary" id="btnLogProposta" style="border-radius: 0 !important">Confirmar</button>
                  </div>

                  <div class="container-fluid" id="alert_msg">
                  <div class="alert alert-danger animated bounceInUp"  style="
                  
                  
                  position: fixed
                  bottom: 0;
                  right: 0px;
                  z-index: 1;
              ">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Clise">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  <div class="row">
                      <div class="col-md-1">
                          <div class="text-center">
                              <i class="fas fa-exclamation-triangle fa-3x"></i>
                          </div>
                      </div>
                      <div class="col-md-11">
                          <ul class="mb-0">
                              <li> Há campos que não foram preenchidos, favor rever. </li>
                          </ul>
                      </div>
                  </div>
              </div>
                
                </div>
              </div>
              </div>
            </div>


            {{-- modal dos anexos --}}
            <div class="modal fade bd-example-modal-xl modal-ver-anexos" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                     
                    <div class="row">
                      <div class="col-md-12">
                        <div class="table-responsive">
                          <!-- Projects table -->
                          <table class="table align-items-center table-flush">
                              <thead class="thead-light">
                                  <tr>
                                      <th scope="col">DESCRIÇÃO</th>
                                      <th scope="col" class="text-right"></th>
                                  </tr>
                              </thead>
                              <tbody id="anexosTable">
                                  
                              </tbody>
                          </table>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>


          <div class="modal fade bd-example-modal-xl modal-finalizacao" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <form action="{{ route('finalizar') }}" method="GET">
                    <input hidden type="text" name="proposta_id" value="{{ $proposta_cliente->id }}">
                    <input hidden type="text" name="cliente_id" value="{{ $proposta_cliente->cliente->id }}">
                    @csrf
                  <div class="row">
                    <div class="col-md-12">
                      Motivo da finalização de proposta:<br/>
                     <select name="motFinalizacao" class="form-control">
                       @foreach ($motivos as $motivo)
                        <option value="{{ $motivo->id }}">{{ $motivo->ds_motivo }}</option>
                       @endforeach
                     </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 text-right">
                      <br/>
                      <button class="btn btn-primary"> Concluir </button>
                    </div>
                  </div>

                </form> 
                </div>
              </div>
            </div>
        </div>
        <div class="container-fluid">
            @include('layouts.footers.auth')
        </div>

    </div>
    
@endsection

@push('js')
    
@endpush