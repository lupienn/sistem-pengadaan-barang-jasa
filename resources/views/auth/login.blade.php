<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'Procurement System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest" onload="lucide.createIcons()"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Left Panel (Branding) -->
        <div class="hidden lg:flex w-1/2 items-center justify-center bg-gradient-to-br from-blue-700 to-blue-400 p-12 text-white relative">
            <div class="text-center">
                <div class="bg-white/10 p-8 rounded-2xl backdrop-blur-sm border border-white/20">
                    <i data-lucide="shopping-bag" class="w-24 h-24 mx-auto mb-6 text-blue-200"></i>
                    <h1 class="text-4xl font-bold mb-2">Digitalisasi Pengadaan</h1>
                    <p class="text-lg text-blue-100">Sistem Manajemen & Monitoring Pengadaan Barang dan Jasa</p>
                </div>
            </div>
        </div>

        <!-- Right Panel (Form) -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-md">
                <div class="text-center lg:text-left mb-10">
                    <h2 class="text-3xl font-bold text-gray-800">Selamat Datang</h2>
                    <p class="text-gray-600">Silakan masuk untuk melanjutkan ke dashboard</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Login Field -->
                    <div>
                        <label for="login" class="block text-sm font-medium text-gray-700">Username</label>
                        <div class="mt-1 relative">
                             <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i data-lucide="user" class="w-5 h-5 text-gray-400"></i>
                            </span>
                            <input id="login" name="login" type="text" value="{{ old('login') }}" required autofocus
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200"
                                   placeholder="Masukkan username Anda">
                        </div>
                        <x-input-error :messages="$errors->get('login')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1 relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                            </span>
                            <input id="password" name="password" type="password" required autocomplete="current-password"
                                   class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-200"
                                   placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">Ingat saya</label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 shadow-lg">
                            MASUK KE SISTEM
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
