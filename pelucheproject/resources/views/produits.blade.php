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
                    <figure class="max-w-xl min-w-fit"><img class="max-w-md"
                            src="{{ asset('storage/images/' . $produit->image) }}" alt="{{ $produit->image }}"
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
        //if $sort or $search is set, we send an ajax request to filterProducts
        //and we replace the productsGrid section with the new one
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
                    $('section[name="productsGrid"]').fadeOut(250, function() {
                        $('section[name="productsGrid"]').html($(data).find(
                            'section[name="productsGrid"]').html());
                        $('section[name="productsGrid"]').fadeIn(250);
                    });
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
                    $('section[name="productsGrid"]').fadeOut(250, function() {
                        $('section[name="productsGrid"]').html($(data).find(
                            'section[name="productsGrid"]').html());
                        $('section[name="productsGrid"]').fadeIn(250);
                    });
                });
            });
        });
    </script>

</x-layout>
