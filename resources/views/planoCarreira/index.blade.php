@extends('layouts.app')

@section('content')
    @include('layouts.headers.index')
    @inject('helpers', 'App\Http\Helpers\Helpers')
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
                                    <th scope="col">Proposta</th>
                                    <th scope="col">Imóvel</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Usuários</th>
                                    <th scope="col"></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pontos as $ponto)
                                    <tr>
                                        <th scope="row">
                                            {{ $ponto->id }}
                                        </th>
                                        <td>
                                            @php
                                                echo $helpers::imovelDescValor($ponto->id)['descricao'];    
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                                echo $valorTela = $helpers::imovelDescValor($ponto->id)['valor'];    
                                            @endphp
                                        </td>
                                        <td>
                                            {{ $ponto->cliente->nome }}
                                        </td>
                                        <td>            
                                            @php
                                                echo $helpers::identificaUsuario($ponto->proposta_users_relation[0]->user_id).' / '.$helpers::identificaUsuario($ponto->proposta_users_relation[0]->user_id_adicional);    
                                            @endphp
                                        </td>
                                        <input type="text" hidden value="{{ $ponto->proposta_users_relation[0]->user_id }}" id="user_id{{ $ponto->id }}">
                                        <input type="text" hidden value="{{ $ponto->proposta_users_relation[0]->user_id_adicional }}" id="user_id_adicional{{ $ponto->id }}">
                                       <td>
                                        <i class="fas fa-chevron-down" style="cursor: pointer;" id="iconRange{{ $ponto->id }}" onclick="abreGerencPontos(this)"></i>
                                       </td>
                                    </tr>    
                                    <tr style="background-color: rgb(241, 241, 241)"  id="trRange{{ $ponto->id }}" class="trRange">

                       

                                        <td colspan="6" class="text-center">
                                            <div class="row" >
                                            <input type="text" hidden id="valorRange{{$ponto->id}}" value="{{ intval(str_replace('.', '', $valorTela)) }}">
                                                <div class="col-md-2">DIVISÃO DE PONTOS: <i class="fas fa-chart-pie"></i></div>
                                                <div class="col-md-3"><a class="btn">
                                                    @php
                                                        echo $helpers::identificaUsuario($ponto->proposta_users_relation[0]->user_id);    
                                                    @endphp
                                                    <b id="user1range{{$ponto->id}}">
                                                        @if ($ponto->proposta_users_relation[0]->user_id_adicional > 0) 
                                                            (50%) 
                                                        @else 
                                                            (100%) 
                                                        @endif
                                                    </b></a><br>
                                                    <div id="pontosRange1{{$ponto->id}}">  
                                                        @php
                                                        
                                                        if ($ponto->proposta_users_relation[0]->user_id_adicional > 0){
                                                            echo  intval(str_replace('.', '',$helpers::imovelDescValor($ponto->id)['valor'])) / 2;
                                                        }else {
                                                            echo  intval(str_replace('.', '',$helpers::imovelDescValor($ponto->id)['valor']));
                                                        }
                                               
                                                        
                                                    @endphp 
                                                        </div>(Pontos)
                                                </div>
                                                <div class="col-md-2">
                                                    @if ($ponto->proposta_users_relation[0]->user_id_adicional > 0)
                                                    <br/>

                                                    <input style="background-color: white !important" list="tickmarks" type="range" min="0" max="100" id="range{{$ponto->id}}" onmousemove="mostraValorPontos(this)">
                                                    <datalist id="tickmarks">
                                                        <option value="0">
                                                        <option value="10">
                                                        <option value="20">
                                                        <option value="30">
                                                        <option value="40">
                                                        <option value="50">
                                                        <option value="60">
                                                        <option value="70">
                                                        <option value="80">
                                                        <option value="90">
                                                        <option value="100">
                                                      </datalist> 
                                                    @endif
                                                    
                                                </div>

                                                <div class="col-md-3"><a class="btn">
                                                    @php
                                                        echo $helpers::identificaUsuario($ponto->proposta_users_relation[0]->user_id_adicional);    
                                                    @endphp
                                                    <b id="user2range{{$ponto->id}}">
                                                        @if ($ponto->proposta_users_relation[0]->user_id_adicional > 0) 
                                                        (50%) 
                                                    @else 
                                                        
                                                    @endif</b></a><br>
                                                    @php
                                                        echo '<div id="pontosRange2'.$ponto->id.'">';
                                                        
                                                        if ($ponto->proposta_users_relation[0]->user_id_adicional > 0){
                                                            echo  intval(str_replace('.', '',$helpers::imovelDescValor($ponto->id)['valor'])) / 2;
                                                            echo '</div>(Pontos)';
                                                        }else {
                                                            echo '</div>';
                                                        }
                                               
                                                        
                                                    
                                                        
                                                        @endphp 
                                                    
                                                </div>

                                                <div class="col-md-2"><button class="btn btn-primary" onclick="atribuiPontos(this)" id="btn{{$ponto->id}}">Confirmar</button></div> 
                                                
                                            </div>

                                        
                                        

                                            
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
            {{-- {{ $clientes->links() }} --}}
          
          </div>
          
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')

<script>

    function mostraValorPontos(e) {
        let valor = $(e).val();
        let id    = $(e).attr('id').replace('range', '');

        let valorImovel = $('#valorRange'+id).val();

        
            let user2rangeValorPercent = valor;
            let user1rangeValorPercent = 100 - user2rangeValorPercent;
        

        

        let user1rangeValor = (parseInt(valorImovel) * (user1rangeValorPercent / 100));

        let user2rangeValor = (parseInt(valorImovel) * (user2rangeValorPercent / 100));
        
        $('#user1range'+id).html('( '+user1rangeValorPercent+'% )');
        $('#user2range'+id).html('( '+user2rangeValorPercent+'% )');

        $('#pontosRange1'+id).html(user1rangeValor);
        $('#pontosRange2'+id).html(user2rangeValor);
        
        
    }

    function abreGerencPontos(a) {
        $('.trRange').hide();
        let id    = $(a).attr('id').replace('iconRange', '');

        $('#trRange'+id).show();

        

    }


    function atribuiPontos(nrProposta) {

        let vNrProposta         = $(nrProposta).attr('id').replace('btn', '');

        let user_id             = $('#user_id'+vNrProposta).val();

        let user_id_adicional   = $('#user_id_adicional'+vNrProposta).val();

        let valor1        = $('#pontosRange1'+vNrProposta).html();

        let valor2        = $('#pontosRange2'+vNrProposta).html();


        
        axios.post("{{ route('atribuiPontos') }}", {
            vNrProposta         : vNrProposta,
            user_id             : user_id,
            user_id_adicional   : user_id_adicional,
            valor1              : valor1,
            valor2              : valor2,
                    })
                .then(function (response) {
                    alert('Pontos Atribuídos com sucesso!');
//                    document.location.reload(true);
                })
                .catch(function (error) {
                    alert('Ocorreu um erro, tente novamente!');
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                    document.location.reload(true);
                });

    }

</script>

@endpush