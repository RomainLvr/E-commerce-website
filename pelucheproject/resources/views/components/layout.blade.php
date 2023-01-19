@php
    $themeList = ["light", "dark", "cupcake", "bumblebee", "emerald", "corporate", "synthwave", "retro", "cyberpunk", "valentine", "halloween", "garden", "forest", "aqua", "lofi", "pastel", "fantasy", "wireframe", "black", "luxury", "dracula", "cmyk", "autumn", "business", "acid", "lemonade", "night", "coffee", "winter"];
    $session = session();
    $views = File::allFiles(resource_path('views'));
    $excludedViews = ['layout', 'produit']; 
@endphp

<!doctype html>
<html data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>E-commerce</title>
</head>

<body>



    <div class="drawer font-mono">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Page content here -->

            <div class="navbar py-5 bg-neutral">
                <div class="navbar-start ml-5">

                    <label for="my-drawer" class="btn btn-primary drawer-button"><svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7" />
                        </svg>Menu</label>

                </div>
                <div class="navbar-center">
                    <a class="btn btn-ghost normal-case text-xl" href="accueil.phtml"><img class="h-12"
                            src=""></a>
                </div>
                <div class="navbar-end mr-5">
                    <div title="Change Theme" class="dropdown dropdown-end ">
                        <div tabindex="0" class="btn gap-1 normal-case btn-ghost" spellcheck="false"><svg
                                width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" class="inline-block h-5 w-5 stroke-current md:h-6 md:w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                                </path>
                            </svg> <span class="md:inline">Theme</span> <svg width="12px" height="12px"
                                class="ml-1 h-3 w-3 fill-current opacity-60 sm:inline-block"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2048 2048">
                                <path d="M1799 349l242 241-1017 1017L7 590l242-241 775 775 775-775z"></path>
                            </svg>
                        </div>
                        <div
                            class="dropdown-content bg-base-200 text-base-content rounded-t-box rounded-b-box top-px max-h-96 h-[70vh] w-52 overflow-y-auto shadow-2xl mt-16">
                            <div class="grid grid-cols-1 gap-3 p-3" tabindex="0" spellcheck="false">
                                <label class="label">
                                    <span class="label-text">Theme</span>
                                </label>



                                @foreach ($themeList as $value)
                                    <div class="outline-base-content overflow-hidden rounded-lg outline-2 outline-offset-2 post-name
                                    @if (
                                        ($session->has('themeSet') && $session->get('themeSet') == $value) ||
                                            ($session->missing('themeSet') && $value == 'light')) outline @endif
                                    "
                                        data-name="{{ $value }}">
                                        <div data-theme="{{ $value }}"
                                            class="bg-base-100 text-base-content w-full cursor-pointer font-sans">
                                            <div class="grid grid-cols-5 grid-rows-3">
                                                <div class="col-span-5 row-span-3 row-start-1 flex gap-1 py-3 px-4">
                                                    <div class="flex-grow text-sm font-bold">{{ ucfirst($value) }}</div>
                                                    <div class="flex flex-shrink-0 flex-wrap gap-1">
                                                        <div class="bg-primary w-2 rounded"></div>
                                                        <div class="bg-secondary w-2 rounded"></div>
                                                        <div class="bg-accent w-2 rounded"></div>
                                                        <div class="bg-neutral w-2 rounded"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('.post-name').click(function() {
                                var name = $(this).data('name');

                                document.getElementsByTagName("html")[0].setAttribute("data-theme", name);
                                $('.post-name').removeClass('outline');
                                $(this).addClass('outline');
                                $.ajax({
                                    url: "{{ route('setTheme') }}",
                                    data: {
                                        themeSet: name
                                    }
                                });
                            });
                        });
                    </script>

                    @if ($session->has('themeSet'))
                        <script>
                            document.getElementsByTagName("html")[0].setAttribute("data-theme", "{{ $session->get('themeSet') }}");
                        </script>
                    @endif

                    </form>
                    <div class="dropdown dropdown-end">
                        <div tabindex="0"
                            class="btn btn-ghost btn-circle avatar  @if ($session->has('userId')) online;
                                                                                    @else
                                                                                    offline @endif">
                            <div class="w-10 rounded-full">
                                <img
                                    src="@if ($session->has('userId')) {{ $session->get('userAvatar') }}
                                    @else
                                    https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png?20200919003010 @endif 
                                " />
                            </div>
                        </div>
                        <ul tabindex="0"
                            class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                @if ($session->has('userId'))
                                    <p class='justify-between'>
                                        Profil
                                    @else
                                    <p class='justify-between'>
                                        Profil
                                @endif

                                <span class="badge">
                                    @if (isset($_SESSION['userId']))
                                        {{ $_SESSION['initiatorName'] }}
                                    @else
                                        Visiteur
                                    @endif
                                </span>
                                </a>
                            </li>
                            <li>
                                @if (isset($_SESSION['userId']))
                                    <a href="">Déconnexion</a>
                                @else
                                    <a href="">Connexion</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <main>
                {{ $slot }}
            </main>

            <footer class="footer footer-center p-10 bg-primary text-primary-content bottom-0 w-full mt-20">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5" />
                    </svg>
                    <p class="font-bold">
                        Name
                    </p>
                    <p>Copyright © 2023 - All right reserved</p>
                </div>
                <div>
                    <div class="grid grid-flow-col gap-4">
                        <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                class="fill-current">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z">
                                </path>
                            </svg></a>
                        <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                class="fill-current">
                                <path
                                    d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z">
                                </path>
                            </svg></a>
                        <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                class="fill-current">
                                <path
                                    d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z">
                                </path>
                            </svg></a>
                    </div>
                </div>
            </footer>

        </div>

        <div class="drawer-side">
            <label for="my-drawer" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 bg-base-100 text-base-content">

                @foreach ($views as $view)
                @if ( in_array(str_replace('.blade.php', '', $view->getFilename()), $excludedViews))
                @continue
                @endif
                    <li>
                        <a href="{{ str_replace('.blade.php', '', $view->getFilename()) }}" class="justify-center font-extrabold text-xl">
                            {{ strtoupper(str_replace('.blade.php', '', $view->getFilename())) }}
                        </a>
                    </li>
                @endforeach


            </ul>
        </div>
    </div>

</body>

</html>
