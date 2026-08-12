@extends('layouts.app')

@section('title', 'Lupa Password Admin - OTP WhatsApp')
@section('meta_description', 'Portal reset password akun administrator Sertifikasi Elektronik menggunakan verifikasi OTP WhatsApp.')

@section('content')
<div class="min-h-screen bg-slate-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-6">
        
        {{-- Card Utama --}}
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
            
            {{-- Header Gradien --}}
            <div class="bg-gradient-to-r from-indigo-700 to-indigo-900 px-8 py-6 text-center text-white">
                <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-3 border border-white/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <h2 class="text-xl font-extrabold">Reset Password Admin</h2>
                <p class="text-indigo-200 text-xs mt-1">Verifikasi Kode OTP via WhatsApp Admin</p>
            </div>

            {{-- Indicator 3 Langkah (Steps Bar) --}}
            <div class="bg-slate-50 border-b border-slate-200 px-6 py-3">
                <div class="flex items-center justify-between text-xs font-bold">
                    {{-- Step 1 --}}
                    <div class="flex items-center gap-1.5 {{ $step >= 1 ? 'text-indigo-700' : 'text-slate-400' }}">
                        <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs {{ $step >= 1 ? 'bg-indigo-700 text-white' : 'bg-slate-200 text-slate-500' }}">1</span>
                        <span>Request OTP</span>
                    </div>
                    <div class="h-0.5 w-6 {{ $step >= 2 ? 'bg-indigo-600' : 'bg-slate-200' }}"></div>
                    {{-- Step 2 --}}
                    <div class="flex items-center gap-1.5 {{ $step >= 2 ? 'text-indigo-700' : 'text-slate-400' }}">
                        <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs {{ $step >= 2 ? 'bg-indigo-700 text-white' : 'bg-slate-200 text-slate-500' }}">2</span>
                        <span>Verifikasi OTP</span>
                    </div>
                    <div class="h-0.5 w-6 {{ $step >= 3 ? 'bg-indigo-600' : 'bg-slate-200' }}"></div>
                    {{-- Step 3 --}}
                    <div class="flex items-center gap-1.5 {{ $step >= 3 ? 'text-indigo-700' : 'text-slate-400' }}">
                        <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs {{ $step >= 3 ? 'bg-indigo-700 text-white' : 'bg-slate-200 text-slate-500' }}">3</span>
                        <span>Password Baru</span>
                    </div>
                </div>
            </div>

            {{-- Content Section --}}
            <div class="p-8">

                {{-- Alert Sukses --}}
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-start gap-3 text-xs leading-relaxed font-semibold">
                        <svg class="w-5 h-5 text-green-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Alert Error General --}}
                @if ($errors->has('otp_error'))
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl flex items-start gap-3 text-xs leading-relaxed font-semibold">
                        <svg class="w-5 h-5 text-rose-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $errors->first('otp_error') }}</span>
                    </div>
                @endif

                {{-- ============================================================
                    STEP 1: REQUEST KODE OTP VIA WHATSAPP
                ============================================================ --}}
                @if ($step == 1)
                    <form action="{{ route('admin.send_otp') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                                Email Administrator Terdaftar
                            </label>
                            <input id="email" name="email" type="email" required autocomplete="email"
                                value="{{ old('email') }}"
                                placeholder="admin@sertifikasiel.go.id"
                                class="w-full px-4 py-3 border rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200
                                    {{ $errors->has('email') ? 'border-red-400 bg-red-50 focus:ring-red-400' : 'border-slate-200 bg-white hover:border-slate-300' }}">
                            @error('email')
                                <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Info Box Nomor WA Admin --}}
                        <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-start gap-3">
                            <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-emerald-600 fill-current" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </div>
                            <div class="text-xs text-emerald-800 leading-relaxed font-medium">
                                Kode OTP 6-digit akan dikirimkan langsung ke nomor <strong>WhatsApp Admin Helpdesk (+62 823-1229-3928)</strong>.
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-4 px-4 border border-transparent rounded-xl text-sm font-bold text-white bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5 cursor-pointer">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            <span>Minta Kode OTP via WhatsApp</span>
                        </button>
                    </form>
                @endif

                {{-- ============================================================
                    STEP 2: VERIFIKASI KODE OTP
                ============================================================ --}}
                @if ($step == 2)
                    <div class="space-y-6">

                        {{-- Tombol Buka WhatsApp --}}
                        @if (session('wa_otp_url'))
                            <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-center space-y-3">
                                <p class="text-xs text-emerald-800 font-semibold leading-relaxed">
                                    Silakan buka aplikasi WhatsApp untuk mengambil pesan berisikan Kode OTP 6-digit Anda:
                                </p>
                                <a href="{{ session('wa_otp_url') }}" target="_blank" rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md transition-all duration-200">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                    <span>📱 Buka WhatsApp Admin Sekarang</span>
                                </a>
                            </div>
                        @endif

                        <form action="{{ route('admin.verify_otp') }}" method="POST" class="space-y-5">
                            @csrf

                            <div>
                                <label for="otp_code" class="block text-sm font-semibold text-slate-700 mb-2 text-center">
                                    Masukkan 6 Digit Kode OTP
                                </label>
                                <input id="otp_code" name="otp_code" type="text" maxlength="6" required placeholder="123456" autofocus
                                    class="w-full px-4 py-3.5 border border-slate-300 rounded-xl text-center text-2xl font-bold font-mono tracking-widest text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                                @error('otp_code')
                                    <p class="mt-2 text-xs text-red-600 font-medium text-center">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full py-4 px-4 rounded-xl text-sm font-bold text-white bg-indigo-700 hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all shadow-md hover:shadow-lg cursor-pointer">
                                Verifikasi Kode OTP
                            </button>
                        </form>

                        {{-- Tombol Kirim Ulang --}}
                        <div class="text-center pt-2">
                            <form action="{{ route('admin.send_otp') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">
                                <button type="submit" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 hover:underline cursor-pointer bg-transparent border-0">
                                    Belum menerima kode? Kirim Ulang OTP
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                {{-- ============================================================
                    STEP 3: RESET PASSWORD BARU
                ============================================================ --}}
                @if ($step == 3)
                    <form action="{{ route('admin.reset_password') }}" method="POST" class="space-y-5">
                        @csrf

                        {{-- Password Baru --}}
                        <div>
                            <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                                Password Baru
                            </label>
                            <input id="password" name="password" type="password" required placeholder="Minimal 8 karakter (A-Z, a-z, 0-9, @#$)"
                                class="w-full px-4 py-3 border rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all
                                    {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-slate-200' }}">
                            @error('password')
                                <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Konfirmasi Password Baru --}}
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">
                                Konfirmasi Password Baru
                            </label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required placeholder="Ulangi password baru Anda"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
                        </div>

                        {{-- Aturan Password --}}
                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-600 space-y-1">
                            <div class="font-bold text-slate-700">Persyaratan Keamanan Password:</div>
                            <ul class="list-disc list-inside space-y-0.5 text-slate-500">
                                <li>Panjang minimal 8 - 12 karakter</li>
                                <li>Kombinasi huruf besar (A-Z) & huruf kecil (a-z)</li>
                                <li>Kombinasi angka (0-9) & simbol khusus (@, !, #, $, %)</li>
                            </ul>
                        </div>

                        <button type="submit"
                            class="w-full py-4 px-4 rounded-xl text-sm font-bold text-white bg-indigo-700 hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all shadow-md hover:shadow-lg cursor-pointer">
                            Simpan Password Baru
                        </button>
                    </form>
                @endif

            </div>
        </div>

        {{-- Kembali ke Login --}}
        <div class="text-center">
            <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Halaman Login Admin</span>
            </a>
        </div>

    </div>
</div>
@endsection
