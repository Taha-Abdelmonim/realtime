<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
</head>
  <body class="overflow-y-clip">
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class=" navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar collapse ahmed@ahmed.com -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

                        @guest

                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

  <script>
    // Pusher.logToConsole = true;
    var pusher = new Pusher('ab2ea8a05cc44bce43fb', {
      cluster: 'mt1',
      // encrypted: true
    });
    @if(auth()->user())
      var channel = pusher.subscribe('new-message-user');
      channel.bind('App\\Events\\NewMessage', function (data) {
        let chat = data.chat.original;
        let div = `
          <div class="flex justify-end mb-2">
          <div class="rounded py-2 px-3" style="background-color: #E2F7CB">
            <p class="text-sm mt-1">
              ${chat.message}
            </p>
            <p class="text-right text-xs text-grey-dark mt-1">
               ${new Date(chat.created_at).toLocaleTimeString([], { timeStyle: "medium" })}
            </p>
          </div>
        </div>
  `
        if (chat.received_user_id == {{ auth()->user()->id }}) {
          div = `
            <div class="flex mb-2">
              <div class="rounded py-2 px-3" style="background-color: #F2F2F2">
              <p class="text-sm text-purple">
                ${chat.message}
              </p>
              <p class="text-right text-xs text-grey-dark mt-1">
                ${new Date(chat.created_at).toLocaleTimeString([], { timeStyle: "medium" })}
              </p>
        </div>
      </div>
  `
        }
        $("#wrapper-new-message").append(div)
      @endif
    });
  </script>
  @yield("script")
  </body>
</html>
