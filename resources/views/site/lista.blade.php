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
                  
                      <div class="row">
                        <div class="col-md-12">
                          <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Nº POSTAGEM</th>
                                        <th scope="col">TÍTULO</th>
                                        <th scope="col">DATA</th>
                                        <th scope="col">USUÁRIO</th>
                                        <th scope="col">S/N ATIVO</th>
                                        <th scope="col">
                                            <a href="{{ route('novaPostagem') }}" class="btn btn-secondary btn-sm"> NOVO </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($postagens as $postagem)
                                          
                                            <tr>
                                                <th scope="row">
                                                    {{ $postagem->id }}
                                                </th>
                                                <th scope="row">
                                                    {{ $postagem->titulo }}
                                                </th>
                                                <td>
                                                    {{ date('d/m/Y',strtotime($postagem->data)) }}
                                                </td>
                                                <td>
													{{ $postagem->usuarios->name }}
                                                </td>
                                                <td>
													{{ $postagem->sn_ativo == 1 ? 'ATIVO' : 'INATIVA' }}
											  	</td>
											  	<td>
                                                    <a href="{{ route('editarPostagem') }}?postagem_id={{ $postagem->id }}" class="btn btn-secondary btn-sm"> EDITAR </a>
                                                    <a href="{{ route('desabilitarPostagem') }}?postagem_id={{ $postagem->id }}" class="btn btn-secondary btn-sm"> 
                                                        {{ $postagem->sn_ativo == 1 ? 'INATIVAR' : 'ATIVAR' }}
                                                    </a>
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
            {{ $postagens->links() }}
          
          </div>
          
		</div>
		
        <div class="container-fluid">
            @include('layouts.footers.auth')
        </div>

    </div>
    
@endsection

@push('js')
    
@endpush