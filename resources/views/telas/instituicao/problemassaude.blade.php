@extends('layouts.telas', ['title' => 'Saude'], ['nometela' => 'Problemas de Saúde'])

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/logins/estilo_instituicao.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilo_saude.css') }}">
@endsection

@section('voltar')
    <x-button-back href="{{ route('instituicao') }}" icon="uil uil-estate" />
@endsection

@section('nav-telas')
    <div class="nav">
        <img id="logo-skedoo" src="{{ asset('../img/Skedoo.png') }}" alt="">
        <h4 id="data-atual">{{ \Carbon\Carbon::now(new DateTimeZone('America/Sao_Paulo'))->format('d/m/Y') }}</h4>
        <div class="perfil-bg">
            <h3>
                Bem-vindo, {{ session('login')['nm_login'] }}
                <a href="{{ route('instituicao.perfil') }}">
                    @if ($login->img_perfil)
                        <img name="image" class="img-perfil" class="img-personalizado"
                            src="{{ url('storage/' . $login->img_perfil) }}" alt="">
                    @else
                        <img name="image" class="img-perfil" src="https://i.stack.imgur.com/Bzcs0.png" alt="">
                    @endif
                </a>
            </h3>
        </div>
    </div>
@endsection

@section('content')
    <div class="div-conteudo">

        <div style="background-color: white;border-radius: 2em;padding:3em;">
            <h2 style="color:#6aa39e;">Indique o problema de saúde de determinado aluno.</h2>
            <form action="{{route('instituicao.problemassaude.insert')}}" method="POST">
                @csrf
                <div class="grupo_input">
                    <div class="input_box">
                        <label>Nome do Aluno</label>
                        <input type="text" autocomplete="off" id="nome" name="nome" autocomplete="off" onkeyup="pesquisando()">
                    </div>
                    <div class="resultados" id="resultados">
                    </div>

                    <div class="input_box">
                        <label>Tipos de Problema</label>
                        <select class="dropdown" name="tipos" id="tipos">
                            <option class="opcao" value="0">Selecione</option>
                            <option class="opcao" value="cardiaco">Cardíaco</option>
                            <option class="opcao" value="respiratorio">Respiratório</option>
                            <option class="opcao" value="alergico">Alérgico</option>
                            <option class="opcao" value="outro">Outro</option>
                        </select>
                    </div>

                    <div class="input_box">
                        <label>Gravidade</label>
                        <select class="dropdown" name="grav" id="grav">
                            <option class="opcao" value="0">Selecione</option>
                            <option class="opcao" value="Gravissima">Gravíssima</option>
                            <option class="opcao" value="Grave">Grave</option>
                            <option class="opcao" value="Moderada">Moderada</option>
                        </select>
                    </div>

                    <div class="input_box">
                        <label>Nome do Problema</label>
                        <input id="input-cel" autocomplete="off" type="text" id="nomedoproblema" name="nomedoproblema">
                    </div>
                </div>

                <div class="input_box">
                    <label id="label_duv">Descrição do Problema e Cuidados</label>
                    <textarea name="textarea_div" id="textarea_div" cols="30" rows="10"></textarea>
                </div>


                <div class="botao_envio">
                    <button type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </div><br>
    <div class="div-conteudo">
        <div style="background-color: white;border-radius: 2em;padding:3em;">
            <h3 style="text-align: center">Quadro de Saúde</h3>
        </div>
        <br>
        @if(isset($TbAlunos))

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Gravidade</th>
                <th><th>Opções</th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($TbAlunos as $aluno)
                @if($aluno->nm_grav_saude === 'Gravissima')

                    <tr class="gravissima">
                        <td>{{ $aluno->nm_aluno }}</td>
                        <td>{{ $aluno->nm_grav_saude }}</td>
                        <td class="botoes">
                            <form method="GET"
                                action="">
                                <button type="submit" class="ver">Vizualizar</button>
                            </form>
                        </td>
                        <td class="botoes">
                            <form method="GET"
                                action="">
                                <button class="editar">Editar</button>
                            </form>
                        </td>
                        <td class="botoes">
                            <form method="POST"
                                action="">
                                @csrf
                                @method('DELETE')
                     <button type="submit" class="deletar"><i class="uil uil-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @elseif($aluno->nm_grav_saude === 'Grave')
                    <tr class="grave">
                        <td>{{ $aluno->nm_aluno }}</td>
                        <td>{{ $aluno->nm_grav_saude }}</td>
                       <td class="botoes">
                            <form method="GET"
                                action="">
                                <button type="submit" class="ver">Vizualizar</button>
                            </form>
                        </td>
                        <td class="botoes">
                            <form method="GET"
                                action="">
                                <button class="editar">Editar</button>
                            </form>
                        </td>
                        <td class="botoes">
                            <form method="POST"
                                action="">
                                @csrf
                                @method('DELETE')
                     <button type="submit" class="deletar"><i class="uil uil-trash-alt"></i></button>
                            </form>
                        </td>

                    </tr>
                @elseif($aluno->nm_grav_saude === 'Moderada')
                    <tr class="moderada">
                        <td>{{ $aluno->nm_aluno }}</td>
                        <td>{{ $aluno->nm_grav_saude }}</td>
                        <td class="botoes">
                            <form method="GET"
                                action="">
                                <button type="submit" class="ver">Vizualizar</button>
                            </form>
                        </td>
                        <td class="botoes">
                            <form method="GET"
                                action="">
                                <button class="editar">Editar</button>
                            </form>
                        </td>
                        <td class="botoes">
                            <form method="POST"
                                action="">
                                @csrf
                                @method('DELETE')
                     <button type="submit" class="deletar"><i class="uil uil-trash-alt"></i></button>
                            </form>
                        </td>

                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endif
    </div>
    <script src="{{asset('js/configSaude.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.4.1.js"></script>
    <script>
$(document).ready(function() {
    $('#nome').on('input', function() {
        var query = $(this).val();

        if (query.length >= 2) {
            $.ajax({
                url: '/saude',
                dataType: 'json',
                data: {
                    term: query
                },
                success: function(data) {
                    $('#saude-results').empty();

                    $.each(data, function(key, value) {
                        $('#saude-results').append('<li>' + value + '</li>');
                    });
                }
            });
        } else {
            $('#saude-results').empty();
        }
    });
});
</script>
@endsection
