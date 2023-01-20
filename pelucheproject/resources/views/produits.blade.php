<x-layout>
    <div class="py-8">
        <div class="container mx-auto">
            <div class="flex flex-wrap -mx-4">
                <select id="sort" class="select select-primary w-full max-w-xs">
                    <option disabled selected>Trier par</option>
                    <option value="priceAsc">Prix croissant</option>
                    <option value="priceDesc">Prix décroissant</option>
                    <option value="nameAsc">Nom A-Z</option>
                    <option value="nameDesc">Nom Z-A</option>
                </select>
                <div class="w-1/2 px-4 flex justify-end">
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
                    <figure><img src="{{ asset('storage/images/' . $produit->image) }}" alt="{{ $produit->image }}"
                            alt="{{ $produit->image }}" /></figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $produit->name }}
                            @if ($produit->isNew())
                                <span class="badge badge-primary">New</span>
                            @endif
                        </h2>
                        <p>{{ $produit->getFormattedPrice() }}</p>
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
                var sort = $(this).val();

                $.ajax({
                    url: "{{ route('sortProducts') }}",
                    data: {
                        sort: sort
                    },
                }).done(function(data) {
                    $('section[name="productsGrid"]').html($(data).find(
                        'section[name="productsGrid"]').html());
                });
            });
        });
        $(document).ready(function() {
            $('#search').keyup(function() {
                var search = $(this).val();

                $.ajax({
                    url: "{{ route('searchProducts') }}",
                    data: {
                        search: search
                    },
                }).done(function(data) {
                    $('section[name="productsGrid"]').html($(data).find(
                        'section[name="productsGrid"]').html());
                });
            });
        });
    </script>

</x-layout>
