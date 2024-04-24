<nav class="-mx-3 flex justify-center gap-2 align-center">
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="text-black"
        >
            Dashboard
        </a>
    @else
<div class="flex gap-2 align-center justify-center">
    <a
        href="{{ route('login') }}"
        class="text-black rounded-md px-3 py-2 flex items-center gap-2"
    >
        Log in
    </a>

    @if (Route::has('register'))
        <a
            href="{{ route('register') }}"
            class=" text-black rounded-md px-3 py-2 flex items-center gap-2"
        >
            Register
        </a>
    @endif
</div>
    @endauth
</nav>
