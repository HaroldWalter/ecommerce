@extends("layout")
{{-- iueuieiueui --}}
@section("content")
<main class="products">
    @foreach ($products as $product) 
        <article>
            <img src="/images/{{$product->image}}" alt="">
            <div>
                <div>{{$product->name}}</div>
                <div>{{$product->price}}€</div>
            </div>
            
            <a href="/details/{{$product->id}}">Voir</a>
        </article>
    @endforeach
</main>
@endsection
