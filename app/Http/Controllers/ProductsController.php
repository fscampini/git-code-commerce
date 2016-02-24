<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Product;
use Illuminate\Http\Request;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class ProductsController extends Controller
{
    private $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    public function index()
    {
        $products = $this->productModel->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create(Category $category)
    {
        $categories = $category->lists('name', 'id');

        return view('products.create', compact('categories'));
    }

    public function store(Requests\CategoryRequest $request)
    {
        $input = $request->all();

        $product = $this->productModel->fill($input);

        $product->save();

        return redirect()->route('products');
    }

    public function edit($id, Category $category)
    {
        $categories = $category->lists('name', 'id');

        $product = $this->productModel->find($id);

        return view('products.edit', compact('product', 'categories'));

        return redirect()->route('products');
    }

    public function update(Requests\CategoryRequest $request, $id)
    {
        $this->productModel->find($id)->update($request->all());

        return redirect()->route('products');
    }

    public function destroy($id)
    {
        $this->productModel->find($id)->delete();

        return redirect()->route('products');
    }
}
