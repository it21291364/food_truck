<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>The Orange Bay</title>

    <!-- Fonts & Vite (Breeze / Laravel) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
      <!-- Fallback inline CSS (Tailwind) if needed -->
      <style>
        /* Insert your compiled tailwind styles if necessary */
      </style>
    @endif
  </head>

  <!-- 
    Main Body:
    - Full screen, flex-col so the footer can stay at bottom
    - Background with "cover" & "center"
    - Additional gradient overlay via a pseudo-element or extra <div>
  -->
  <body
    class="relative min-h-screen flex flex-col bg-center bg-cover dark:bg-black"
    style="background-image: url('{{ asset('images/bg.jpeg') }}');"
  >
    <!-- GRADIENT OVERLAY -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/20 to-black/60"></div>

    <!-- HEADER -->
    <header
      class="relative z-10 w-full px-6 py-3 
                 flex items-center justify-between
                 bg-black/70 text-white shadow-sm"
    >
      <!-- Left: Logo + Name -->
      <div class="flex items-center space-x-3">
        <img
          src="/images/orange.png"
          alt="Orange Bay Logo"
          class="h-10 w-10 object-contain"
        />
        <span class="font-bold text-xl tracking-wide uppercase">
          The Orange Bay
        </span>
      </div>

      <!-- Right: Auth Buttons -->
      @if (Route::has('login'))
        <nav class="space-x-4">
          @auth
            <!-- (Omit the dashboard link if desired) -->
          @else
            <a
              href="{{ route('login') }}"
              class="inline-block px-5 py-2 bg-orange-500 text-white 
                     font-semibold rounded 
                     hover:bg-orange-600 transition-colors"
            >
              Log in
            </a>
            @if (Route::has('register'))
              <a
                href="{{ route('register') }}"
                class="inline-block px-5 py-2 bg-transparent border-2 border-orange-500 
                       text-orange-500 font-semibold rounded 
                       hover:bg-orange-500 hover:text-white 
                       transition-colors"
              >
                Register
              </a>
            @endif
          @endauth
        </nav>
      @endif
    </header>

    <!-- MAIN CONTENT -->
    <main class="relative z-10 flex-grow flex items-center justify-center p-6">
      <!-- Example Hero Box -->

    </main>

    <!-- FOOTER -->
    <footer
      class="relative z-10 w-full flex items-center justify-center 
                 bg-black/70 text-gray-300 text-xs py-3"
    >
      <span class="mr-2">Copyright 2025 © DevLuke. All Rights Reserved.</span>
      <img
        src="/images/ftttt.png"
        alt="DevLuke Logo"
        class="h-5 w-auto"
      />
    </footer>
  </body>
</html>
