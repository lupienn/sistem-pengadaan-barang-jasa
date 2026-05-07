<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk - Sistem Pengadaan Barang dan Jasa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest" onload="lucide.createIcons()"></script>
</head>
<body class="bg-gray-50 lg:bg-white font-sans antialiased text-gray-900">
    <div class="flex min-h-screen">
        <!-- Left Panel (Branding - Desktop) -->
        <div class="hidden lg:flex w-1/2 items-center justify-center bg-gradient-to-br from-blue-700 to-blue-500 p-12 text-white relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-blue-900/20 rounded-full blur-3xl"></div>
            
            <div class="text-center relative z-10">
                <div class="bg-white/10 p-10 rounded-3xl backdrop-blur-md border border-white/20 shadow-2xl">
                    <div class="bg-white/20 w-24 h-24 rounded-2xl flex items-center justify-center mx-auto mb-8 shadow-inner border border-white/30">
                        <i data-lucide="shopping-bag" class="w-12 h-12 text-white"></i>
                    </div>
                    <h1 class="text-4xl font-extrabold mb-3 tracking-tight">Digitalisasi Pengadaan</h1>
                    <p class="text-lg text-blue-100 font-medium">Sistem Monitoring Pengadaan Barang & Jasa</p>
                </div>
            </div>
        </div>

        <!-- Right Panel (Form) -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-4 sm:p-8 relative bg-gray-50 lg:bg-transparent min-h-screen">
            
            <!-- Mobile Header Background -->
            <div class="absolute top-0 left-0 right-0 h-72 bg-gradient-to-br from-blue-700 to-blue-500 rounded-b-[2.5rem] lg:hidden z-0 shadow-lg"></div>

            <div class="w-full max-w-md relative z-10 mt-6 lg:mt-0">
                
                <!-- Mobile Branding -->
                <div class="lg:hidden text-center mb-8 text-white px-4">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-md mb-4 shadow-inner border border-white/20">
                        <i data-lucide="shopping-bag" class="w-8 h-8 text-white"></i>
                    </div>
                    <h1 class="text-2xl font-extrabold tracking-tight mb-1 leading-tight">Monitoring Pengadaan Barang & Jasa</h1>
                    <p class="text-blue-100 text-sm font-medium mt-2">Masuk untuk melanjutkan</p>
                </div>

                <!-- Form Card -->
                <div class="bg-white lg:bg-transparent p-8 sm:p-10 lg:p-0 rounded-3xl lg:rounded-none shadow-2xl lg:shadow-none border border-gray-100 lg:border-none">
                    
                    <div class="hidden lg:block mb-10">
                        <div class="flex items-center mb-4">
                            <div class="w-14 h-14 rounded-2xl bg-blue-600 flex items-center justify-center text-white mr-4 shadow-lg shadow-blue-600/30">
                                <i data-lucide="shopping-bag" class="w-7 h-7"></i>
                            </div>
                            <div>
                                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Selamat Datang</h2>
                                <p class="text-sm text-blue-600 font-bold mt-1">Monitoring Pengadaan Barang & Jasa</p>
                            </div>
                        </div>
                        <p class="text-gray-500 font-medium">Silakan masuk menggunakan kredensial Anda.</p>
                    </div>

                    <!-- Mobile Heading inside card -->
                    <div class="lg:hidden mb-8 text-center">
                        <h2 class="text-xl font-extrabold text-gray-900 tracking-tight">Selamat Datang</h2>
                        <p class="text-sm text-gray-500 mt-1 font-medium">Silakan masuk menggunakan kredensial Anda.</p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-6" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Login Field -->
                        <div class="space-y-1.5">
                            <label for="login" class="block text-sm font-bold text-gray-700">Username</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i data-lucide="user" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input id="login" name="login" type="text" value="{{ old('login') }}" required autofocus
                                       class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 sm:text-sm transition-all text-gray-900 font-medium"
                                       placeholder="Ketik username Anda...">
                            </div>
                            <x-input-error :messages="$errors->get('login')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-sm font-bold text-gray-700">Password</label>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input id="password" name="password" type="password" required autocomplete="current-password"
                                       class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 sm:text-sm transition-all text-gray-900 font-medium"
                                       placeholder="••••••••">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between pt-2">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="remember_me" class="ml-2 block text-sm font-medium text-gray-700">Ingat saya di perangkat ini</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" class="w-full flex items-center justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all duration-200 shadow-lg shadow-blue-600/30 hover:-translate-y-0.5">
                                <i data-lucide="log-in" class="w-5 h-5 mr-2"></i> MASUK
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Footer Text for Mobile -->
                <p class="text-center text-xs text-gray-400 mt-8 lg:hidden">
                    &copy; {{ date('Y') }} Sistem Pengadaan. All rights reserved.
                </p>
            </div>
        </div>
    </div>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
