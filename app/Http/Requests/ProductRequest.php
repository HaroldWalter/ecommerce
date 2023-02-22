<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        // return true;
        // dd(!Auth::guest() && Auth::user()->isAdmin);
        return !Auth::guest() && Auth::user()->isAdmin;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            //le nom du produit est obligatoire et doit comprendre enntre 2 et 100 caractères.
            "name" => "required|between:2,100",

            // la description du produit est obligatoire et s'écrite dans une zone de texte limité à 2 000 caractères
            "description" => "required|max:2000",

            //le prix est une valeur obligatoire, numérique, positive et inférieur à 1 000 000
            "price" => "required|numeric|min:0|max:1000000",
            // la TVA est une valeur numérique obligatoire comprise entre 0 et 100
            "vat" => "required|numeric|between:0,100",
            // l'image n'est pas obligatoire mais doit être au format PNG ou JPG et ne ne pas excéded 1Mo
            "image" => "image"
        ];

        if ($this->input("_method") == null) {
            $rules["image"] = "required|image";
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            "name.required" => "Saisir un nom",
            "name.between" => "Saisir un nom qui fait plus de 2 caractères et moins de 100",
            "description.required" => "Saisir une description",
            "description.max" => "Saisir une description qui fait moins de 2000 caractères",
            "price.required" => "Saisir un prix",
            "price.numeric" => "Saisir un nombre",
            "price.min" => "Saisir un nombre positif",
            "price.max" => "Saisir un nombre inférieur à 1 000 000",
            "vat.required" => "Selectionner une valeur de TVA",
            "vat.numeric" => "Saisir un nombre",
            "vat.between" => "Saisir une valeur entre 0 et 100",
            "image.image" => "Selectionner un fichier image",
            // "image.max"=>"Selectionner un fichier de 1Mo maximum"

        ];
    }
}
