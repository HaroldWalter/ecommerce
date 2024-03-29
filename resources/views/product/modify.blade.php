@extends('layout')
@section('content')
    <main>
        <h2>Modifier un produit</h2>
        <form method="POST" action="/product/save-modify/{{$product->id}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="name">Nom du produit*</label><br>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}"><br>
            @error('name')
                <div class="error"> {{ $message }}</div>
            @enderror
            <label for="description">Description*</label><br>
            <textarea id="description" name="description">
            {{ old('description', $product->description) }}
        </textarea><br>
            @error('description')
                <div class="error"> {{ $message }}</div>
            @enderror
            <label for="image">Illustration du produit</label><br>
            <input type="file" id="image" name="image"><br>
            @error('image')
                <div class="error"> {{ $message }}</div>
            @enderror
            <div class="prixFormWrap">
                <div class="prixFormItem">
                    <label for="price">Prix*</label><br>
                    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}"><br>
                    @error('price')
                        <div class="error"> {{ $message }}</div>
                    @enderror

                </div>
                <div class="prixFormItem">
                    <label for="vat">Taux de TVA*</label>
                    <br>
                    <select name="vat" id="vat">
                        <option value="2.1" @if ($product->vat == 2.1) selected @endif>2.1%</option>
                        <option value="5" @if ($product->vat == 5) selected @endif>5%</option>
                        <option value="10" @if ($product->vat == 10) selected @endif>10%</option>
                        <option value="20" @if ($product->vat == 20) selected @endif>20%</option>
                    </select>
                    @error('vat')
                        <div class="error"> {{ $message }}</div>
                    @enderror
                </div>

            </div><br>
            <input type="submit" value=" Modifier">


        </form>
    </main>
@endsection
