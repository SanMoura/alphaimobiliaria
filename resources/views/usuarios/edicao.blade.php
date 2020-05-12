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
              
                  @forelse ($usuarios as $usuario)
                      <form autocomplete="off" action="{{ route('updateUsuario') }}" method="POST">
                        @csrf
                        <input type="text" name="usuario_id" value="{{ $usuario->id }}" hidden>
                            
                        
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                    Nome
                                  <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="" value="{{ $usuario->name }}">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                    Login
                                    <input type="text"  class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} " name="email" placeholder="" value="{{ $usuario->email }}">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                    Senha
                                    </select>
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} " name="password" placeholder="" >
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-3">
                                <div class="form-group">
                                    CPF
                                    <input type="text" name="cpf" id="cpfUsuario" class="form-control" value="{{ $usuario->cpf }}">
                                </div>
      
                              </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                      Cargo:
                                      <select name="cargo" class="form-control{{ $errors->has('cargo') ? ' is-invalid' : '' }} ">
                                          <option value="">Selecione</option>
                                        @foreach ($cargos as $cargo)
                                          <option value="{{ $cargo->id }}">{{ $cargo->ds_cargo }}</option>
                                        @endforeach
                                      </select>
                                    
                                  </div>
        
                                </div>
                                
                              </div>

                              <div class="row">
                                <div class="col-md-12 text-right">
                                    <br/>
                                    <button class="btn btn-primary">Confirmar</button>
                                </div>
                              </div>
                              <br/>
                              
                              
                          </form>
                          @empty
                            Sem resultados.
                          @endforelse
                    </div>
                </div>
            
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')

@endpush