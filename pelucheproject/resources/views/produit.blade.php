<x-layout>
    <div class="bg-gray-100 py-8">
        <div class="container mx-auto">
            <div class="flex flex-wrap -mx-4">
                <div class="w-1/2 px-4">
                    <h1 class="text-3xl font-medium">{{ $produit->name }}</h1>
                </div>
                <div class="w-1/2 px-4 flex justify-end">
                    <div class="relative">
                        <input type="text"
                            class="bg-white border-2 border-gray-300 rounded-lg pl-4 pr-10 py-2 focus:outline-none focus:border-indigo-500"
                            placeholder="Rechercher">
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
        <div class="container mx-auto py-8">
            <section class="flex flex-wrap -mx-4">
                <div class="w-1/4 px-4 mb-8">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:scale-105 transition-transform"
                        onclick="window.location.href = ' produit{{ $produit->id }}'">
                        <img class="h-auto w-full object-cover object-center"
                            src="{{ asset('storage/images/' . $produit->image) }}" alt="{{ $produit->image }}" />
                        <div class="p-4">
                            <h1 class="text-lg font-medium text-gray-800">{{ $produit->name }}</h1>
                            <span class="text-gray-700">{{ $produit->price }} €</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
</x-layout>
