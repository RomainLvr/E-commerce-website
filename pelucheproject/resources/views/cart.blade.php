<x-layout>
    <div class="container mx-auto my-12">
        @if (!Cart::session(Auth::check() ? Auth::user()->id : 'guest')->isEmpty())
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Total</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Cart::session(Auth::check() ? Auth::user()->id : 'guest')->getContent() as $item)
                            <tr class="hover">
                                <td class="flex flex-row cursor-pointer"
                                    onclick="window.location.href='{{ route('produit', $item->id) }}'">
                                    <img src="{{ asset('storage/images/products/' . $item->attributes->image) }}"
                                        class="w-36 h-36 rounded">
                                    <div class="flex flex-col justify-center ml-4">
                                        <span class="font-extrabold text-xl">
                                            {{ $item->name }}
                                        </span>
                                        <span class="text-sm text-error font-bold">
                                            Il ne reste plus que {{ $item->attributes->stock }} @if ($item->attributes->stock > 1)
                                                exemplaires
                                            @else
                                                exemplaire
                                            @endif en stock.
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-row">
                                        <div class="flex flex-col justify-center">
                                            <button id="dec" product="{{ $item->id }}"
                                                class="btn btn-outline btn-error rounded-l-2xl rounded-r-none {{ $item->quantity == 1 ? 'btn-disabled' : '' }}">
                                                <i class="fas fa-minus">-</i>
                                            </button>
                                        </div>
                                        <input id="qte" type="text" class="input rounded-none"
                                            value="{{ $item->quantity }}" disabled>
                                        <div class="flex flex-col">
                                            <button id="inc" product="{{ $item->id }}"
                                                class="btn btn-outline btn-success rounded-r-2xl rounded-l-none {{ $item->quantity == $item->attributes->stock ? 'btn-disabled' : '' }}">
                                                <i class="fas fa-plus">+</i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ number_format($item->getPriceWithConditions(), 2, ',', ' ') }} €</td>
                                <td>{{ number_format($item->getPriceSumWithConditions(), 2, ',', ' ') }} €</td>
                                <td>
                                    <svg id="delete" product="{{ $item->id }}"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="w-6 h-6 stroke-error cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center my-32">
                    <h1 class="text-4xl font-bold base-content">Votre panier est vide</h1>
                    <button class="btn btn-primary mt-6" onclick="window.location.href='{{ route('produits') }}'">
                        Ajouter des produits
                    </button>
                </div>
        @endif

    </div>

    <script>
        $(document).ready(function() {
            $("#dec").click(function() {
                $.ajax({
                    url: "{{ route('decProduct') }}",
                    data: {
                        userId: @if (Auth::check())
                            {{ Auth::user()->id }}
                        @else
                            "guest"
                        @endif ,
                        productId: $(this).attr('product'),
                    },
                    success: function(data) {
                        $("#qte").val(data.productQuantity);
                    }
                })
            })
            $("#inc").click(function() {
                $.ajax({
                    url: "{{ route('incProduct') }}",
                    data: {
                        userId: @if (Auth::check())
                            {{ Auth::user()->id }}
                        @else
                            "guest"
                        @endif ,
                        productId: $(this).attr('product'),
                    },
                    success: function(data) {
                        $("#qte").val(data.productQuantity);
                    }
                })
            })
            $("#delete").click(function() {
                $.ajax({
                    url: "{{ route('removeProduct') }}",
                    data: {
                        userId: @if (Auth::check())
                            {{ Auth::user()->id }}
                        @else
                            "guest"
                        @endif ,
                        productId: $(this).attr('product'),
                    },
                    success: function(data) {
                        $(this).parent().parent().remove();
                    }
                })
            })
        });
    </script>
</x-layout>
