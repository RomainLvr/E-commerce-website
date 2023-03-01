<x-layout>
    <div class="container mx-auto my-12">
        @if (!Cart::session(Auth::check() ? Auth::user()->id : 'guest')->isEmpty())
            <div class="overflow-x-auto shadow-2xl rounded-xl">
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
                            <tr class="hover transition-all duration-300 ease-in-out">
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
                                            <button product="{{ $item->id }}"
                                                class="dec btn btn-outline btn-error rounded-l-2xl rounded-r-none {{ $item->quantity == 1 ? 'btn-disabled' : '' }}">
                                                -
                                            </button>
                                        </div>
                                        <input id="qte" type="text" class="input rounded-none"
                                            value="{{ $item->quantity }}" disabled>
                                        <div class="flex flex-col">
                                            <button product="{{ $item->id }}"
                                                class="inc btn btn-outline btn-success rounded-r-2xl rounded-l-none {{ $item->quantity == $item->attributes->stock ? 'btn-disabled' : '' }}">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td><span>{{ number_format($item->getPriceWithConditions(), 2, ',', ' ') }} €</span>
                                </td>
                                <td><span
                                        class="total font-extrabold transition-all duration-100 ease-in-out">{{ number_format($item->getPriceSumWithConditions(), 2, ',', ' ') }}
                                        €</span></td>
                                <td>
                                    <svg product="{{ $item->id }}" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="delete w-6 h-6 stroke-error cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex flex-row justify-between items-center mt-12 border-primary border-2 rounded-lg shadow-xl p-4">
                <div class="flex flex-col gap-3">
                    <div class="flex flex-row justify-center gap-3">
                        <span class="text-2xl font-bold">Total : </span>
                        <span
                            class="subTotal text-2xl font-extrabold text-primary transition-all duration-100 ease-in-out">{{ Cart::session(Auth::check() ? Auth::user()->id : 'guest')->getTotal() }}
                            €</span>
                    </div>
                    <div>
                        <span
                            class="nbArticles text-xl font-extrabold text-primary transition-all duration-100 ease-in-out">{{ Cart::session(Auth::check() ? Auth::user()->id : 'guest')->getTotalQuantity() }}</span>
                        <span class="text-xl font-bold">@if (Cart::session(Auth::check() ? Auth::user()->id : 'guest')->getTotalQuantity() > 1)articles
                            @else
                                article
                            @endif
                        </span>
                    </div>
                </div>
                <div class="flex flex-row justify-end">
                    <button class="btn btn-primary" onclick="window.location.href=''">
                        Commander
                    </button>
                </div>
            </div>
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
            $(".dec").click(function() {
                var btnDec = $(this);
                var btnInc = btnDec.closest("tr").find(".inc");
                $.ajax({
                    url: "{{ route('decProduct') }}",
                    data: {
                        userId: @if (Auth::check())
                            {{ Auth::user()->id }}
                        @else
                            "guest"
                        @endif ,
                        productId: btnDec.attr('product'),
                    },
                    success: function(data) {
                        btnDec.closest("tr").find("#qte").val(data.productQuantity);
                        if (data.productQuantity == 1) {
                            btnDec.addClass("btn-disabled");
                        }
                        if (data.productQuantity < data.productStock) {
                            btnInc.removeClass("btn-disabled");
                        }
                        btnDec.closest("tr").find(".total").addClass("opacity-0");
                        $('.subTotal').addClass("opacity-0");
                        setTimeout(function() {
                            btnDec.closest("tr").find(".total").text(data
                                .productTotalPrice + " €");
                            $('.subTotal').text(data.total + " €");
                            btnDec.closest("tr").find(".total").removeClass(
                                "opacity-0");
                            $('.subTotal').removeClass("opacity-0");
                        }, 150);
                        updateCart(data);
                    }

                });
            });

            $(".inc").click(function() {
                var btnInc = $(this);
                var btnDec = btnInc.closest("tr").find(".dec");
                $.ajax({
                    url: "{{ route('incProduct') }}",
                    data: {
                        userId: @if (Auth::check())
                            {{ Auth::user()->id }}
                        @else
                            "guest"
                        @endif ,
                        productId: btnInc.attr('product'),
                    },
                    success: function(data) {
                        btnInc.closest("tr").find("#qte").val(data.productQuantity);
                        if (data.productQuantity == data.productStock) {
                            btnInc.addClass("btn-disabled");
                        }
                        if (data.productQuantity > 1) {
                            btnDec.removeClass("btn-disabled");
                        }
                        btnInc.closest("tr").find(".total").addClass("opacity-0");
                        $('.subTotal').addClass("opacity-0");
                        setTimeout(function() {
                            btnInc.closest("tr").find(".total").text(data
                                .productTotalPrice + " €");
                            $('.subTotal').text(data.total + " €");
                            btnInc.closest("tr").find(".total").removeClass(
                                "opacity-0");
                            $('.subTotal').removeClass("opacity-0");
                        }, 150);
                        updateCart(data);
                    }
                });
            });

            $(".delete").click(function() {
                var btn = $(this);
                $.ajax({
                    url: "{{ route('removeProduct') }}",
                    data: {
                        userId: @if (Auth::check())
                            {{ Auth::user()->id }}
                        @else
                            "guest"
                        @endif ,
                        productId: btn.attr('product'),
                    },
                    success: function(data) {
                        btn.closest("tr").addClass("opacity-0");
                        $('.subTotal').addClass("opacity-0");
                        setTimeout(function() {
                            btn.closest("tr").remove();
                            $('.subTotal').text(data.total + " €");
                            $('.subTotal').removeClass("opacity-0");
                        }, 300);
                        updateCart(data);
                    }
                });
            });

            function updateCart(data) {
                $('#cartCountIndicator').html(data.count);
                $('#cartTotal').html(data.total + ' €');
                $('#cartProducts').children("li").remove();
                $.each(data.items, function(index, item) {
                    var name = item.name;
                    var qte = item.quantity;
                    var price = data.itemsPrices[item.id];
                    var image = data.itemsImages[item.id];
                    var link = data.itemsLinks[item.id];
                    $('#cartProducts').prepend(
                        `
                                <li id="cartItem">
                                            <a href="${link}" class="flex items-center gap-2">
                                                <img src="${image}"
                                                    alt="product" class="w-20 h-20 rounded">
                                                <div class="flex flex-col w-full">
                                                    <span class="font-extrabold">${name}</span>
                                                    <div class="flex flex-row justify-between">
                                                        <span class="text-lg">x${qte}</span>
                                                        <span class="text-lg text-primary font-bold">
                                                            ${price}€
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                `
                    )
                });
            }
        });
    </script>
</x-layout>
