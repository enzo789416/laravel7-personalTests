<?php

namespace App\Http\Controllers\API;

use App\API\ApiError;
use App\Http\Controllers\Controller;
use App\Product;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ['data' => $this->product->paginate(2)];
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $product)
    {
        try {
            $data = $product->all();

            $this->product->create($data);

            $return = response()->json(['msg' => 'Produto cadastrado com sucesso!'], 201);
            return response()->json($return, 1010);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de cadastrar', 1010));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        $product = $this->product->find($product);
        if (! $product) return response()->json(['data'=>['msg' => 'Produto não encontrado!']], 404);
        $data = ["data" => $product];
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        try {
            $data = $request->all();

            $prod = $this->product->find($product);

            $prod->update($data);


            $return = response()->json(['msg' => 'Produto atualizado com sucesso!'], 201);
            return response()->json($return, 1010);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1011));
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de atualizar', 1011));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Product $product)
    {
        try {

            $product->delete();

            $return = response()->json(['msg' => 'Produto removido com sucesso!'], 201);
            return response()->json($return, 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1012));
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de deletar', 1012));
        }
    }
}
