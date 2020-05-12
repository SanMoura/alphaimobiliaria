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
                              
                            </div>
                        </div>
                    </div>
                    
                      <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">CPF</th>
                                    <th scope="col">RG</th>
                                    <th scope="col">FONTE</th>
                                    <th scope="col">TELEFONE</th>
                                    @if ($cargo == 1)
                                        <th scope="col">USUÁRIO</th>    
                                    @endif
                                  <th scope="col" class="text-center"><a href="{{ route('cadCliente') }}" class="btn btn-secondary btn-sm" style="border-radius: 0 !important">NOVO</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($clientes as $cliente)
                                    <tr>
                                        <th scope="row">
                                            {{ $cliente->nome }}
                                        </th>
                                        <td>
                                          {{ $cliente->cpf }}
                                        </td>
                                        <td>
                                            {{ $cliente->rg }}
                                        </td>
                                        <td>
                                            {{ $cliente->fonte }}
                                        </td>
                                        <td>
                                          {{ $cliente->telefone }}
                                        </td>
                                        @if ($cargo == 1)
                                        <td>
                                            {{ $cliente->usuario->name }}
                                          </td>
                                        @endif
                                        <td class="text-center"><a href="{{ route('editCliente',['cliente_id' => $cliente->id]) }}" class="btn btn-secondary btn-sm" style="border-radius: 0 !important">EDITAR</a>
                                        @if ($cliente->proposta == false)
                                            <a href="{{ route('editCliente',['cliente_id' => $cliente->id]) }}" class="btn btn-primary btn-sm" style="border-radius: 0 !important">NOVA PROPOSTA</a></td>    
                                        @endif
                                        
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
            {{ $clientes->links() }}
          
          </div>
          
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')

@endpush