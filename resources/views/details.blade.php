@extends("layout")
{{-- iueuieiueui --}}
@section("content")
<main class="product">
            <img src="/images/{{$product->image}}" alt="">
            <div>
                <div>{{$product->name}}</div>
                <div>{{$product->price}}€</div>
                <div>{{$product->description}}</div>
            <a href="/ajout/{{$product->id}}">Ajouter </a>
            </div>

</main>
@endsection
