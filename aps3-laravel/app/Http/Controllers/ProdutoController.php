<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Exibe o formulário de cadastro e a lista de produtos.
     */
    public function index()
    {
        // 1. Listar produtos, carregando a relação 'categoria' para exibição
        $produtos = Produto::with('categoria')->get();

        // 2. Listar categorias para popular o Select do formulário
        $categorias = Categoria::all();

        // 3. Retornar a view, passando os dados
        return view('recursos.produtos', compact('produtos', 'categorias'));
    }

    /**
     * Processa a requisição POST e salva um novo produto no banco.
     */
    public function store(Request $request)
    {
        // 1. Validação dos dados
        $request->validate([
            'nome' => 'required|max:255',
            'preco' => 'required|numeric|min:0.01',
            'categoria_id' => 'required|exists:categorias,id',
            // 'descricao' é opcional e não precisa de regra 'required'
        ], [
            'nome.required' => 'O campo Nome é obrigatório.',
            'preco.required' => 'O campo Preço é obrigatório.',
            'preco.numeric' => 'O Preço deve ser um número.',
            'categoria_id.required' => 'Selecione uma Categoria.',
            'categoria_id.exists' => 'A Categoria selecionada é inválida.',
        ]);

        // 2. Criação do registro
        Produto::create($request->all());

        // 3. Redirecionamento com mensagem de sucesso
        return redirect('/produtos')->with('success', 'Produto cadastrado com sucesso!');
    }
}