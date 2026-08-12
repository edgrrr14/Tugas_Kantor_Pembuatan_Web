@extends('layouts.app')

@section('title', 'Login Admin')
@section('meta_description', 'Halaman masuk portal administrator Sertifikasi Elektronik.')

@section('content')
<div class="min-h-screen bg-slate-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        
        {{-- Card Utama Login --}}
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden animate-fade-in">
            
            {{-- Header dengan Gradien --}}
            <div class="bg-gradient-to-r from-indigo-700 to-indigo-900 px-8 py-6 text-center">
                <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-white/20">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-extrabold text-white">Login Administrator</h2>
                <p class="text-indigo-200 text-sm mt-1">Portal Pengelolaan Sertifikasi Elektronik</p>
            </div>

            {{-- Form Section --}}
            <form class="p-8 space-y-6" action="{{ route('admin.authenticate') }}" method="POST" novalidate>
                @csrf

                {{-- Alert Error General --}}
                @if ($errors->has('login_error'))
                    <div class="bg-rose-50 border border-rose-200 text-rose-800 rounded-xl p-4 flex items-start gap-3">
                        <svg class="w-5 h-5 text-rose-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-medium">{{ $errors->first('login_error') }}</span>
                    </div>
                @endif

                {{-- Field: Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                        Alamat Email Admin
                    </label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        value="{{ old('email') }}"
                        placeholder="admin@sertifikasiel.go.id"
                        class="w-full px-4 py-3 border rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200
                            {{ $errors->has('email') ? 'border-red-400 bg-red-50 focus:ring-red-400' : 'border-slate-200 bg-white hover:border-slate-300' }}">
                    @error('email')
                        <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Field: Password --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-semibold text-slate-700">
                            Password
                        </label>
                        <a href="{{ route('admin.forgot_password') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 hover:underline transition-colors">
                            Lupa Password?
                        </a>
                    </div>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        placeholder="••••••••"
                        class="w-full px-4 py-3 border rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200
                            {{ $errors->has('password') ? 'border-red-400 bg-red-50 focus:ring-red-400' : 'border-slate-200 bg-white hover:border-slate-300' }}">
                    @error('password')
                        <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl text-sm font-bold text-white bg-indigo-700 hover:bg-indigo-800 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-300 shadow-md hover:shadow-indigo-300/50 hover:shadow-lg hover:-translate-y-0.5 cursor-pointer">
                    Masuk ke Dashboard
                </button>
            </form>



        </div>

        {{-- Kembali ke Beranda --}}
        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Beranda Utama</span>
            </a>
        </div>

    </div>
</div>
@endsection
