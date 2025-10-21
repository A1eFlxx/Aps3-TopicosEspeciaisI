@extends('layouts.app')

@section('title', 'Gestão de Categorias')

@section('content')

    <h2>Cadastrar Nova Categoria</h2>
    <form action="{{ url('/categorias') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome da Categoria:</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required>
        </div>
        <button type="submit" class="btn">Salvar Categoria</button>
    </form>

    <hr>

    <h2>Categorias Cadastradas</h2>
    @if ($categorias->isEmpty())
        <p>Nenhuma categoria cadastrada ainda.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Produtos Associados</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nome }}</td>
                        <td>{{ $categoria->produtos_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection