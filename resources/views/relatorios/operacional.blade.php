@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    @inject('helpers', 'App\Http\Helpers\Helpers')
    @php
        $dt_ini = $_GET['dt_ini'] ?? date('Y-m-d');
        $dt_fim = $_GET['dt_fim'] ?? date('Y-m-d');
        
    @endphp
    <div class="container-fluid mt--7">
      
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div id="relatorioOperacional" >
                <div class="card shadow">
                    <div class="card-header border-0">
                        <form action="{{ route('relatorioOperacional') }}" method="GET">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <h3 class="mb-0">Relatório Operacional</h3>
                                
                                
                            </div>
                            
                                <div class="col-md-3 text-right">

                                    <input type="date" name="dt_ini" class="form-control" value="{{ $dt_ini }}">

                                </div>

                                <div class="col-md-3 text-right">

                                    <input type="date" name="dt_fim" class="form-control" value="{{ $dt_fim }}">
                                
                                </div>
                                
                                <div class="col-md-1 text-right">
                                    <input type="submit" class="btn btn-primary" value="Gerar">
                                </div>
                            
                        </div>
                    </form>
                    </div>
                
                    {{-- inicio relatorio operacional --}}
                    
                        {{-- <div class="row">
                            <div class="col-md-3">
                                <canvas id="chartjs-4" class="chartjs" ></canvas>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                        </div> --}}
                        
                        <div class="row">
                            <div class="col-md-12">
                              <div class="table-responsive">
                                <!-- Projects table -->
                                <table class="table align-items-center table-flush" >
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">CORRETOR</th>
                                            <th scope="col" class="text-center">CONTATOS</th>
                                            <th scope="col" class="text-center">VISITAS AGENDADAS</th>
                                            <th scope="col" class="text-center">VISITAS REALIZADAS</th>
                                            <th scope="col" class="text-center">3 MAIORES FONTES</th>
                                            <th scope="col" class="text-center">PROPOSTAS</th>
                                            <th scope="col" class="text-center">VENDAS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dados as $dado)
                                              
                                                <tr>
                                                    <th scope="row">
                                                        {{ $dado->name }}
                                                    </th>
                                                    <td class="text-center">
                                                        {{ $helpers::totalClientesCorretor($dado->id, $dt_ini, $dt_fim) }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $helpers::totalStatus(2, $dado->id, $dt_ini, $dt_fim) }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $helpers::totalStatus(3, $dado->id, $dt_ini, $dt_fim) }}
                                                    </td>               
                                                    <td class="text-center">
                                                        @forelse ($helpers::fontes($dado->id, $dt_ini, $dt_fim) as $clientesFonte)
                                                         <button class=" btn-outline-default">
                                                            {{ $clientesFonte->ds_fonte }}: {{ $clientesFonte->total }} 
                                                        </button>         
                                                        @empty
                                                        
                                                        @endforelse
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $helpers::totalPropostas($dado->id, $dt_ini, $dt_fim) }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $helpers::totalVendas($dado->id, $dt_ini, $dt_fim) }}
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
                <br/>
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h3 class="mb-0">QUATRO MAIORES FONTES ( MÊS PASSADO X MÊS ATUAL )</h3>
                            </div>
                        </div>
                    </div>


                          <div class="row">
                            <div class="col-md-3">
                              <div class="table-responsive">
                                <!-- Projects table -->
                                <table class="table align-items-center table-flush" >
                                    <thead class="thead-light">
                                        <tr style="border: 1px solid #E9ECEF">
                                            <th scope="col">TOP 4 FONTES / CONTATOS DO MÊS <b>ANTERIOR</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($helpers::fontesGeral($dt_ini, $dt_fim, 0) as $dadoGeralPassado)
                                              
                                                <tr style="border: 1px solid #E9ECEF">
                                                    <th scope="row">
                                                        {{ $dadoGeralPassado->ds_fonte }} : {{ $dadoGeralPassado->total }}
                                                    </th>
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

                            <div class="col-md-3">
                                <div class="table-responsive">
                                  <!-- Projects table -->
                                  <table class="table align-items-center table-flush" >
                                      <thead class="thead-light">
                                          <tr style="border: 1px solid #E9ECEF">
                                              <th scope="col" class="text-center">CONTATOS MÊS <b>ANTERIOR</b></th>
                                          </tr>
                                      </thead>
                                      <tbody>            
                                            <tr style="border: 1px solid #E9ECEF">
                                                <td class="text-center">
                                                    {{ $helpers::totalClientesGeral($dt_ini, $dt_fim, 0) }}
                                                </th>
                                            </tr>    
                                          
                                      </tbody>
                                  </table>
                              </div>
                              </div>

                              <div class="col-md-3">
                                <div class="table-responsive">
                                  <!-- Projects table -->
                                  <table class="table align-items-center table-flush" >
                                      <thead class="thead-light">
                                          <tr style="border: 1px solid #E9ECEF">
                                              <th scope="col">TOP 4 FONTES / CONTATOS DO MÊS <b>ATUAL</b></th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @forelse ($helpers::fontesGeral($dt_ini, $dt_fim, 1) as $dadoGeralAtual)
                                                
                                                  <tr style="border: 1px solid #E9ECEF">
                                                      <th scope="row">
                                                          {{ $dadoGeralAtual->ds_fonte }} : {{ $dadoGeralAtual->total }}
                                                      </th>
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
  
                              <div class="col-md-3">
                                  <div class="table-responsive">
                                    <!-- Projects table -->
                                    <table class="table align-items-center table-flush" >
                                        <thead class="thead-light">
                                            <tr style="border: 1px solid #E9ECEF">
                                                <th scope="col" class="text-center">CONTATOS MÊS <b>ATUAL</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>            
                                              <tr style="border: 1px solid #E9ECEF">
                                                  <td class="text-center">
                                                      {{ $helpers::totalClientesGeral($dt_ini, $dt_fim ,1) }}
                                                  </th>
                                              </tr>    
                                            
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                          </div>
                        </div>
                    
                    <br/>
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <h3 class="mb-0">CORRETORES X CLIENTES X STATUS</h3>
                                </div>
                                <div class="col-md-7 text-right">
                                    <button class="btn-outline-default">
                                        PROPOSTA <i class="fas fa-circle" style="color: rgb(241, 206, 4);"></i> 
                                    </button> 
                                    <button class="btn-outline-default" >
                                        VENDAS <i class="fas fa-circle" style="color: rgb(44, 138, 106);"></i>  
                                    </button>
                                    <button class="btn-outline-default" >
                                        DESIST. NÃO APROV. <i class="fas fa-circle" style="color: rgb(194, 10, 47);"></i>
                                    </button> 
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
                                            <th scope="col">CORRETOR</th>
                                            <th scope="col" class="text-center">CLIENTE</th>
                                            <th scope="col" class="text-center">STATUS</th>
                                            {{-- <th scope="col" class="text-center"></th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>

                                        

                                        @forelse ($helpers::usuariosClientesStatus($dt_ini, $dt_fim) as $dadoUserCliStatus)
                                        
                                        <tr>
                                                    <th scope="row">
                                                        {{ $dadoUserCliStatus->proposta }}
                                                    </th>
                                                    <td >
                                                        {{ $dadoUserCliStatus->nome }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $dadoUserCliStatus->nome_cliente }}
                                                    </td>
                                                    {{-- <td class="text-center">
                                                        {{ $dadoUserCliStatus->status }}
                                                    </td> --}}
                                                    <td class="text-center">
                                                        
                                                        <i class="fas fa-circle" style="color: {{ $helpers::cor($dadoUserCliStatus->proposta) }};"></i>
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

                          <hr/>

                          <div class="row text-right">
                            <div class="col-md-6">
                                <a href="{{ route('relatorioOperacionalI') }}?dt_ini={{$dt_ini}}&dt_fim={{$dt_fim}}" class="btn btn-primary" target="_blank"> Imprimir </a>
                            </div>
                        </div> 
                        
                        <hr/>

                     
                    </div>
                    
                </div>
                
            </div>
   
        

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
<script>


    function dados_relatorio() {

        par_mes = $('#mes_referencia').val()
        
        axios.post("{{ route('relatorioOperacionalFontes') }}", {
            mes : par_mes
        })
        .then(function (response) {

            response.data.forEach(element => {
                let fonte = element.fonte_id;
                console.table(element.fonte); 

                        
            });
            

        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
        });
    }

    new Chart(document.getElementById("chartjs-4"),{
        "type":"doughnut",
        "data":{
            "labels":[
                "OLX","FACEBOOK","PLACA","INSTAGRAM","OUTROS"
                ],
            "datasets":[
                        {
                        "label":"My First Dataset",
                        "data":[300,50,100,100,180],
                        "backgroundColor":[
                            "red",
                            "rgb(54, 162, 235)",
                            "rgb(58, 211, 235)",
                            "rgb(255, 205, 86)",
                            "purple"
                            ]
                        }
                    ]
                }
            }
        );

    </script>
@endpush