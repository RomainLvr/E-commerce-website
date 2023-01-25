<x-layout>
    <div class="py-8">
        <div class="container mx-auto">
            <div class="flex flex-row justify-between">
                <select id="sort" class="select select-primary w-full max-w-xs">
                    <option disabled selected>Trier par</option>
                    <option value="priceAsc">Prix croissant</option>
                    <option value="priceDesc">Prix décroissant</option>
                    <option value="nameAsc">Nom A-Z</option>
                    <option value="nameDesc">Nom Z-A</option>
                    <option value="new">Nouveautés</option>
                    <option value="rate">Meilleures notes</option>
                </select>
                <div class="">
                    <div class="flex flex-row justify-center relative">
                        <input id="search" type="text" placeholder="Rechercher"
                            class="input input-bordered input-primary w-full max-w-xs" />
                        <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <section name="productsGrid" class="flex flex-wrap justify-center gap-10 mx-14 py-8">
            @foreach ($produits as $produit)
                <div name="product"
                    class="card card-compact max-w-screen-sm bg-base-100 shadow-xl hover:scale-105 transition-transform">
                    <div class="relative">
                        <figure class="max-w-xl min-w-fit rounded-t-2xl"><img
                                class="max-w-md @if ($produit->stock == 0) opacity-50 @endif"
                                src="{{ asset('storage/images/products/' . $produit->getPrimaryImage()->image) }}" />
                        </figure>
                        @if ($produit->stock == 0)
                            <div class="w-max h-max absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                                <span class="flex flex-row items-center text-xl font-extrabold text-error">
                                    <svg xmlns="http://www.w3.org/2000/svg"fill="none" viewBox="0 0 48 48"
                                        stroke-width="1.5" stroke="currentColor" class="w-10  h-10 mb-1">
                                        <path
                                            d="M27.707 7.70711C28.0975 7.31658 28.0975 6.68342 27.707 6.29289C27.3165 5.90237 26.6833 5.90237 26.2928 6.29289L24.0001 8.58554L21.7075 6.29289C21.317 5.90237 20.6838 5.90237 20.2933 6.29289C19.9027 6.68342 19.9027 7.31658 20.2933 7.70711L22.5859 9.99976L20.2931 12.2925C19.9026 12.683 19.9026 13.3162 20.2931 13.7067C20.6837 14.0973 21.3168 14.0973 21.7074 13.7067L24.0001 11.414L26.2929 13.7067C26.6834 14.0973 27.3166 14.0973 27.7071 13.7067C28.0976 13.3162 28.0976 12.683 27.7071 12.2925L25.4143 9.99976L27.707 7.70711Z" />
                                        <path
                                            d="M6.68378 26.4487L10 27.5541V36C10 36.4262 10.2701 36.8056 10.6729 36.945L23.6649 41.4422C23.8636 41.5131 24.086 41.5217 24.3015 41.4535L24.3161 41.4487L24.3313 41.4436L37.3271 36.945C37.7299 36.8056 38 36.4262 38 36V27.5541L41.3162 26.4487C41.6264 26.3453 41.8665 26.0968 41.9591 25.7832C42.0517 25.4697 41.9851 25.1306 41.7809 24.8753L37.7809 19.8753C37.6595 19.7236 37.5003 19.6145 37.3249 19.5542L24.3271 15.055C24.1152 14.9817 23.8848 14.9817 23.6729 15.055L10.6751 19.5543C10.4997 19.6145 10.3405 19.7236 10.2191 19.8753L6.21914 24.8753C6.01489 25.1306 5.94836 25.4697 6.04096 25.7832C6.13356 26.0968 6.3736 26.3453 6.68378 26.4487ZM21.3192 30.5735L23 28.1724V39.0956L12 35.2879V28.2208L20.1838 30.9487C20.6036 31.0886 21.0655 30.936 21.3192 30.5735ZM14.0571 20.5L24 23.9418L33.9429 20.5L24 17.0582L14.0571 20.5ZM26.6808 30.5735L25 28.1724V39.0956L36 35.2879V28.2208L27.8162 30.9487C27.3964 31.0886 26.9345 30.936 26.6808 30.5735ZM11.3399 21.6759L8.67677 25.0048L14.1881 26.8419L20.1086 28.8154L22.4212 25.5117L22.2861 25.465L11.3399 21.6759ZM39.3232 25.0048L36.6601 21.6759L25.5789 25.5117L27.8915 28.8154L39.3232 25.0048Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-xl font-extrabold mt-1">Rupture de stock</p>
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <h2 class="card-title">{{ $produit->name }}
                            @if ($produit->isNew())
                                <span class="badge badge-primary">New</span>
                            @endif
                        </h2>
                        <div class="flex items-center gap-6 mb-6 mt-4">
                            @if ($produit->discount)
                                <span class="text-red-600 text-2xl font-extrabold">
                                    {{ $produit->getDiscundPrice() }}
                                </span>
                                <span
                                    class="text-gray-500 text-xl line-through">{{ $produit->getFormattedPrice() }}</span>
                                <div class="badge badge-lg badge-secondary">
                                    <span class="text-xl font-extrabold mt-1">-{{ $produit->discount }}%</span>
                                </div>
                            @else
                                <span class="text-2xl font-extrabold">{{ $produit->getFormattedPrice() }}</span>
                            @endif
                        </div>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary"
                                onclick="window.location.href = 'produit{{ $produit->id }}'">
                                Détail
                        </div>
                    </div>
                </div>
            @endforeach
        </section>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sort').change(function() {
                let sort = $(this).val();
                let search = $('#search').val();
                $.ajax({
                    url: "{{ route('filterProducts') }}",
                    data: {
                        sort: sort,
                        search: search
                    },
                }).done(function(data) {
                    if ($('section[name="productsGrid"]').html($(data).find(
                            'section[name="productsGrid"]').html()).children().length == 0) {
                        $('section[name="productsGrid"]').html(
                            '<h1 class="text-center text-2xl mt-12">Aucun produit trouvé</h1>');
                    } else {
                        $('section[name="productsGrid"]').fadeOut(250, function() {
                            $('section[name="productsGrid"]').html($(data).find(
                                'section[name="productsGrid"]').html());
                            $('section[name="productsGrid"]').fadeIn(250);
                        });
                    }
                });
            });

            $('#search').keyup(function() {
                let sort = $('#sort').val();
                let search = $(this).val();
                $.ajax({
                    url: "{{ route('filterProducts') }}",
                    data: {
                        sort: sort,
                        search: search
                    },
                }).done(function(data) {
                    if ($('section[name="productsGrid"]').html($(data).find(
                            'section[name="productsGrid"]').html()).children().length == 0) {
                        $('section[name="productsGrid"]').html(
                            '<h1 class="text-center text-2xl mt-12">Aucun produit trouvé</h1>');
                    } else {
                        $('section[name="productsGrid"]').fadeOut(250, function() {
                            $('section[name="productsGrid"]').html($(data).find(
                                'section[name="productsGrid"]').html());
                            $('section[name="productsGrid"]').fadeIn(250);
                        });
                    }
                });
            });
        });
    </script>

</x-layout>
