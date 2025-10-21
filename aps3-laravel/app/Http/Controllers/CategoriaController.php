<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Exibe o formulário de cadastro e a lista de categorias.
     */
    public function index()
    {
        // 1. Listar categorias, contando quantos produtos estão associados
        $categorias = Categoria::withCount('produtos')->get();

        // 2. Retornar a view, passando os dados
        return view('recursos.categorias', compact('categorias'));
    }

    /**
     * Processa a requisição POST e salva uma nova categoria no banco.
     */
    public function store(Request $request)
    {
        // 1. Validação dos dados
        $request->validate([
            'nome' => 'required|unique:categorias|max:255',
        ], [
            'nome.required' => 'O campo Nome é obrigatório.',
            'nome.unique' => 'Esta categoria já está cadastrada.',
        ]);

        // 2. Criação do registro
        Categoria::create($request->all());

        // 3. Redirecionamento com mensagem de sucesso
        return redirect('/categorias')->with('success', 'Categoria cadastrada com sucesso!');
    }
}