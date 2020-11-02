@extends('layouts.app')

@section('content')
    @include('layouts.headers.index')
    
    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <form action="{{ route('acompCliente.store') }}" method="POST">
                            @csrf
                        <div class="row align-items-center">
                            <div class="col-md-1">
                             Código:   
                             <input type="text" class="form-control" value="{{ $dadosCliente->id }}" disabled>
                             <input type="text" name="cliente_id" value="{{ $dadosCliente->id }}" hidden>
                            </div>

                            <div class="col-md-7">
                             Nome:
                             <input type="text" class="form-control" value="{{ $dadosCliente->nome }}" disabled>    
                            </div>

                            <div class="col-md-4">
                                Status:
                                <select name="status_id" class="form-control" >
                                    <option value="0">Selecione</option>    
                                    @forelse ($status as $stat)
                                    <option value="{{ $stat->id }}">{{ $stat->ds_status }}</option>
                                    
                                    @empty
                                        
                                    @endforelse   
                                </select>
                            
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <br/>
                                Observações:
                                <textarea name="observacoes" class="form-control" id="" cols="30" rows="3"></textarea>


                                <div class="text-right">
                                    <br/>
                                    <button class="btn btn-primary">Salvar</button>
                                </div>
                                <hr/>

                                <b><i>Histórico:</i></b>
                            </div>
                        </div>
                    </form>
                    </div>
                    
                      <div class="table-responsive">
                      
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Data:</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Observação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($acomps as $acomp)
                                    <tr>

                                        <th scope="row">
                                            
                                            {{ date('d/m/Y', strtotime($acomp->created_at)) }}
                                        </th>
                                        <td>
                                          {{ $acomp->status->ds_status }}
                                        </td>
                                        <td>
                                            {{ $acomp->observacoes }}
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
        <div class="row">
          
          <div class="col-md-12">
            
            <br/>
            {{ $acomps->links() }}
          
          </div>
          
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')

@endpush