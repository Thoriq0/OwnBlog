<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminSettingsController extends Controller
{
    public function updateAccount(Request $request): RedirectResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
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
            ],
            $this->accountMessages(),
            $this->validationAttributes(),
        );

        if ($validator->fails()) {
            return redirect()
                ->route('settings', ['tab' => 'account'])
                ->withErrors($validator)
                ->withInput($this->safeOldInput($request, 'account'))
                ->with('settings-error', 'Account settings belum lolos sensor. Ada field yang masih bandel tuh 👀');
        }

        $validated = $validator->validated();
        $user = Auth::user();

        if (! empty($validated['new_password']) && ! Hash::check($validated['current_password'], $user->password)) {
            return redirect()
                ->route('settings', ['tab' => 'account'])
                ->withErrors(['current_password' => 'Password saat ini tidak cocok.'])
                ->withInput($this->safeOldInput($request, 'account'))
                ->with('settings-error', 'Password lama lo ngadi-ngadi bro, nggak cocok sama yang di sistem 😵');
        }

        if ($request->hasFile('avatar')) {
            $newAvatarPath = $request->file('avatar')->store('avatars', 'public');

            if ($user->avatar_path) {
                Storage::disk('public')->delete($user->avatar_path);
            }

            $user->avatar_path = $newAvatarPath;
        }

        $user->name = trim($validated['name']);
        $user->email = trim($validated['email']);

        if (! empty($validated['new_password'])) {
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return redirect()
            ->route('settings', ['tab' => 'account'])
            ->with('settings-success', 'Sip, account settings lo udah kepoles rapi. Profil admin sekarang versi paling fresh ✨');
    }

    public function updateBase(Request $request): RedirectResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'site_title' => ['required', 'string', 'max:100'],
                'site_logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
                'connect_1_label' => ['nullable', 'string', 'max:40', 'required_with:connect_1_url'],
                'connect_1_url' => ['nullable', 'string', 'max:255', 'required_with:connect_1_label', ...$this->connectUrlRules()],
                'connect_2_label' => ['nullable', 'string', 'max:40', 'required_with:connect_2_url'],
                'connect_2_url' => ['nullable', 'string', 'max:255', 'required_with:connect_2_label', ...$this->connectUrlRules()],
                'connect_3_label' => ['nullable', 'string', 'max:40', 'required_with:connect_3_url'],
                'connect_3_url' => ['nullable', 'string', 'max:255', 'required_with:connect_3_label', ...$this->connectUrlRules()],
            ],
            $this->baseMessages(),
            $this->validationAttributes(),
        );

        if ($validator->fails()) {
            return redirect()
                ->route('settings', ['tab' => 'base'])
                ->withErrors($validator)
                ->withInput($this->safeOldInput($request, 'base'))
                ->with('settings-error', 'Base settings belum tembus. Biasanya sih ada URL connect yang lagi acting suspicious 🤨');
        }

        $validated = $validator->validated();
        $siteSetting = SiteSetting::current();

        if ($request->hasFile('site_logo')) {
            $newLogoPath = $request->file('site_logo')->store('site-branding', 'public');

            if ($siteSetting->site_logo_path) {
                Storage::disk('public')->delete($siteSetting->site_logo_path);
            }

            $siteSetting->site_logo_path = $newLogoPath;
        }

        $siteSetting->fill([
            'site_title' => trim($validated['site_title']),
            'connect_1_label' => $this->nullableTrim($validated['connect_1_label'] ?? null),
            'connect_1_url' => $this->nullableTrim($validated['connect_1_url'] ?? null),
            'connect_2_label' => $this->nullableTrim($validated['connect_2_label'] ?? null),
            'connect_2_url' => $this->nullableTrim($validated['connect_2_url'] ?? null),
            'connect_3_label' => $this->nullableTrim($validated['connect_3_label'] ?? null),
            'connect_3_url' => $this->nullableTrim($validated['connect_3_url'] ?? null),
        ])->save();

        SiteSetting::flushCache();

        return redirect()
            ->route('settings', ['tab' => 'base'])
            ->with('settings-success', 'Mantap, base settings berhasil disimpan. Branding sama connect footer sekarang ikut dandan 😎');
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

    protected function safeOldInput(Request $request, string $tab): array
    {
        $input = $request->except([
            'avatar',
            'site_logo',
            'current_password',
            'new_password',
            'new_password_confirmation',
        ]);

        $input['settings_tab'] = $tab;

        return $input;
    }
}
