@extends("layout")

@section("content")
<main class="panier">
<ul>
    @foreach ($panier as $product)

        <li>
            {{$product->name}} -
            x{{$product->quantity}} -
            {{$product->price}}€ -
            {{$product->total}}€
        </li>
    @endforeach

    <p>Total : {{$total}}</p>
</ul>
<a href="/validation">Valider la commande</a>
</main>
@endsection
