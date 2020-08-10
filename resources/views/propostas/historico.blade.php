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
                  
                      <div class="row">
                        <div class="col-md-12">
                          <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Nº PROPOSTA</th>
                                        <th scope="col">CLIENTE</th>
                                        <th scope="col">DATA FINALIZAÇÃO</th>
                                        <th scope="col">ÚLTIMO STATUS</th>
                                        <th scope="col" colspan="2">ANEXOS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($proposta_clientes as $proposta_cliente)
                                          
                                            <tr>
                                                <th scope="row">
                                                    {{ $proposta_cliente->id }}
                                                </th>
                                                <th scope="row">
                                                    {{ $proposta_cliente->cliente->nome }}
                                                </th>
                                                <td>
                                                    {{ date('d/m/Y',strtotime($proposta_cliente->updated_at)) }}
                                                </td>
                                                <td>
                                                    @foreach ($proposta_cliente->log_proposta as $item)
                                                        
                                                    @endforeach
                                                    {{ $item->status->ds_status }}
                                                </td>               
                                                <td>
                                                    <button class="btn btn-secondary btn-sm" style="border-radius: 0 !important" data-toggle="modal" data-target=".modal-ver-anexos" id="{{ $proposta_cliente->id }}" onclick="exibe_anexos_finalizados(this)">VER</button>    
                                              </td>
                                              <td>
                                            @if ( auth()->user()->cargo_id <> 1 )
                                            <a href="{{ route('novaProposta') }}?cliente_id={{ $proposta_cliente->cliente->id }}" class="btn btn-secondary btn-sm text-right" style="border-radius: 0 !important">NOVO</a>      
                                                
                                            @endif
                                              
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
            {{ $proposta_clientes->links() }}
          
          </div>
          
        </div>

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
      
        <div class="container-fluid">
            @include('layouts.footers.auth')
        </div>

    </div>
    
@endsection

@push('js')
    
@endpush