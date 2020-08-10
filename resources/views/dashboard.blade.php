@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
      <!--  <div class="row">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                <h2 class="text-white mb-0">Sales value</h2>
                            </div>
                            <div class="col">
                                <ul class="nav nav-pills justify-content-end">
                                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                            <span class="d-none d-md-block">Month</span>
                                            <span class="d-md-none">M</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                            <span class="d-none d-md-block">Week</span>
                                            <span class="d-md-none">W</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <div class="chart">
                        
                            <canvas id="chart-sales" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                                <h2 class="mb-0">Total orders</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <div class="chart">
                            <canvas id="chart-orders" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Clientes com Propostas</h3>
                            </div>
                            <!--<div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">Ver todos</a>
                            </div>-->
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">Fonte</th>
                                    <th scope="col">Renda</th>
                                    @if ( auth()->user()->cargo_id == 1 )
                                        <th scope="col">Usuário</th>
                                    @endif
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($propostas_home as $proposta_home)
                                    <tr>
                                        <th scope="row">
                                            {{ $proposta_home->cliente->nome }}
                                        </th>
                                        <td>
                                            {{ date('d/m/Y', strtotime($proposta_home->cliente->data)) }}
                                        </td>
                                        <td>
                                            {{ $proposta_home->cliente->telefone }}
                                        </td>
                                        <td>
                                            {{ $proposta_home->cliente->fonte }}
                                        </td>
                                        <td>
                                            {{ $proposta_home->cliente->renda }}
                                        </td>
                                        @if ( auth()->user()->cargo_id == 1 )
                                            <td>
                                                {{ $proposta_home->proposta_users_relation[0]->usuarios_proposta->name }}
                                            </td>
                                        @endif
                                        <td>
                                            <a href="{{ route('proposta.index') }}?cliente_id={{ $proposta_home->cliente->id }}" class="btn btn-sm btn-secondary" style="border-radius: 0 !important">Proposta</button>
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
              {{ $propostas_home->links() }}
            
            </div>
            
          </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
@endpush