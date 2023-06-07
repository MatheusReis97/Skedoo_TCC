@extends('layouts.telas', ['title' => 'Skedoo - Chat'], ['nometela' => 'Mensagens'])

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/logins/estilo_educador.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mensagens.css') }}">
@endsection
@section('voltar')
    <x-button-back href="{{ route('educador') }}" icon="uil uil-estate" />
@endsection


@section('nav-telas')
<div class="nav">
    <img id="logo-skedoo" src="{{ asset('../img/Skedoo.png') }}" alt="">
    <h4 id="data-atual">{{ \Carbon\Carbon::now(new DateTimeZone('America/Sao_Paulo'))->format('d/m/Y') }}</h4>
    <div class="perfil-bg">
        <h3>
            Bem-vindo, {{ session('login')['nm_login'] }}
            <a href="{{ route('educador.perfil') }}">
                @if($login->img_perfil)
                    <img name="image" class="img-perfil" class="img-personalizado" src="{{ url('storage/' . $login->img_perfil) }}" alt="">
                @else
                    <img name="image" class="img-perfil" src="https://i.stack.imgur.com/Bzcs0.png" alt="">
                @endif
            </a>
        </h3>
    </div>
</div>
@endsection

@section('content')
<div class="search" id="pesquisa" style="display:none;">
    <input type="text" id="search-input" placeholder="Pesquisar usuários" onkeyup="pesquisando()" autocomplete="off">
</div>
<div class="resultados" id="resultados">
</div>
    <div class="div-conteudo">
        <div class="div-usuarios">
            <h3>Usuários</h3>
            <div class="usuarios">
                <h5 class="tt-usuarios">Instituição</h5>
                @foreach ($TbInstituicao as $TbInstituicao)
                    <button class="usuario" onclick="getID({{ $TbInstituicao->cd_cadastro }})">
                        <p id="nm{{ $TbInstituicao->cd_cadastro }}">{{ $TbInstituicao->nm_instituicao }}</p>
                    </button>
                @endforeach
                <h5 class="tt-usuarios">Responsaveis</h5>
                @foreach ($TbResponsaveis as $TbResponsavel)
                    <button class="usuario" onclick="getID({{ $TbResponsavel->cd_cadastro }})">
                        <p id="nm{{ $TbResponsavel->cd_cadastro }}">{{ $TbResponsavel->nm_responsavel }}</p>
                    </button>
                @endforeach
            </div>
        </div>
        <div class="block">
            <div class="div-mensagens">
                <div class="topo-mensagens flex">
                    <button id="abrePesquisa" class="pesquisar" onclick="pesquisar()"><i class="uil uil-search"></i></button>
                <button id="fechaPesquisa"class="pesquisar" onclick="fechaPesquisar()" style="display:none;"><i class="uil uil-times"></i></button>
                    <h3 id="nomeChat">Nome do destinatario</h3>
                </div>
                <div id="div-mensagens" class="mensagens">
                    <h3 style="height:100%; width:100%; text-align:center; margin-top:10%">Carregando...</h3>
                </div>
            </div>
            <div class="div-form">
                <div class="form-mensagem" action="">
                    <input type="text" id="mensagem" autocomplete="off">
                    <button onclick="enviarMensagem()">Enviar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/configChat.js') }}"></script>
@endsection
