<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="min-h-screen font-sans antialiased bg-base-200">

    {{-- CSRF token debug --}}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    {{-- NAVBAR --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <x-app-brand />
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden me-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main>
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">
            <x-app-brand class="px-5 pt-4" />
            <x-menu activate-by-route>
                @if($user = auth()->user())
                    <x-menu-separator />

                    <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
                        <x-slot:actions>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-ghost btn-xs" title="Log Out">
                                    <x-icon name="o-power" />
                                </button>
                            </form>
                        </x-slot:actions>
                    </x-list-item>

                    <x-menu-separator />

                    <x-menu-item title="Page d'accueil" icon="o-home" link="/user-dashboard" />
                    <x-menu-item title="Suivi en temps réel" icon="o-document" link="/sensor" />
                    <x-menu-sub title="Graphique" icon="o-arrow-trending-up">
                        <x-menu-item title="Température et humidité" icon="o-archive-box" link="/grafik-monitoring" />
                        <x-menu-item title="Statistique" icon="o-document" link="/grafik/stat" />
                    </x-menu-sub>
                    <x-menu-sub title="Paramètres" icon="o-cog-6-tooth">
                        <x-menu-item title="Themè" icon="o-cog-6-tooth" link="####" />
                        <x-menu-item title="Langue" icon="o-document" link="####" />
                    </x-menu-sub>
                @endif
            </x-menu>
        </x-slot:sidebar>

        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    <x-toast />
</body>
</html>