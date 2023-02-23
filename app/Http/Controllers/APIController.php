<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{
    public function products()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function details($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function login(Request $request)
    {
        //On utilise les fonctions de Laravel pour authentifier l'utilisateur
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Si cela fonctionne, on génère puis retourne un token (ainsi que le nom du token)
            $token = Auth::user()->createToken('LaravelSanctumAuth')->plainTextToken;
            return response()->json(["token" => $token, "name" => "LaravelSanctumAuth"]);
        } else {
            // Si cela ne fonctionne pas, on retourne une erreur
            return abort(401);
        }
    }

    public function test()
    {
        //On retourne simplement les informations correspondant à l'utilisateur connecté
        return response()->json(Auth::user());
    }

    public function store(Request $request)
    {
        // dd($request->json()->all());
        // $data = $request->getContent();
        // dd($data);
        $data = json_decode($request->getContent(),true);
        // dd($data);
        $product=Product::create($data);
        // dd($product);
        // dd($data->image);
        // if ($data->image != null) {
        //     $image = $product->id . '.' . $data->image->extension();
        //     // dd($image);
        //     $data->file('image')->move(public_path('images'), $image);
        //     $product->image = $image;
        //     dd($product);
        // }
        $product->save();
        return 0;
    }
}
