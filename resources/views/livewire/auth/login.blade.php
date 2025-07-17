@extends('layouts.app')

@section('content')
<div class="gradient-secondary min-h-screen flex items-center justify-center">
    <div class="w-full max-w-xl">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 pixel-border pixel-shadow-lg">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-20">
            </div>
            <div class="flex justify-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Login</h2>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email Address
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pixel-border-light focus:ring-2 focus:ring-pink-600 focus:outline-none text-gray-900 @error('email') border-red-500 @enderror"
                        id="email" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required
                        autocomplete="email" autofocus>
                    @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline pixel-border-light focus:ring-2 focus:ring-pink-600 focus:outline-none text-gray-900 @error('password') border-red-500 @enderror"
                        id="password" type="password" placeholder="Password" name="password" required
                        autocomplete="current-password">
                    @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2 leading-tight text-pink-600" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="text-sm text-gray-700">
                            Remember Me
                        </span>
                    </label>
                    @if (Route::has('password.request'))
                    <a class="inline-block align-baseline font-bold text-sm text-cyan-600 hover:text-cyan-800"
                        href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                    @endif
                </div>

                <div class="flex items-center justify-between">
                    <button
                        class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline pixel-shadow"
                        type="submit">
                        Sign In
                    </button>
                    @if (Route::has('register'))
                    <a class="inline-block align-baseline font-bold text-sm text-cyan-600 hover:text-cyan-800"
                        href="{{ route('register') }}">
                        Sign up
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
