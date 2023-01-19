<x-layout>
    <div class="py-8">
        <div class="container mx-auto">
            <div class="flex flex-wrap -mx-4">
                <div class="w-1/2 px-4">
                    <h1 class="text-3xl font-medium">Produits</h1>
                </div>
                <div class="w-1/2 px-4 flex justify-end">
                    <div class="flex flex-row justify-center relative">
                        <input type="text" placeholder="Rechercher" class="input input-bordered input-primary w-full max-w-xs" />
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
        <div class="container mx-10 py-8">
            <section class="flex flex-wrap justify-center gap-10 -mx-4">
                @foreach ($produits as $produit)
                    <div class="card w-96 bg-base-100 shadow-xl hover:scale-105 transition-transform">
                        <figure><img src="{{ asset('storage/images/' . $produit->image) }}" alt="{{ $produit->image }}" alt="{{ $produit->image }}" /></figure>
                        <div class="card-body">
                            <h2 class="card-title">{{ $produit->name }}
                                @if($produit->isNew())
                                    <span class="badge badge-primary">New</span>
                                @endif
                            </h2>
                            <p>{{ $produit->getFormattedPrice() }}</p>
                            <div class="card-actions justify-end">
                                <button class="btn btn-primary" href="produit{{ $produit->id }}">Détail</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
        </div>
    </div>
</x-layout>
