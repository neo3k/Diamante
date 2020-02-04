<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
    <div id="app">
        <nav class="bg-blue-900 shadow mb-8 py-6">
            <div class="container mx-auto px-6 md:px-0">
                <div class="flex items-center justify-center">
                    <div class="mr-6">
                        <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                            <img src="data:image/png;base64,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">
                        </a>
                    </div>
                    <div class="flex-1 text-right">
                        @guest
                            <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <span class="text-gray-300 text-sm pr-4">{{ Auth::user()->name }}</span>

                            <a href="{{ route('logout') }}"
                               class="no-underline hover:underline text-gray-300 text-sm p-3"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
