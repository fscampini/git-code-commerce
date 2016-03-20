<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Product;
use CodeCommerce\Tag;
use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class StoreController extends Controller
{

    public function index()
    {
        $pFeatured = Product::featured()->get();
        $pRecommend = Product::recommend()->get();
        $categories = Category::all();
        return view('store.index', compact('categories', 'pFeatured', 'pRecommend'));
    }

    public function categoryProducts($id)
    {

        $pFeatured = Product::featured()->where('category_id', '=', $id)->get();
        $pRecommend = Product::recommend()->where('category_id', '=', $id)->get();
        $categories = Category::all();

        return view('store.index', compact('categories', 'pFeatured', 'pRecommend'));
    }

    public function category($id)
    {
        $categories = Category::all();
        $category = Category::find($id);
        $products = Product::ofCategory($id)->get();

        return view('store.category', compact('categories', 'products', 'category'));
    }

    public function tag($id)
    {
        $categories = Category::all();
        $tag = Tag::find($id);
        $products = $tag->products;

        return view('store.tag', compact('categories', 'products', 'tag'));
    }

    public function product($id)
    {
        $categories = Category::all();
        $product = Product::find($id);

        return view('store.product', compact('categories', 'product'));
    }
}
