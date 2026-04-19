@php
    $dashboardActive = request()->is('dashboard');
    $textListActive = request()->is('your-text') || request()->is('*/edited');
    $newTextActive = request()->is('new-text');
    $settingsActive = request()->is('settings');

    $navBaseClass = 'group flex items-center gap-3 rounded-xl px-3 py-2.5 text-slate-600 transition-colors hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white';
    $navActiveClass = 'bg-slate-200 text-slate-950 shadow-inner ring-1 ring-slate-300 dark:text-white';
    $navActiveStyle = 'background-color: color-mix(in srgb, var(--warm-accent-soft) 22%, var(--warm-surface)); border: 1px solid color-mix(in srgb, var(--warm-accent) 26%, var(--warm-border)); box-shadow: inset 0 1px 0 color-mix(in srgb, white 4%, transparent);';
    $iconBaseClass = 'h-5 w-5 shrink-0 text-slate-400 transition duration-150 group-hover:text-cyan-500 dark:text-slate-500 dark:group-hover:text-[color:var(--warm-accent)]';
    $iconActiveStyle = 'color: var(--warm-accent);';
@endphp

<div>
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full border-r border-slate-200 bg-white sm:translate-x-0 dark:border-slate-800 dark:bg-slate-900"
        aria-label="Sidebar">
        <div class="h-full overflow-y-auto bg-white px-3 pb-4 dark:bg-slate-900">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="/dashboard"
                        class="{{ $navBaseClass }} {{ $dashboardActive ? $navActiveClass : '' }}"
                        @if ($dashboardActive) style="{{ $navActiveStyle }}" @endif>

                        <svg class="h-5 w-5 text-slate-400 transition duration-150 group-hover:text-cyan-500 dark:text-slate-500 dark:group-hover:text-[color:var(--warm-accent)]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21" @if ($dashboardActive) style="{{ $iconActiveStyle }}" @endif>
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/your-text"
                        class="{{ $navBaseClass }} {{ $textListActive ? $navActiveClass : '' }}"
                        @if ($textListActive) style="{{ $navActiveStyle }}" @endif>
                        <svg class="{{ $iconBaseClass }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18" @if ($textListActive) style="{{ $iconActiveStyle }}" @endif>
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 whitespace-nowrap">Your Text</span>
                    </a>
                </li>
                <li>
                    <a href="/new-text"
                        class="{{ $navBaseClass }} {{ $newTextActive ? $navActiveClass : '' }}"
                        @if ($newTextActive) style="{{ $navActiveStyle }}" @endif>
                        <svg class="{{ $iconBaseClass }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" @if ($newTextActive) style="{{ $iconActiveStyle }}" @endif>
                            <path fill-rule="evenodd"
                                d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7ZM8 16a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1-5a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span class="flex-1 whitespace-nowrap">New Text</span>
                    </a>
                </li>
                <li>
                    <a href="/settings"
                        class="{{ $navBaseClass }} {{ $settingsActive ? $navActiveClass : '' }}"
                        @if ($settingsActive) style="{{ $navActiveStyle }}" @endif>
                        <svg class="{{ $iconBaseClass }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" @if ($settingsActive) style="{{ $iconActiveStyle }}" @endif>
                            <path fill-rule="evenodd" d="M8.286 3.172a3 3 0 0 1 5.428 0l.245.49a1 1 0 0 0 .753.542l.54.077a3 3 0 0 1 2.446 2.446l.077.54a1 1 0 0 0 .542.753l.49.245a3 3 0 0 1 0 5.428l-.49.245a1 1 0 0 0-.542.753l-.077.54a3 3 0 0 1-2.446 2.446l-.54.077a1 1 0 0 0-.753.542l-.245.49a3 3 0 0 1-5.428 0l-.245-.49a1 1 0 0 0-.753-.542l-.54-.077a3 3 0 0 1-2.446-2.446l-.077-.54a1 1 0 0 0-.542-.753l-.49-.245a3 3 0 0 1 0-5.428l.49-.245a1 1 0 0 0 .542-.753l.077-.54A3 3 0 0 1 7.288 4.28l.54-.077a1 1 0 0 0 .753-.542l.245-.49ZM12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Z" clip-rule="evenodd" />
                        </svg>
                        <span class="flex-1 whitespace-nowrap">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
</div>
