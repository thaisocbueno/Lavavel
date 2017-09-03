<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Product;
use App\Http\Requests\Painel\ProductFormRequest;

class ProdutoController extends Controller
{
    private $product;
    private $totalPage = 3;

    public function __construct(Product $product)
    {
        $this->middleware('auth')->except('index');
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem dos Produtos';

        $products = $this->product->paginate($this->totalPage);

        return view('painel.products.index', compact('products','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Produto';

        $categorys = ['Eletronicos', 'Livros', 'Automotivo', 'Musica'];

        return view('painel.products.create-edit', compact('title','categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {
        $dataForm = $request->all();

        $dataForm['active'] = ( !isset($dataForm['active']) ) ? 0 : 1;

        $insert = $this->product->create($dataForm);

        if( $insert )
            return redirect()->route('produtos.index');
        else
            return redirect()->route('produtos.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->find($id);

        $title = "Produto: {$product->name}";

        return view('painel.products.show', compact('title', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->find($id);

        $title = "Editar Produto: {$product->name}";

        $categorys = ['Eletronicos', 'Livros', 'Automotivo', 'Musica'];

        return view('painel.products.create-edit', compact('title','categorys', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, $id)
    {
        $dataForm = $request->all();

        $product = $this->product->find($id);

        $dataForm['active'] = ( !isset($dataForm['active']) ) ? 0 : 1;

        $update = $product->update($dataForm);

        if( $update )
            return redirect()->route('produtos.index');
        else
            return redirect()->route('produtos.edit', $id)->with(['errors' => 'Falha ao editar.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->find($id);

        $delete = $product->delete();

        if( $delete )
            return redirect()->route('produtos.index');
        else
            return redirect()->route('produtos.show', $id)->with(['errors' => 'Falha ao apagar.']);
    }
}
