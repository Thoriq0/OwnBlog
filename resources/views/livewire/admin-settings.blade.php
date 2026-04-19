<div class="mx-auto max-w-6xl">
    <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.24em]" style="color: var(--warm-text-muted);">Admin Settings</p>
            <h1 class="mt-2 text-3xl font-extrabold" style="color: var(--warm-text);">Kontrol akun admin dan identitas blog dari satu tempat.</h1>
            <p class="mt-3 max-w-3xl text-sm leading-7" style="color: var(--warm-text-soft);">
                Perubahan di base settings langsung kepakai di navbar guest, footer, login page, dan branding admin.
            </p>
        </div>

        <div class="rounded-[1.75rem] border px-5 py-4 shadow-sm"
             style="border-color: var(--warm-border); background-color: color-mix(in srgb, var(--warm-surface) 92%, transparent);">
            <p class="text-xs font-semibold uppercase tracking-[0.2em]" style="color: var(--warm-text-muted);">Current Brand</p>
            <div class="mt-3 flex items-center gap-3">
                <img src="{{ $currentLogoUrl }}" alt="{{ $site_title }} logo" class="h-12 w-12 rounded-2xl object-cover" />
                <div>
                    <p class="text-lg font-bold" style="color: var(--warm-text);">{{ $site_title }}</p>
                    <p class="text-sm" style="color: var(--warm-text-soft);">Live di admin + guest</p>
                </div>
            </div>
        </div>
    </div>

    @if (session('settings-success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 3500)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-3"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-3"
            class="fixed right-4 top-24 z-50 w-[calc(100vw-2rem)] sm:w-[22rem]"
        >
            <div class="flex items-start gap-3 rounded-[1.2rem] border px-4 py-3.5 text-sm shadow-xl backdrop-blur"
                style="border-color: color-mix(in srgb, #86efac 28%, var(--warm-border)); background-color: color-mix(in srgb, #f0fdf4 76%, var(--warm-surface)); color: #166534; box-shadow: 0 14px 30px color-mix(in srgb, #86efac 12%, transparent);">
                <div class="mt-0.5 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full"
                    style="background-color: color-mix(in srgb, #86efac 28%, white); color: #16a34a;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.24em]" style="color: color-mix(in srgb, #166534 72%, white);">Sip, berhasil</p>
                    <p class="mt-1 leading-6">{{ session('settings-success') }}</p>
                </div>
                <button @click="show = false" class="mt-0.5 transition hover:opacity-100" style="color: color-mix(in srgb, #166534 68%, white); opacity: 0.72;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if (session('settings-error'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 4500)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-3"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-3"
            class="fixed right-4 top-24 z-50 w-[calc(100vw-2rem)] sm:w-[22rem]"
        >
            <div class="flex items-start gap-3 rounded-[1.2rem] border px-4 py-3.5 text-sm shadow-xl backdrop-blur"
                style="border-color: color-mix(in srgb, #fda4af 28%, var(--warm-border)); background-color: color-mix(in srgb, #fff1f2 76%, var(--warm-surface)); color: #9f1239; box-shadow: 0 14px 30px color-mix(in srgb, #fb7185 10%, transparent);">
                <div class="mt-0.5 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full"
                    style="background-color: color-mix(in srgb, #fecdd3 55%, white); color: #e11d48;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-7.938 4h15.876C19.07 19 20 18.07 20 16.938V7.062C20 5.93 19.07 5 17.938 5H6.062C4.93 5 4 5.93 4 7.062v9.876C4 18.07 4.93 19 6.062 19z"/>
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.24em]" style="color: color-mix(in srgb, #9f1239 72%, white);">Eits, bentar</p>
                    <p class="mt-1 leading-6">{{ session('settings-error') }}</p>
                </div>
                <button @click="show = false" class="mt-0.5 transition hover:opacity-100" style="color: color-mix(in srgb, #9f1239 68%, white); opacity: 0.72;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <div class="mb-6 inline-flex rounded-full border p-1.5 shadow-sm"
         style="border-color: var(--warm-border); background-color: color-mix(in srgb, var(--warm-surface) 92%, transparent);">
        <button type="button" wire:click="setActiveTab('account')"
            class="rounded-full px-5 py-2.5 text-sm font-semibold transition"
            style="{{ $activeTab === 'account' ? 'background: linear-gradient(135deg, var(--warm-accent), var(--warm-accent-strong)); color: white; box-shadow: 0 12px 28px color-mix(in srgb, var(--warm-accent) 24%, transparent);' : 'color: var(--warm-text-soft);' }}">
            Account Settings
        </button>
        <button type="button" wire:click="setActiveTab('base')"
            class="rounded-full px-5 py-2.5 text-sm font-semibold transition"
            style="{{ $activeTab === 'base' ? 'background: linear-gradient(135deg, var(--warm-accent), var(--warm-accent-strong)); color: white; box-shadow: 0 12px 28px color-mix(in srgb, var(--warm-accent) 24%, transparent);' : 'color: var(--warm-text-soft);' }}">
            Base Settings
        </button>
    </div>

    @if ($activeTab === 'account')
        <form action="{{ route('settings.account.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <input type="hidden" name="settings_tab" value="account">
            <div class="grid gap-6 xl:grid-cols-[0.92fr_1.08fr]">
                <section class="rounded-[1.9rem] border p-6 shadow-sm"
                         style="border-color: var(--warm-border); background-color: color-mix(in srgb, var(--warm-surface) 95%, transparent);">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em]" style="color: var(--warm-text-muted);">Profile</p>
                            <h2 class="mt-2 text-2xl font-bold" style="color: var(--warm-text);">Account settings</h2>
                            <p class="mt-2 text-sm leading-6" style="color: var(--warm-text-soft);">Ganti avatar, nama user, dan email login admin dari sini.</p>
                        </div>

                        @if ($avatar)
                            <img src="{{ $avatar->temporaryUrl() }}" alt="Avatar preview" class="h-20 w-20 rounded-[1.4rem] object-cover shadow-sm" />
                        @elseif ($currentAvatarUrl)
                            <img src="{{ $currentAvatarUrl }}" alt="Current avatar" class="h-20 w-20 rounded-[1.4rem] object-cover shadow-sm" />
                        @else
                            <div class="flex h-20 w-20 items-center justify-center rounded-[1.4rem] text-xl font-bold shadow-sm"
                                 style="background-color: color-mix(in srgb, var(--warm-accent-soft) 70%, var(--warm-surface)); color: var(--warm-accent-strong);">
                                {{ Auth::user()->initials }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-6">
                        <label for="avatar" class="mb-2 block text-sm font-semibold" style="color: var(--warm-text-soft);">Foto profil admin</label>
                        <input id="avatar" name="avatar" type="file" wire:model="avatar"
                               class="block w-full rounded-2xl border px-4 py-3 text-sm"
                               style="border-color: var(--warm-border); background-color: var(--warm-surface-soft); color: var(--warm-text);" />
                        <p class="mt-2 text-xs" style="color: var(--warm-text-muted);">Format: jpg, jpeg, png, webp. Maksimal 2MB.</p>
                        @error('avatar') <p class="mt-2 text-sm font-medium" style="color: #c2410c;">{{ $message }}</p> @enderror
                    </div>
                </section>

                <section class="rounded-[1.9rem] border p-6 shadow-sm"
                         style="border-color: var(--warm-border); background-color: color-mix(in srgb, var(--warm-surface) 95%, transparent);">
                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label for="name" class="mb-2 block text-sm font-semibold" style="color: var(--warm-text-soft);">User name</label>
                            <input id="name" name="name" type="text" wire:model.defer="name"
                                   class="block w-full rounded-2xl border px-4 py-3 text-sm outline-none transition"
                                   style="border-color: var(--warm-border); background-color: var(--warm-surface-soft); color: var(--warm-text);" />
                            @error('name') <p class="mt-2 text-sm font-medium" style="color: #c2410c;">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold" style="color: var(--warm-text-soft);">Email login</label>
                            <input id="email" name="email" type="email" wire:model.defer="email"
                                   class="block w-full rounded-2xl border px-4 py-3 text-sm outline-none transition"
                                   style="border-color: var(--warm-border); background-color: var(--warm-surface-soft); color: var(--warm-text);" />
                            @error('email') <p class="mt-2 text-sm font-medium" style="color: #c2410c;">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mt-8 border-t pt-6" style="border-color: var(--warm-border);">
                        <div class="mb-4">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em]" style="color: var(--warm-text-muted);">Security</p>
                            <h3 class="mt-2 text-xl font-bold" style="color: var(--warm-text);">Ubah password</h3>
                            <p class="mt-2 text-sm leading-6" style="color: var(--warm-text-soft);">Isi bagian ini kalau mau ganti password login admin.</p>
                        </div>

                        <div class="grid gap-5 md:grid-cols-3">
                            <div>
                                <label for="current_password" class="mb-2 block text-sm font-semibold" style="color: var(--warm-text-soft);">Password sekarang</label>
                                <input id="current_password" name="current_password" type="password" wire:model.defer="current_password"
                                       class="block w-full rounded-2xl border px-4 py-3 text-sm outline-none transition"
                                       style="border-color: var(--warm-border); background-color: var(--warm-surface-soft); color: var(--warm-text);" />
                                @error('current_password') <p class="mt-2 text-sm font-medium" style="color: #c2410c;">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="new_password" class="mb-2 block text-sm font-semibold" style="color: var(--warm-text-soft);">Password baru</label>
                                <input id="new_password" name="new_password" type="password" wire:model.defer="new_password"
                                       class="block w-full rounded-2xl border px-4 py-3 text-sm outline-none transition"
                                       style="border-color: var(--warm-border); background-color: var(--warm-surface-soft); color: var(--warm-text);" />
                                @error('new_password') <p class="mt-2 text-sm font-medium" style="color: #c2410c;">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="new_password_confirmation" class="mb-2 block text-sm font-semibold" style="color: var(--warm-text-soft);">Konfirmasi password baru</label>
                                <input id="new_password_confirmation" name="new_password_confirmation" type="password" wire:model.defer="new_password_confirmation"
                                       class="block w-full rounded-2xl border px-4 py-3 text-sm outline-none transition"
                                       style="border-color: var(--warm-border); background-color: var(--warm-surface-soft); color: var(--warm-text);" />
                                @error('new_password_confirmation') <p class="mt-2 text-sm font-medium" style="color: #c2410c;">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="sticky bottom-4 z-20 flex justify-end">
                <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl px-6 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5"
                        style="background: linear-gradient(135deg, var(--warm-accent), var(--warm-accent-strong)); box-shadow: 0 10px 18px color-mix(in srgb, var(--warm-accent) 18%, transparent);">
                    <span>Save account settings</span>
                </button>
            </div>
        </form>
    @endif

    @if ($activeTab === 'base')
        <form action="{{ route('settings.base.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <input type="hidden" name="settings_tab" value="base">
            <div class="grid gap-6 xl:grid-cols-[1fr_1.1fr]">
                <section class="rounded-[1.9rem] border p-6 shadow-sm"
                         style="border-color: var(--warm-border); background-color: color-mix(in srgb, var(--warm-surface) 95%, transparent);">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em]" style="color: var(--warm-text-muted);">Brand</p>
                            <h2 class="mt-2 text-2xl font-bold" style="color: var(--warm-text);">Base settings</h2>
                            <p class="mt-2 text-sm leading-6" style="color: var(--warm-text-soft);">
                                Ganti nama blog, logo, dan 3 link connect yang tampil di guest footer.
                            </p>
                        </div>

                        @if ($site_logo)
                            <img src="{{ $site_logo->temporaryUrl() }}" alt="Logo preview" class="h-20 w-20 rounded-[1.4rem] object-cover shadow-sm" />
                        @else
                            <img src="{{ $currentLogoUrl }}" alt="Current logo" class="h-20 w-20 rounded-[1.4rem] object-cover shadow-sm" />
                        @endif
                    </div>

                    <div class="mt-6">
                        <label for="site_title" class="mb-2 block text-sm font-semibold" style="color: var(--warm-text-soft);">Site title</label>
                        <input id="site_title" name="site_title" type="text" wire:model.defer="site_title"
                               class="block w-full rounded-2xl border px-4 py-3 text-sm outline-none transition"
                               style="border-color: var(--warm-border); background-color: var(--warm-surface-soft); color: var(--warm-text);" />
                        @error('site_title') <p class="mt-2 text-sm font-medium" style="color: #c2410c;">{{ $message }}</p> @enderror
                    </div>

                    <div class="mt-5">
                        <label for="site_logo" class="mb-2 block text-sm font-semibold" style="color: var(--warm-text-soft);">Logo / icon blog</label>
                        <input id="site_logo" name="site_logo" type="file" wire:model="site_logo"
                               class="block w-full rounded-2xl border px-4 py-3 text-sm"
                               style="border-color: var(--warm-border); background-color: var(--warm-surface-soft); color: var(--warm-text);" />
                        <p class="mt-2 text-xs" style="color: var(--warm-text-muted);">Logo ini dipakai di admin navbar, guest navbar, footer, dan login.</p>
                        @error('site_logo') <p class="mt-2 text-sm font-medium" style="color: #c2410c;">{{ $message }}</p> @enderror
                    </div>
                </section>

                <section class="rounded-[1.9rem] border p-6 shadow-sm"
                         style="border-color: var(--warm-border); background-color: color-mix(in srgb, var(--warm-surface) 95%, transparent);">
                    <div class="mb-5">
                        <p class="text-sm font-semibold uppercase tracking-[0.2em]" style="color: var(--warm-text-muted);">Footer connect</p>
                        <h3 class="mt-2 text-xl font-bold" style="color: var(--warm-text);">Maksimal 3 link</h3>
                        <p class="mt-2 text-sm leading-6" style="color: var(--warm-text-soft);">
                            Cocok untuk GitHub, Twitter/X, Email, portfolio, atau link penting lain. URL boleh `https://...` atau `mailto:...`.
                        </p>
                    </div>

                    <div class="space-y-5">
                        @foreach ([1, 2, 3] as $slot)
                            <div class="rounded-[1.5rem] border p-4"
                                 style="border-color: var(--warm-border); background-color: color-mix(in srgb, var(--warm-surface-soft) 72%, transparent);">
                                <p class="mb-4 text-sm font-semibold" style="color: var(--warm-text);">Connect {{ $slot }}</p>
                                <div class="grid gap-4 md:grid-cols-[0.8fr_1.2fr]">
                                    <div>
                                        <label for="connect_{{ $slot }}_label" class="mb-2 block text-sm font-semibold" style="color: var(--warm-text-soft);">Label</label>
                                        <input id="connect_{{ $slot }}_label" name="connect_{{ $slot }}_label" type="text" wire:model.defer="connect_{{ $slot }}_label"
                                               class="block w-full rounded-2xl border px-4 py-3 text-sm outline-none transition"
                                               style="border-color: var(--warm-border); background-color: var(--warm-surface); color: var(--warm-text);" />
                                        @error("connect_{$slot}_label") <p class="mt-2 text-sm font-medium" style="color: #c2410c;">{{ $message }}</p> @enderror
                                    </div>

                                    <div>
                                        <label for="connect_{{ $slot }}_url" class="mb-2 block text-sm font-semibold" style="color: var(--warm-text-soft);">URL</label>
                                        <input id="connect_{{ $slot }}_url" name="connect_{{ $slot }}_url" type="text" wire:model.defer="connect_{{ $slot }}_url"
                                               class="block w-full rounded-2xl border px-4 py-3 text-sm outline-none transition"
                                               style="border-color: var(--warm-border); background-color: var(--warm-surface); color: var(--warm-text);" />
                                        @error("connect_{$slot}_url") <p class="mt-2 text-sm font-medium" style="color: #c2410c;">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <div class="sticky bottom-4 z-20 flex justify-end">
                <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl px-6 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5"
                        style="background: linear-gradient(135deg, var(--warm-accent), var(--warm-accent-strong)); box-shadow: 0 10px 18px color-mix(in srgb, var(--warm-accent) 18%, transparent);">
                    <span>Save base settings</span>
                </button>
            </div>
        </form>
    @endif
</div>
