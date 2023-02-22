<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //
    public function viewAll()
    {
        // Si on affiche les données venant du json ProductManager.json
        // $products = ProductManager::getAllProducts();

        // Si on affiche les données venant de la banque de données
        $products = Product::all();

        return view("products")->with("products", $products);
    }

    public function details($id)
    {
        // $product = ProductManager::getProductById($id);
        $product = Product::findOrFail($id);
        return view("details")->with("product", $product);
    }

    public function ajout($id, Request $request)
    {
        $panier = $request->session()->get("panier", []);

        $product = null;
        foreach ($panier as $item) {
            if ($id == $item->id) {
                $item->quantity++;
                $product = $item;
                break;
            }
        }

        if ($product == null) {
            // $product = ProductManager::getProductById($id);
            $product = Product::findOrFail($id);
            $product->quantity = 1;
            array_push($panier, $product);
        }

        $request->session()->put("panier", $panier);
        Session::save();
        return redirect("/panier");
    }

    public function panier(Request $request)
    {

        $panier = $request->session()->get("panier", []);


        $total = 0;

        foreach ($panier as $item) {
            $totalligne = $item->quantity * $item->price;
            $item->total = $totalligne;
            $total += $totalligne;
        }

        return view("panier")
            ->with("panier", $panier)
            ->with("total", $total);
    }

    public function validation(Request $request)
    {
        $request->session()->flush();
        $commandeTime = time();

        return view('validation')->with('commandeTime', $commandeTime);
    }

    public function create()
    {
        return view("/product/create");
    }

    public function save(ProductRequest $request)
    {
        $product = Product::create($request->all());

        // Maintenant qu'on a l'ID du produit, on stocke l'image
        if ($request->image != null) {
            $image = $product->id . '.' . $request->image->extension();
            // dd($image);
            $request->file('image')->move(public_path('images'), $image);
            $product->image = $image;

        }
        $product->save();
        return redirect('/');
    }

    public function modify($id)
    {

        $product = Product::findOrFail($id);
        return view("/product/modify")->withProduct($product);
    }

    public function saveModify($id, ProductRequest $request)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->input("name");
        $product->description = $request->input("description");
        $product->price = $request->input("price");
        $product->vat = $request->input("vat");
        if ($request->image != null) {
            $todelete = public_path('images') . "/" . $product->image;
            unlink($todelete);
            $image = $product->id . '.' . $request->image->extension();
            // dd($image);
            $request->file('image')->move(public_path('images'), $image);
            $product->image = $image;
        }
        $product->save();
        return redirect('/');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $todelete = public_path('images') . "/" . $product->image;
        unlink($todelete);
        $product->delete();
        return redirect('/');
    }
}
