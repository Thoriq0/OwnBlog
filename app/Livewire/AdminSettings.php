<?php

namespace App\Livewire;

use App\Models\SiteSetting;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminSettings extends Component
{
    use WithFileUploads;

    public string $activeTab = 'account';

    public string $name = '';
    public string $email = '';
    public $avatar;
    public string $current_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';
    public ?string $currentAvatarUrl = null;

    public string $site_title = '';
    public $site_logo;
    public ?string $currentLogoUrl = null;
    public string $connect_1_label = '';
    public string $connect_1_url = '';
    public string $connect_2_label = '';
    public string $connect_2_url = '';
    public string $connect_3_label = '';
    public string $connect_3_url = '';

    public function mount(): void
    {
        $requestedTab = request()->query('tab', 'account');
        $this->activeTab = in_array($requestedTab, ['account', 'base'], true) ? $requestedTab : 'account';
        $this->hydrateState();
        $this->restoreOldInput();
    }

    public function setActiveTab(string $tab): void
    {
        if (in_array($tab, ['account', 'base'], true)) {
            $this->activeTab = $tab;
        }
    }

    public function saveAccountSettings()
    {
        try {
            $validated = $this->validate(
                $this->accountRules(),
                $this->accountMessages(),
                $this->validationAttributes(),
            );
            $user = Auth::user();

            if (! empty($validated['new_password'])) {
                if (! Hash::check($validated['current_password'], $user->password)) {
                    $this->addError('current_password', 'Password saat ini tidak cocok.');
                    session()->flash('settings-error', 'Password lama lo ngadi-ngadi bro, nggak cocok sama yang di sistem 😵');
                    return;
                }

                $user->password = Hash::make($validated['new_password']);
            }

            if ($this->avatar) {
                if ($user->avatar_path) {
                    Storage::disk('public')->delete($user->avatar_path);
                }

                $user->avatar_path = $this->avatar->store('avatars', 'public');
            }

            $user->fill([
                'name' => trim($validated['name']),
                'email' => trim($validated['email']),
            ])->save();

            $this->current_password = '';
            $this->new_password = '';
            $this->new_password_confirmation = '';
            $this->avatar = null;
            $this->currentAvatarUrl = $user->fresh()->avatar_url;
            $this->hydrateState();
            $this->resetValidation();

            session()->flash('settings-success', 'Sip, account settings lo udah kepoles rapi. Profil admin sekarang versi paling fresh ✨');

            return redirect()->route('settings', ['tab' => 'account']);
        } catch (ValidationException $exception) {
            session()->flash('settings-error', 'Account settings belum lolos sensor. Ada field yang masih bandel tuh 👀');
            throw $exception;
        } catch (\Throwable $exception) {
            report($exception);
            session()->flash('settings-error', 'Waduh, account settings-nya nyangkut di tengah jalan. Coba sikat sekali lagi ya bro.');

            return null;
        }
    }

    public function saveBaseSettings()
    {
        try {
            $validated = $this->validate(
                $this->baseRules(),
                $this->baseMessages(),
                $this->validationAttributes(),
            );
            $siteSetting = SiteSetting::current();

            if ($this->site_logo) {
                if ($siteSetting->site_logo_path) {
                    Storage::disk('public')->delete($siteSetting->site_logo_path);
                }

                $siteSetting->site_logo_path = $this->site_logo->store('site-branding', 'public');
            }

            $siteSetting->fill([
                'site_title' => trim($validated['site_title']),
                'connect_1_label' => $this->nullableTrim($validated['connect_1_label']),
                'connect_1_url' => $this->nullableTrim($validated['connect_1_url']),
                'connect_2_label' => $this->nullableTrim($validated['connect_2_label']),
                'connect_2_url' => $this->nullableTrim($validated['connect_2_url']),
                'connect_3_label' => $this->nullableTrim($validated['connect_3_label']),
                'connect_3_url' => $this->nullableTrim($validated['connect_3_url']),
            ])->save();

            SiteSetting::flushCache();
            $this->site_logo = null;
            $this->hydrateState();
            $this->resetValidation();

            session()->flash('settings-success', 'Mantap, base settings berhasil disimpan. Branding sama connect footer sekarang ikut dandan 😎');

            return redirect()->route('settings', ['tab' => 'base']);
        } catch (ValidationException $exception) {
            session()->flash('settings-error', 'Base settings belum tembus. Biasanya sih ada URL connect yang lagi acting suspicious 🤨');
            throw $exception;
        } catch (\Throwable $exception) {
            report($exception);
            session()->flash('settings-error', 'Base settings lagi drama. Simpennya gagal dulu, tapi kita masih bisa coba lagi.');

            return null;
        }
    }

    protected function hydrateState(): void
    {
        $user = Auth::user();
        $siteSetting = SiteSetting::current();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->currentAvatarUrl = $user->avatar_url;

        $this->site_title = $siteSetting->site_title;
        $this->currentLogoUrl = $siteSetting->logo_url;
        $this->connect_1_label = (string) $siteSetting->connect_1_label;
        $this->connect_1_url = (string) $siteSetting->connect_1_url;
        $this->connect_2_label = (string) $siteSetting->connect_2_label;
        $this->connect_2_url = (string) $siteSetting->connect_2_url;
        $this->connect_3_label = (string) $siteSetting->connect_3_label;
        $this->connect_3_url = (string) $siteSetting->connect_3_url;
    }

    protected function restoreOldInput(): void
    {
        $old = session()->getOldInput();

        if (empty($old)) {
            return;
        }

        $tab = $old['settings_tab'] ?? $this->activeTab;

        if ($tab === 'account') {
            $this->name = (string) ($old['name'] ?? $this->name);
            $this->email = (string) ($old['email'] ?? $this->email);
            $this->current_password = (string) ($old['current_password'] ?? '');
            $this->new_password = (string) ($old['new_password'] ?? '');
            $this->new_password_confirmation = (string) ($old['new_password_confirmation'] ?? '');

            return;
        }

        if ($tab === 'base') {
            $this->site_title = (string) ($old['site_title'] ?? $this->site_title);
            $this->connect_1_label = (string) ($old['connect_1_label'] ?? $this->connect_1_label);
            $this->connect_1_url = (string) ($old['connect_1_url'] ?? $this->connect_1_url);
            $this->connect_2_label = (string) ($old['connect_2_label'] ?? $this->connect_2_label);
            $this->connect_2_url = (string) ($old['connect_2_url'] ?? $this->connect_2_url);
            $this->connect_3_label = (string) ($old['connect_3_label'] ?? $this->connect_3_label);
            $this->connect_3_url = (string) ($old['connect_3_url'] ?? $this->connect_3_url);
        }
    }

    protected function accountRules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore(Auth::id()),
            ],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'current_password' => ['nullable', 'required_with:new_password', 'string'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'new_password_confirmation' => ['nullable', 'required_with:new_password', 'string'],
        ];
    }

    protected function baseRules(): array
    {
        return [
            'site_title' => ['required', 'string', 'max:100'],
            'site_logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'connect_1_label' => ['nullable', 'string', 'max:40', 'required_with:connect_1_url'],
            'connect_1_url' => ['nullable', 'string', 'max:255', 'required_with:connect_1_label', ...$this->connectUrlRules()],
            'connect_2_label' => ['nullable', 'string', 'max:40', 'required_with:connect_2_url'],
            'connect_2_url' => ['nullable', 'string', 'max:255', 'required_with:connect_2_label', ...$this->connectUrlRules()],
            'connect_3_label' => ['nullable', 'string', 'max:40', 'required_with:connect_3_url'],
            'connect_3_url' => ['nullable', 'string', 'max:255', 'required_with:connect_3_label', ...$this->connectUrlRules()],
        ];
    }

    protected function connectUrlRules(): array
    {
        return [
            function (string $attribute, $value, $fail): void {
                if ($value === null || $value === '') {
                    return;
                }

                $isValidUrl = filter_var($value, FILTER_VALIDATE_URL) !== false;
                $isMailto = str_starts_with($value, 'mailto:');

                if (! $isValidUrl && ! $isMailto) {
                    $fail('Gunakan URL valid atau format mailto:email@domain.com');
                }
            },
        ];
    }

    protected function accountMessages(): array
    {
        return [
            'name.required' => 'Nama user jangan dikosongin dong, masa admin anonim 😶',
            'name.min' => 'Nama user kependekan bro, minimal 3 karakter ya.',
            'name.max' => 'Nama user kepanjangan, form-nya ikut ngos-ngosan 😮‍💨',
            'email.required' => 'Email login wajib diisi, nanti mau masuk pakai telepati?',
            'email.email' => 'Format email-nya masih ngawur. Coba yang bener kayak `nama@domain.com`.',
            'email.unique' => 'Email ini udah dipakai akun lain. Jangan rebutan identitas dong.',
            'avatar.image' => 'Yang lo upload itu bukan gambar, jangan nyamar jadi avatar ya.',
            'avatar.mimes' => 'Avatar cuma nerima jpg, jpeg, png, atau webp. Yang lain ditolak satpam.',
            'avatar.max' => 'Avatar kegedean bro, maksimal 2MB aja biar server nggak mengeluh.',
            'current_password.required_with' => 'Kalau mau ganti password, password lama wajib ikut hadir.',
            'new_password.min' => 'Password baru terlalu pendek, minimal 8 karakter biar nggak gampang dijebol.',
            'new_password.confirmed' => 'Konfirmasi password baru beda jalur. Samain dulu biar akur.',
            'new_password_confirmation.required_with' => 'Konfirmasi password baru jangan ngilang, dia bagian dari tim.',
        ];
    }

    protected function baseMessages(): array
    {
        return [
            'site_title.required' => 'Judul blog wajib diisi. Masa brand lo tanpa nama?',
            'site_title.max' => 'Judul blog kepanjangan, nanti navbar bisa protes.',
            'site_logo.image' => 'Logo yang diupload harus gambar ya, jangan file siluman.',
            'site_logo.mimes' => 'Logo cuma boleh jpg, jpeg, png, atau webp. File aneh-aneh minggir dulu.',
            'site_logo.max' => 'Logo kegedean bro, tahan di maksimal 2MB.',
            'connect_1_label.required_with' => 'Kalau URL Connect 1 diisi, labelnya jangan ghosting.',
            'connect_2_label.required_with' => 'Kalau URL Connect 2 diisi, labelnya ikut nongol juga ya.',
            'connect_3_label.required_with' => 'Kalau URL Connect 3 diisi, labelnya jangan malu-malu.',
            'connect_1_url.required_with' => 'Label Connect 1 udah ada, URL-nya jangan kosong dong.',
            'connect_2_url.required_with' => 'Label Connect 2 udah ada, tinggal URL-nya dirapihin.',
            'connect_3_url.required_with' => 'Label Connect 3 udah ada, URL-nya jangan kabur.',
            'connect_1_label.max' => 'Label Connect 1 kepanjangan, footer bisa sempit napasnya.',
            'connect_2_label.max' => 'Label Connect 2 kepanjangan, pendekin dikit ya bro.',
            'connect_3_label.max' => 'Label Connect 3 terlalu panjang, footer-nya jadi ribet.',
            'connect_1_url.max' => 'URL Connect 1 kepanjangan, coba cek lagi link-nya.',
            'connect_2_url.max' => 'URL Connect 2 kepanjangan, coba diringkes atau cek copy-paste.',
            'connect_3_url.max' => 'URL Connect 3 kepanjangan, footer bisa mumet lihatnya.',
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'name' => 'nama user',
            'email' => 'email login',
            'avatar' => 'foto profil admin',
            'current_password' => 'password sekarang',
            'new_password' => 'password baru',
            'new_password_confirmation' => 'konfirmasi password baru',
            'site_title' => 'judul blog',
            'site_logo' => 'logo blog',
            'connect_1_label' => 'label connect 1',
            'connect_1_url' => 'URL connect 1',
            'connect_2_label' => 'label connect 2',
            'connect_2_url' => 'URL connect 2',
            'connect_3_label' => 'label connect 3',
            'connect_3_url' => 'URL connect 3',
        ];
    }

    protected function nullableTrim(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim($value);

        return $value === '' ? null : $value;
    }

    public function render()
    {
        return view('livewire.admin-settings')->layout('layouts.adminLayout', [
            'title' => 'Settings',
        ]);
    }
}
