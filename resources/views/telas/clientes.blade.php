@extends('layouts.telas', ['title' => 'Skedoo - Responsaveis'], ['nometela' => 'Clientes - Responsaveis dos Alunos'])

@section('voltar')
<x-button-back href="{{route('instituicao')}}" icon="uil uil-estate"/>
@endsection

@section('content')

    <div class="search">
        <input type="search" placeholder="Pesquisar" aria-label="Pesquisar">
        <button type="submit"><i class="uil uil-search"></i></button>
    </div>

    <table class="tabela">
        <h2>Tabela de Clientes</h2>
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Cadastro</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($TbResponsaveis as $TbResponsavel)
                <tr class="pessoa">
                    <td class="nome">{{ $TbResponsavel->nm_responsavel }}</td>
                    <td scope>{{ $TbResponsavel->cd_cadastro }}</td>
                    <td class="botoes"><button class="ver">Vizualizar</button>
                    <td class="botoes"><button class="editar">Editar</button></td>
                    <td class="botoes"><button class="deletar"><i class="uil uil-trash-alt"></i></button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination justify-content-center">
        {{ $TbResponsaveis->links()}}
    </div>
    
    <script src="{{ asset('js/configTelas.js') }}"></script>
@endsection
