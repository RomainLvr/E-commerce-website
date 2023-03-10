<x-layout>

    <button class="btn btn-primary ml-6 mt-6" onclick="window.location.href='{{ route('produits') }}'">
        Retour aux produits
    </button>
    <div class="container mx-auto my-12">
        <div class="flex flex-col md:flex-row">
            <div class="mr-6">
                @foreach ($produit->getAllImages() as $image)
                    <img id="preview" class="w-24 h-24 rounded-2xl mb-4"
                        src="{{ asset('storage/images/products/' . $image->image) }}" alt="{{ $image->image }}" />
                @endforeach
            </div>
            <div class="w-full md:w-1/2">
                <img id="fullPreview" class="rounded-2xl w-max"
                    src="{{ asset('storage/images/products/' . $produit->getPrimaryImage()->image) }}"
                    alt="{{ $produit->image }}" />
            </div>
            <div class="w-full md:w-1/2">
                <h1 class="text-4xl font-bold">
                    {{ $produit->name }}
                </h1>
                <div class="flex flex-row gap-2 items-baseline mt-2">

                    <div class="rating rating-half">
                        <input type="radio" name="rating-10" class="rating-hidden border-0 rounded-none" disabled
                            @if ($produit->getRate() == 0) checked @endif />
                        @for ($i = 1; $i <= 10; $i++)
                            @if ($i % 2 != 0)
                                <input type="radio" name="rating-10"
                                    class="bg-orange-400 mask mask-star-2 mask-half-1 border-0 rounded-none checked:bg-none checked:bg-orange-400"
                                    disabled @if ($i / 2 <= $produit->getRate()) checked @endif />
                            @else
                                <input type="radio" name="rating-10"
                                    class="bg-orange-400 mask mask-star-2 mask-half-2 border-0 rounded-none checked:bg-none checked:bg-orange-400"
                                    disabled @if ($i / 2 <= $produit->getRate()) checked @endif />
                            @endif
                        @endfor
                    </div>
                    <span class="text-gray-500 text-xl">{{ $produit->getRatingNumber() }}</span>
                </div>
                <p class="text-xl mt-8 mb-12">{{ $produit->description }}</p>
                <div class="flex items-center gap-6 mb-6 mt-4">
                    @if ($produit->discount)
                        <span class="text-red-600 text-3xl font-extrabold price"
                            id="{{ $produit->price - ($produit->price * $produit->discount) / 100 }}">
                            {{ $produit->getDiscundPrice() }}
                        </span>
                        <span class="text-gray-500 text-xl line-through price"
                            id="{{ $produit->price }}">{{ $produit->getFormattedPrice() }}</span>
                        <div class="badge badge-lg badge-secondary">
                            <span class="text-xl font-extrabold mt-1">-{{ $produit->discount }}%</span>
                        </div>
                    @else
                        <span class="text-3xl font-extrabold mt-2 price"
                            id="{{ $produit->price }}">{{ $produit->getFormattedPrice() }}</span>
                    @endif
                    @if ($produit->stock == 0)
                        <span class="flex flex-row items-center text-xl font-extrabold text-error">
                            <svg xmlns="http://www.w3.org/2000/svg"fill="none" viewBox="0 0 48 48" stroke-width="1.5"
                                stroke="currentColor" class="w-10  h-10 mb-1">
                                <path
                                    d="M27.707 7.70711C28.0975 7.31658 28.0975 6.68342 27.707 6.29289C27.3165 5.90237 26.6833 5.90237 26.2928 6.29289L24.0001 8.58554L21.7075 6.29289C21.317 5.90237 20.6838 5.90237 20.2933 6.29289C19.9027 6.68342 19.9027 7.31658 20.2933 7.70711L22.5859 9.99976L20.2931 12.2925C19.9026 12.683 19.9026 13.3162 20.2931 13.7067C20.6837 14.0973 21.3168 14.0973 21.7074 13.7067L24.0001 11.414L26.2929 13.7067C26.6834 14.0973 27.3166 14.0973 27.7071 13.7067C28.0976 13.3162 28.0976 12.683 27.7071 12.2925L25.4143 9.99976L27.707 7.70711Z" />
                                <path
                                    d="M6.68378 26.4487L10 27.5541V36C10 36.4262 10.2701 36.8056 10.6729 36.945L23.6649 41.4422C23.8636 41.5131 24.086 41.5217 24.3015 41.4535L24.3161 41.4487L24.3313 41.4436L37.3271 36.945C37.7299 36.8056 38 36.4262 38 36V27.5541L41.3162 26.4487C41.6264 26.3453 41.8665 26.0968 41.9591 25.7832C42.0517 25.4697 41.9851 25.1306 41.7809 24.8753L37.7809 19.8753C37.6595 19.7236 37.5003 19.6145 37.3249 19.5542L24.3271 15.055C24.1152 14.9817 23.8848 14.9817 23.6729 15.055L10.6751 19.5543C10.4997 19.6145 10.3405 19.7236 10.2191 19.8753L6.21914 24.8753C6.01489 25.1306 5.94836 25.4697 6.04096 25.7832C6.13356 26.0968 6.3736 26.3453 6.68378 26.4487ZM21.3192 30.5735L23 28.1724V39.0956L12 35.2879V28.2208L20.1838 30.9487C20.6036 31.0886 21.0655 30.936 21.3192 30.5735ZM14.0571 20.5L24 23.9418L33.9429 20.5L24 17.0582L14.0571 20.5ZM26.6808 30.5735L25 28.1724V39.0956L36 35.2879V28.2208L27.8162 30.9487C27.3964 31.0886 26.9345 30.936 26.6808 30.5735ZM11.3399 21.6759L8.67677 25.0048L14.1881 26.8419L20.1086 28.8154L22.4212 25.5117L22.2861 25.465L11.3399 21.6759ZM39.3232 25.0048L36.6601 21.6759L25.5789 25.5117L27.8915 28.8154L39.3232 25.0048Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-xl font-extrabold mt-1">Rupture de stock</p>
                        </span>
                    @endif
                </div>


                @if ($produit->stock != 0)
                    <p>Stock : {{ $produit->stock }} produit(s) restants</p>
                    <hr class="my-6" />
                    <div class="div-quantity">
                        @if ($produit->stock > 1)
                            @if (
                                $produit->stock -
                                    (Cart::session(Auth::user()->id)->get($produit->id)
                                        ? Cart::session(Auth::user()->id)->get($produit->id)->quantity
                                        : 0) >
                                    0)
                                <div class="div-slider flex flex-col w-3/4">
                                    <label class="label">
                                        <span class="label-text">Quantit??</span>
                                    </label>
                                    <input id="qte" type="range" min="1"
                                        max="{{ $produit->stock - (Cart::session(Auth::user()->id)->get($produit->id) ? Cart::session(Auth::user()->id)->get($produit->id)->quantity : 0) }}"
                                        value="1" class="qte-slide range" step="1" />
                                    <div class="slide-indicator w-full flex justify-between text-xs px-2 mb-6">
                                        @for ($i = 1; $i <= $produit->stock - (Cart::session(Auth::user()->id)->get($produit->id) ? Cart::session(Auth::user()->id)->get($produit->id)->quantity : 0); $i++)
                                            <span>{{ $i }}</span>
                                        @endfor
                                    </div>
                                </div>
                            @else
                                <div class="text-red-500 mb-3">Vous avez d??j?? ajout?? le stock maximum de ce produit au
                                    panier</div>
                            @endif
                        @else
                            <input id="qte" type="hidden" value="1" />
                        @endif
                    </div>
                    <button class="btn btn-primary" id="addToCart" @if (
                        $produit->stock -
                            (Cart::session(Auth::user()->id)->get($produit->id)
                                ? Cart::session(Auth::user()->id)->get($produit->id)->quantity
                                : 0) <=
                            0) disabled @endif>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                        Ajouter au panier
                    </button>
                    <button class="btn btn-secondary" href="">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59" />
                        </svg>

                        Acheter en un clic
                    </button>

                    <div class="flex flex-row items-center mt-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                        <span class="ml-2">Paiement s??curis??</span>
                    </div>
                    <div class="flex flex-row items-center mt-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 8.688c0-.864.933-1.405 1.683-.977l7.108 4.062a1.125 1.125 0 010 1.953l-7.108 4.062A1.125 1.125 0 013 16.81V8.688zM12.75 8.688c0-.864.933-1.405 1.683-.977l7.108 4.062a1.125 1.125 0 010 1.953l-7.108 4.062a1.125 1.125 0 01-1.683-.977V8.688z" />
                        </svg>

                        <span class="ml-2">Livraison rapide</span>
                    </div>
                @endif
                <div class="flex flex-row justify-center items-center mt-12">
                    <hr class="border-2 border-gray-200 w-1/2 mx-auto my-4" />
                    <div class="flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="150 150 550 200" fill="currentColor"
                            class="w-36 h-16">
                            <g>
                                <path
                                    d="M306.464,255.549c1.255,3.682-4.721,6.39-5.989,2.7-2.627-7.189-5.342-14.437-8.19-21.521-11.634,7.021-22.776,13.408-35.434,18.976,4.036,6.572,8.219,13.177,12.479,19.733,2.014,3.31-3.535,6.829-5.74,3.63-16.58-24.787-32.7-49.749-48.134-75.28-2.021-3.389,5.411-8.06,7.33-4.632,9.929,17.279,20.272,34.279,30.779,51.194,13.172-5.442,24.465-12.015,36.4-19.267a490.379,490.379,0,0,0-25.316-53.913c-1.888-3.471,5.976-6.986,7.76-3.463C286.147,199.951,296.963,227.455,306.464,255.549Zm41.447-14.306c.929,3.883-5.288,5.637-6.327,1.8-1.764-6.741-3.539-13.564-5.384-20.275a113.253,113.253,0,0,0-27.719,9.03c1.8,6.968,3.861,13.853,6.262,20.695,1.243,3.687-4.783,6.187-6.131,2.548a315.192,315.192,0,0,1-14.647-54.911c-.657-13.345-12.629-34.768,6.266-40.645C331.138,155.49,341.518,218.954,347.911,241.243Zm-13.445-24.428c-3.74-11.9-7.889-23.629-14.385-34.409-2.929-4.972-6.961-14.335-14.019-16.238-9.266-2.535-7.815,7.251-7.307,10.8a367.9,367.9,0,0,0,8.154,48.675A127.584,127.584,0,0,1,334.466,216.815Zm55.221,12.572c-1.972-8.681-3.836-17.48-5.62-26.2-14.5-12.83-29.2-26.071-45.821-37.709,1.948,5.388,26.228,91.856,10.251,75.905-4.594-28.475-10.932-56.57-21.3-83.525-4.112-2.381,1.861-7.383,5.617-4.891A438.347,438.347,0,0,1,381.9,192.6c-3-15.853-5.555-31.78-7.435-47.774-.4-3.823,7.6-4.815,7.892-.981,2.7,28.479,7.725,56.777,13.6,84.844C396.708,232.341,390.548,233.01,389.687,229.387ZM432.568,217.7c-1.886,4.691-29.1,23.246-29.843,13.837-6.7-28.281-9.234-58.638-15.221-87.573a2.657,2.657,0,0,1,1.952-2.87C439.52,131.015,451.35,187.634,432.568,217.7Zm.858-31.454c.182-15.362-9.658-43.992-37.175-40.485q6.27,40.7,11.547,81.5C426.269,222.023,434.8,204.283,433.426,186.241Zm55.156,51.3c-.991,3.657-7.007,2.46-6.116-1.235,6.1-26.119,10.9-52.583,13.276-79.394-33.693,29.36-17.427,20.867-44.764-6.179-2.5,26.784-4.189,53.63-5.311,80.5-.258,3.786-6.268,3.453-6.213-.337.679-29.363,1.889-58.714,4.229-87.915,5.6-11.485,26.3,19.737,29.535,24.371,5.535-3.441,27.775-30.97,31.109-18.081C501.687,179.2,495.847,208.571,488.582,237.539Zm40.384,11.416c-1.468,3.7-7.585,1.557-6.224-2.2,2.421-6.527,4.889-13.136,7.231-19.688a112.7,112.7,0,0,0-27.722-8.606c-2.52,6.736-4.779,13.554-6.743,20.541-1.1,3.717-7.379,2.309-6.387-1.446a318.315,318.315,0,0,1,19.469-53.37c7.089-11.257,9.544-35.714,28.3-29.641C564.416,169.176,536.547,227.03,528.966,248.955Zm3-27.748c3.768-11.889,7.1-23.888,7.977-36.449.455-5.752,2.53-15.749-2.137-21.374-6.1-7.4-10.5,1.426-12.126,4.621a368.034,368.034,0,0,0-21.194,44.524A126.626,126.626,0,0,1,531.968,221.207Zm37.081,30.981c-3.8,3.319-36.791,7.878-33.426-.909,6.2-28.383,17.121-56.839,24.264-85.509.337-1.3,1.651-1.823,3.029-1.717C612.862,177.113,599.8,233.435,569.049,252.188Zm14.506-27.9c6.883-13.713,10.222-43.973-16.469-53.03q-12.006,39.4-24.961,78.425C561.122,253.188,576.9,241.318,583.555,224.289Zm34.718-28.157c-11.379,14.983-18.629,32.393-27.022,49.091a65.643,65.643,0,0,0,9.015,5.192c4.254,1.9,2.72,7.823-1.382,5.881a66.413,66.413,0,0,1-10.383-5.844c-2.522,4.93-5.529,9.73-8.327,14.445-1.048,1.816-2.113,2.4-.91,4.1,1.91,2.532,8.137,4.792,10.869,6.233,3.769,2,.443,6.992-3.231,5.06-4.618-2.5-15.627-6.418-15.249-12.89,14.091-25.066,23.9-53.624,40.89-77.444,1.384-1.315,2.976-1.374,5-.713A107.865,107.865,0,0,1,639.9,202.607c4.308,3.413.946,8.388-3.262,5.028A95.9,95.9,0,0,0,618.273,196.132Z" />
                                <g>
                                    <path
                                        d="M333.852,271.294c-12.4-1.783-10.371,25.879-.472,28.986,3.027,2.707-.9,8.951-1.236,12.589a20.053,20.053,0,0,1-2.567,5.628c-6.316-5.964-5.867-16.229-7.028-24.319-.008-3.371-5.533-6.446-6.461-2.572-.942,9.546-2.715,19.752-7.984,27.655-3.975-10.759-1.229-22.681,3.231-32.9.571-1.528.478-2.1-.854-2.953-4.5-2.879-9.44-1.782-10.166,4.006-2.268,11.491-6.539,26.374,2,36.237,8.149,7.093,10.929-7.269,13.68-12.4.773,9.462,13.627,20.215,20.337,9.542C343.568,308.075,348,280.275,333.852,271.294Zm1.049,27.468c-12.559-6.931-1.735-41.771.854-13.352A81.172,81.172,0,0,1,334.9,298.762Zm12.277-36.144c-2.071-6.724,4.469-5.618,6.745-1.044.723-2.608,4.916-6.249,6.081-1.91.274,2.6-3.855,10.322-6.837,9.347C350.507,267.3,348.32,265.478,347.178,262.618Zm78.7,58.451c-1.469-11.069,2.561-23.241-1.424-34.233-12.765-18.484-19.8,14.475-22.327,23.844a1.063,1.063,0,0,1-.479-.093c.376-5.312-2.946-11.962-.091-16.595,6.937-7.333,14.793-28.287,3.037-34.049-6.108-.46-9.888,4.209-12.14,11.238-2.676-4.56-9.815-2.983-14.288-3.316-1.518.093-1.137-4.007-.947-5.442.283-3.522-.1-2,.664-5.619.1-4.634-7.121-4.861-10.455-3.82-3.134,3.405-1.438,9.236-2.561,13.735-.1,1.91.191,2-2.094,2.1-2.947.97-10.247-.556-10.828,3.057,1.417,7.1,6.611,2.75,11.307,2.479,1.235-.289,1.328-.1,1.326,1.239-1.659,13.985,3.544,33.109-7.513,43.486-2.695-11.267.937-23.655.761-35.193.226-3.027-4.226-2.551-6.369-2.665-2.752.186-3.611.95-3.893,3.9a205.161,205.161,0,0,0-.853,24.888c-1.648,15.469,13.7,23.929,17.682,5.056,2.668,20.588,19.623,14.426,25.954-1.435.362,3.894.779,7.195,1.137,9.349.282,3.026,9.844,10.6,11.876,4.677,2.845-11.9,4.186-32.67,12.734-40.625.809,12.025-6.247,27.668,2.371,37.765,5.095,4.144,11.6.567,13.4-5.059,1.249-4.466,6.26-11.836,3.609-15.831C431.156,308.092,431.507,317.437,425.874,321.069ZM375.5,318.115c-.869-15.1.134-29.105.664-44.054,0-.95.381-1.435,1.332-1.435a65.263,65.263,0,0,1,14.616-.21c-2.776,9.711-2.934,23.29-2.289,34.371C386.731,312.456,377.648,330.268,375.5,318.115Zm30.135-54.639c3.6,9.1.794,20.458-5.418,27.655C399.414,287.168,399.634,259.105,405.637,263.476Z" />
                                    <path
                                        d="M479.11,319.55a1.148,1.148,0,0,1-.283,1.715c-3.04,1.807-5.417,4.482-8.745,6.01-25.911,8.5-13.95-49.643-16.056-63.995-.462-5.308,11.875-3.231,10.737,1.435-1.378,17.31-1.526,34.646-1.328,51.975.871,7.872,9.524,6.606,14.25,3.045C478.159,319.448,478.637,318.879,479.11,319.55Zm56.849-46.16c2,6.373-.617,13.139-.665,19.651-1.873,9.4-2.74,43.111-18.525,29.753-3.2-4.737-4.741-10.209-5.572-15.9-2.791.576-6.093-.288-6.037,3.5-2.933,26.733-27.116,18.442-23.562-4.761.564-3.952,1.214-5.356,5.32-5.917a25.329,25.329,0,0,1,1.043-20.6c4.927-7.119,15.311-.3,16.534,6.588a51.52,51.52,0,0,1,1.426,17.825c.158,2.09,3.55.42,4.885.515.672-7.509-6.193-28.05,7.579-21.965a3.321,3.321,0,0,1,2.181,3.14c.827,10.779-.564,22.584,4.372,32.426a10.781,10.781,0,0,0,1.518-4.1c.286-5.232,4.815-12.052,2.188-16.6-3.706-2.189-5.038-5.628-5.038-9.914C522.721,280.685,528.75,263.486,535.959,273.39Zm-38.022,34.718c-.346-1.721-3.286-1.175-4.748-2.106a35.93,35.93,0,0,0-.664,8.964C493.49,327.465,497.877,312.341,497.937,308.108Zm-3.231-25.847c-4.733,6.623-3.944,17.028,3.519,21.17C499.743,298.091,498.7,285.7,494.706,282.261Zm34.981-8.014c0,.1-.093.1-.093.2-2.82,6.152-4.352,14.877.473,20.406a2.93,2.93,0,0,0,.669-1.91C531.41,290.21,535.337,266.876,529.687,274.247Zm27.947,35.1c2.8,3.238-.653,9.941-1.9,13.725a5.411,5.411,0,0,1-5.13,3.345c-17.683-.447-13.895-27.559-9.5-38.817,3.692-8.2,18.06-6.851,18.244,3.242.387,7.124-2.6,15.63-9.785,18.123-2.35,2.545-.429,9.572.663,13.25a7.552,7.552,0,0,0,3.133-3.624C555.41,316.217,554.219,309.639,557.634,309.347Zm-8.642-3.531c4.881-4.317,6.03-12.019,3.7-17.927-.381-.951-.854-.951-1.425-.094C548.347,293.1,549.2,299.957,548.992,305.816Z" />
                                </g>
                                <g>
                                    <path
                                        d="M627.955,289.744c3.446-14.883-13.631-20.9-19.012-9.935-4.817,9.819,4.853,31.695,4.853,31.695s23.845.092,30.865-8.282C652.5,293.867,640.147,280.594,627.955,289.744Z" />
                                    <path
                                        d="M228.645,289.744c-3.446-14.883,13.631-20.9,19.012-9.935,4.817,9.819-4.853,31.695-4.853,31.695s-23.845.092-30.865-8.282C204.1,293.867,216.453,280.594,228.645,289.744Z" />
                                </g>
                            </g>
                        </svg>

                        <span class="">100% fait main</span>
                    </div>
                    <hr class="border-2 border-gray-200 w-1/2 mx-auto my-4">
                </div>
                <div class="w-full mt-12 md:w-1/2">
                    <h1 class="text-2xl font-bold">
                        Mat??riaux
                    </h1>
                    <ul class="list-disc text-xl ml-5 mb-12">
                        @foreach ($produit->getMaterials() as $material)
                            <li class="flex flex-row items-center mb-3">
                                <p class="text-xl">{{ $material->name }}</p>
                                <div class="tooltip ml-2 mb-1" data-tip="{{ $material->description }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" class=" w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <h1 class="text-2xl font-bold">
                        Dimensions
                    </h1>
                    <p class="text-xl mb -12">{{ $produit->dimensions }}</p>
                </div>

                <input type="checkbox" id="my-modal-4" class="modal-toggle" />
                <label for="my-modal-4" class="modal cursor-pointer">
                    <div class="modal-box">
                        <img id="modalImage" id="fullPreview" class="rounded-2xl w-max" for="my-modal-4"
                            src="">
                    </div>
                </label>


            </div>
        </div>
    </div>

    <script>
        const previews = document.querySelectorAll('#preview');
        const fullPreview = document.querySelector('#fullPreview');

        fullPreview.classList.add('transition-opacity');

        previews.forEach((preview) => {
            preview.addEventListener('click', () => {
                previews.forEach((preview) => {
                    preview.classList.remove('border-2', 'border-primary', 'opacity-60');
                });
                preview.classList.add('border-2', 'border-primary', 'opacity-60');
                fullPreview.classList.add('opacity-0');
                setTimeout(() => {
                    fullPreview.src = preview.src;
                    fullPreview.classList.remove('opacity-0');
                }, 200);
            });
        });

        fullPreview.addEventListener('click', () => {
            document.querySelector('#modalImage').src = fullPreview.src;
            document.querySelector('#my-modal-4').checked = true;
        });

        @if ($produit->stock > 1)

            document.getElementById('qte').addEventListener('change', function() {
                var prices = document.querySelectorAll('.price');

                prices.forEach((price) => {
                    price.classList.add('transition-opacity');
                    price.classList.add('opacity-0');
                    setTimeout(() => {
                        price.innerHTML = (price.id * this.value).toFixed(2) + ' ???';
                        price.classList.remove('opacity-0');
                    }, 200);
                });
            });
        @endif

        $(document).ready(function() {
            $('#addToCart').click(function() {
                var qte = $('#qte').val();
                $.ajax({
                    url: "{{ route('addToCart') }}",
                    data: {
                        productId: {{ $produit->id }},
                        userId: @if (Auth::check())
                            {{ Auth::user()->id }}
                        @else
                            "guest"
                        @endif ,
                        qte: qte
                    },
                    success: function(data) {
                        $('#cartCountIndicator').html(data.count);
                        $('#cartTotal').html(data.total + ' ???');
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
                                                            ${price}???
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                `
                            )
                        });
                        console.log(data.productStock - data.productQuantity);
                        if (data.productStock - data.productQuantity == 0) {
                            $('.div-quantity').append(`<div class="text-red-500 mb-3">Vous avez d??j?? ajout?? le stock maximum de ce produit au
                                panier</div>`);
                            $('.div-slider').remove();
                            $('#addToCart').prop('disabled', true);
                        }
                        if (data.productStock - data.productQuantity == 1) {
                            $('.div-quantity').append(
                            `<input id="qte" type="hidden" value="1" />`);
                            $('.div-slider').remove();
                        }
                        $('.qte-slide').attr('max', data.productStock - data.productQuantity);
                        $('.slide-indicator').children("span").remove();
                        for (var i = 1; i <= data.productStock - data.productQuantity; i++) {
                            $('.slide-indicator').append(`<span>${i}</span>`);
                        }
                    }
                });
            });
        });
    </script>


</x-layout>
