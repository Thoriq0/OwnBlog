@extends('layouts.main')

@section('title', 'Login - ' . ($siteTitle ?? $siteSettings->site_title))

@section('content')
<div class="relative min-h-screen overflow-hidden bg-[color:var(--warm-bg)] text-[color:var(--warm-text)]">
  <div class="absolute inset-0 opacity-70"
       style="background:
        radial-gradient(circle at top left, color-mix(in srgb, var(--warm-accent) 18%, transparent), transparent 30%),
        radial-gradient(circle at bottom right, color-mix(in srgb, var(--warm-accent-soft) 70%, transparent), transparent 35%);">
  </div>

  <div class="relative mx-auto flex min-h-screen max-w-7xl items-center px-6 py-10 sm:px-8 lg:px-12">
    <div class="grid w-full gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
      <section class="hidden lg:block">
        <div class="max-w-2xl">
          <div class="mb-6 inline-flex items-center gap-3 rounded-full border px-4 py-2 text-sm font-medium"
               style="border-color: var(--warm-border); background-color: color-mix(in srgb, var(--warm-surface) 82%, transparent); color: var(--warm-text-soft);">
            <img src="{{ $siteSettings->logo_url }}" class="h-8 w-8 rounded-lg object-cover" alt="{{ $siteSettings->site_title }} Logo" />
            <span>{{ $siteSettings->site_title }} Admin Access</span>
          </div>

          <h1 class="max-w-xl text-5xl font-extrabold leading-[1.05] tracking-tight" style="color: var(--warm-text);">
            Masuk ke ruang tulis yang hangat dan fokus buat ngatur konten blog.
          </h1>

          <p class="mt-6 max-w-xl text-lg leading-8" style="color: var(--warm-text-soft);">
            Satu tempat buat nulis, edit Markdown, upload banner, dan jaga isi blog tetap rapi tanpa distraksi yang nggak perlu.
          </p>

          <div class="mt-10 grid max-w-xl gap-4 sm:grid-cols-2">
            <div class="rounded-[1.75rem] border p-5 shadow-sm"
                 style="border-color: var(--warm-border); background-color: color-mix(in srgb, var(--warm-surface) 90%, transparent);">
              <p class="text-sm font-semibold uppercase tracking-[0.22em]" style="color: var(--warm-text-muted);">Editor</p>
              <p class="mt-3 text-base font-medium" style="color: var(--warm-text);">Markdown preview real-time buat nulis lebih nyaman.</p>
            </div>
            <div class="rounded-[1.75rem] border p-5 shadow-sm"
                 style="border-color: var(--warm-border); background-color: color-mix(in srgb, var(--warm-surface) 90%, transparent);">
              <p class="text-sm font-semibold uppercase tracking-[0.22em]" style="color: var(--warm-text-muted);">Publishing</p>
              <p class="mt-3 text-base font-medium" style="color: var(--warm-text);">Draft, publish, dan upload banner dalam satu alur yang simpel.</p>
            </div>
          </div>
        </div>
      </section>

      <section class="mx-auto w-full max-w-lg">
        <div class="rounded-[2rem] border p-6 shadow-2xl sm:p-8"
             style="border-color: var(--warm-border); background-color: color-mix(in srgb, var(--warm-surface) 94%, transparent); box-shadow: 0 30px 80px color-mix(in srgb, var(--warm-text) 10%, transparent);">
          <div class="mb-8 flex items-center gap-4">
            <img src="{{ $siteSettings->logo_url }}" class="h-12 w-12 rounded-xl object-cover" alt="{{ $siteSettings->site_title }} Logo" />
            <div>
              <p class="text-sm font-semibold uppercase tracking-[0.22em]" style="color: var(--warm-text-muted);">Admin Login</p>
              <h2 class="mt-1 text-3xl font-extrabold" style="color: var(--warm-text);">Welcome back</h2>
            </div>
          </div>

          @if ($errors->any())
            <div class="mb-6 rounded-2xl border px-4 py-3 text-sm"
                 style="border-color: color-mix(in srgb, #d97706 25%, var(--warm-border)); background-color: color-mix(in srgb, #f59e0b 10%, var(--warm-surface)); color: var(--warm-accent-strong);">
              {{ $errors->first() }}
            </div>
          @endif

          <form class="space-y-5" method="POST" action="/login/auth">
            @csrf

            <div>
              <label for="email" class="mb-2 block text-sm font-semibold" style="color: var(--warm-text-soft);">Email admin</label>
              <input type="email" id="email" name="email" required value="{{ old('email') }}"
                     placeholder="admin@example.com"
                     class="block w-full rounded-2xl border px-4 py-3 text-sm outline-none transition"
                     style="border-color: var(--warm-border); background-color: var(--warm-surface-soft); color: var(--warm-text);" />
            </div>

            <div>
              <label for="password" class="mb-2 block text-sm font-semibold" style="color: var(--warm-text-soft);">Password</label>
              <input type="password" id="password" name="password" required
                     placeholder="Enter your password"
                     class="block w-full rounded-2xl border px-4 py-3 text-sm outline-none transition"
                     style="border-color: var(--warm-border); background-color: var(--warm-surface-soft); color: var(--warm-text);" />
            </div>

            <div class="flex items-center justify-between gap-4 pt-1">
              <label for="remember" class="inline-flex items-center gap-3 text-sm font-medium" style="color: var(--warm-text-soft);">
                <input id="remember" name="remember" type="checkbox" value="1"
                       class="h-4 w-4 rounded border"
                       style="border-color: var(--warm-border); accent-color: var(--warm-accent);" />
                Remember me
              </label>
              <span class="text-xs" style="color: var(--warm-text-muted);">Private admin area</span>
            </div>

            <button type="submit"
                    class="inline-flex w-full items-center justify-center rounded-2xl px-5 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5"
                    style="background: linear-gradient(135deg, var(--warm-accent), var(--warm-accent-strong)); box-shadow: 0 18px 35px color-mix(in srgb, var(--warm-accent) 30%, transparent);">
              Sign In to Dashboard
            </button>
          </form>

          <div class="mt-6 rounded-2xl border px-4 py-4 text-sm"
               style="border-color: var(--warm-border); background-color: color-mix(in srgb, var(--warm-accent-soft) 45%, var(--warm-surface));">
            <p class="font-semibold" style="color: var(--warm-text);">Admin access</p>
            <p class="mt-1" style="color: var(--warm-text-soft);">
              Masuk pakai email admin aktif kamu.
              @if ($adminUser)
                Email saat ini:
                <span class="font-medium" style="color: var(--warm-accent-strong);">{{ $adminUser->email }}</span>
              @endif
            </p>
            <p style="color: var(--warm-text-soft);">Kalau email atau password diubah dari settings admin, halaman login otomatis ikut pakai data terbaru.</p>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
@endsection
