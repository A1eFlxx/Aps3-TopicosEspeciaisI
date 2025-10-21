@extends('layouts.app')

@section('title', 'Gestão de Produtos')

@section('content')

    <h2>Cadastrar Novo Produto</h2>
    <form action="{{ url('/produtos') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição (Opcional):</label>
            <textarea name="descricao" id="descricao">{{ old('descricao') }}</textarea>
        </div>
        <div class="form-group">
            <label for="preco">Preço:</label>
            <input type="number" name="preco" id="preco" step="0.01" min="0.01" value="{{ old('preco') }}" required>
        </div>
        <div class="form-group">
            <label for="categoria_id">Categoria:</label>
            <select name="categoria_id" id="categoria_id" required>
                <option value="">Selecione uma Categoria</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn">Salvar Produto</button>
    </form>

    <hr>

    <h2>Produtos Cadastrados</h2>
    @if ($produtos->isEmpty())
        <p>Nenhum produto cadastrado ainda.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                    <tr>
                        <td>{{ $produto->id }}</td>
                        <td>{{ $produto->nome }}</td>
                        <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                        <td>{{ $produto->categoria->nome ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection