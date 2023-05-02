@extends('layouts.telas', ['title' => 'Skedoo - Responsaveis'], ['nometela' => 'Clientes - Responsaveis dos Alunos'])

@section('voltar')
    <x-button-back href="{{ route('instituicao') }}" icon="uil uil-estate" />
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/logins/estilo_instituicao.css') }}">
@endsection

@section('content')
<h1>Informações do cliente</h1>
    <div class="insert">
        <form class="form-cadastro" id="form" method="POST">
            @csrf
            <label>Nome do Cliente</label>
            <input type="text" class="texto" style="width:100%" id="name" name="name"><br><br>
            <div class="div-input-flex">
                <div class="block" style="width:40%;">
                    <label>CPF</label><br>
                    <input type="text" class="texto" style="text-align:center; width:90%" id="cpf" name="cpf">
                </div>
                <div class="block" style="width:60%;">
                    <label>Email</label><br>
                    <input type="text" class="texto" style="width:100%" id="email" name="email"><br><br>
                </div>
            </div>
            <div class="div-input-flex">
                <div class="block" style="width:50%;">
                    <label>Telefone</label><br>
                    <input type="text" class="texto" id="tel" name="tel">
                </div>
                <div class="block" style="width:45%;">
                    <label>Celular</label><br>
                    <input type="text" class="texto" style="width:100%" id="cel" name="cel"><br><br>
                </div>
            </div>
            <div class="div-input-flex">
                <div class="block" style="width:90%;">
                    <label>Cidade</label><br>
                    <input type="text" class="texto" id="cidade" name="cidade" style="width:90%;">
                </div>
                <div class="block" style="width:90%;">
                    <label>Logradouro</label><br>
                    <input type="text" class="texto" id="logradouro" name="logradouro" style="width:90%;">
                </div>
                <div class="block" style="width:25%;">
                    <label>Numero</label></label><br>
                    <input type="text" class="texto" style="width:100%" id="num" name="num"><br><br>
                </div>
            </div>
            <div class="div-input-flex">
                <div class="block" style="width:50%;">
                    <label>CEP</label><br>
                    <input type="text" class="texto" id="cep" name="cep">
                </div>
                <div class="block" style="width:45%;">
                    <label>Bairro</label></label><br>
                    <input type="text" class="texto" style="width:100%" id="bairro" name="bairro"><br><br>
                </div>
            </div>
            <div class="div-input-flex">
                <div class="block" style="width:90%;">
                    <label>Complemento</label><br>
                    <input type="text" class="texto" id="complemento" name="complemento" style="width:90%;">
                </div>
                <div class="block" style="width:25%;">
                    <label>UF</label></label><br>
                    <input type="text" class="texto" style="width:100%" id="uf" name="uf"><br><br>
                </div>
            </div>
            <label>Nome do Aluno</label>
            <input type="text" class="texto" style="width:100%" id="nomeAluno" name="nomeAluno"><br><br>
            <input type="submit" class="enviar">
            <button type="reset" class="cancelar" onclick="fechaForm()">Cancelar</button>
        </form>
    </div>
    <div class="search" id="pesquisa" style="display:none;">
        <input type="search" placeholder="Pesquisar responsavel" aria-label="Pesquisar">
        <button type="submit"><i class="uil uil-search"></i></button>
    </div>

    <div class="div-tabela">
        <table class="tabela">
            <h2>Tabela de Clientes</h2>
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Cadastro</th>
                    <th scope="col"></th>
                    <th scope="col"><button class="inserir" onclick="inserir()">Inserir</button></th>
                    <th scope="col" id="abrePesquisa" class="pesquisa-tabela"style="height:82px;"><button
                            class="pesquisar" onclick="pesquisar()"><i class="uil uil-search"></i></button></th>
                    <th scope="col" id="fechaPesquisa" class="pesquisa-tabela"style="display: none;"><button
                            class="pesquisar" onclick="fechaPesquisar()"><i class="uil uil-times"></i></button></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($TbResponsaveis as $TbResponsavel)
                    <tr class="pessoa">
                        <td class="nome">{{ $TbResponsavel->nm_responsavel }}</td>
                        <td scope>{{ $TbResponsavel->cd_cadastro }}</td>
                        <td class="botoes">
                            <form method="GET" action="{{route('instituicao.clientes.view', $TbResponsavel->cd_responsavel)}}">
                                <button type="submit" class="ver">Vizualizar</button>
                            </form>
                        </td>
                        <td class="botoes"><button class="editar">Editar</button></td>
                        <td class="botoes">
                            <form method="POST" action="{{route('instituicao.clientes.delete', $TbResponsavel->cd_responsavel)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="deletar"><i class="uil uil-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination justify-content-center">
            {{ $TbResponsaveis->links() }}
        </div>
        <br>
    </div>

    <script src="{{ asset('js/configTelas.js') }}"></script>
@endsection
