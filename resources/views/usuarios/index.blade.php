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
                                    <th scope="col">LOGIN</th>
                                    <th scope="col">CPF</th>
                                    <th scope="col">CARGO</th>
                                    <th scope="col">PONTOS</th>
                                  <th scope="col" class="text-center"><a href="{{ route('cadastrarUsuario') }}" class="btn btn-secondary btn-sm" style="border-radius: 0 !important">NOVO</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($usuarios as $usuario)
                                    <tr>
                                        <th scope="row">
                                            {{ $usuario->name }}
                                        </th>
                                        <td>
                                          {{ $usuario->email }}
                                        </td>
                                        <td>
                                            {{ $usuario->cpf }}
                                        </td>
                                        <td>
                                            {{ $usuario->cargo->ds_cargo }}
                                        </td>
                                        <td>
                                            <div class="pontosMask">{{ $usuario->pontos ?? '120000'}}</div>
                                        </td>
                                        <td class="text-center"><a href="{{ route('editUsuario',['usuario_id' => $usuario->id]) }}" class="btn btn-secondary btn-sm" style="border-radius: 0 !important">EDITAR</a></td>
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
            {{ $usuarios->links() }}
          
          </div>
          
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')

@endpush