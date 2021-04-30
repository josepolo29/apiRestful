<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use App\Transformers\ProductTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellerProductController extends ApiController
{

    public function __construct()
    {
        parent::__construct();

        $this->middleware('transform.input:'.ProductTransformer::class)->only(['store', 'update']);
        $this->middleware('scope:manage-products')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $products = $seller->products;
        return $this->showAll($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $seller)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $data['status'] = Product::PRODUCTO_NO_DISPONIBLE;
        $data['image'] = $request->image->store('');
        $data['seller_id'] = $seller->id;

        $product = Product::create($data);

        return $this->showOne($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller, Product $product)
    {
        $rules = [
            'quantity' => 'integer|min:1',
            'status' => 'in: '. Product::PRODUCTO_DISPONIBLE.','.Product::PRODUCTO_NO_DISPONIBLE,
            'image' => 'image',
        ];

        $this->validate($request, $rules);

        $this->verifySeller($seller, $product);

        $product->fill($request->only(['name', 'description', 'quantity']));
    
        if($request->has('status')){
            $product->status = $request->status;

            if($product->estaDisponible() && $product->categories()->count() === 0){
                return $this->errorResponse('Un producto activo debe tener al menos una categoría', 409);
            }
        }

        if($request->hasFile('image')){
            Storage::delete($product->image);
            $product->image = $request->image->store('');
        }

        if($product->isClean()) return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);

        $product->save();

        return $this->showOne($product);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller, Product $product)
    {
        $this->verifySeller($seller, $product);

        Storage::delete($product->image);

        $product->delete();

        return $this->showOne($product);
    }

    public function verifySeller(Seller $seller, Product $product){
        if($seller->id != $product->seller_id){
            throw new HttpException(422, 'El vendedor especificado no es el vendedor real del Producto');
        }
    }
}
