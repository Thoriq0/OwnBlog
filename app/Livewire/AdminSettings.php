<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminSettings extends Component
{
    use WithFileUploads;

    public $name, $email, $avatar;
    public $current_password, $new_password, $confirm_password;
    public $darkMode = false;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->darkMode = $user->dark_mode ?? false;
    }

    public function updateSettings()
    {
        $user = Auth::user();

        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
        ]);

        // update password jika diisi
        if ($this->current_password && $this->new_password) {
            if (!Hash::check($this->current_password, $user->password)) {
                $this->addError('current_password', 'Current password is incorrect.');
                return;
            }

            $user->password = Hash::make($this->new_password);
        }

        // update avatar
        if ($this->avatar) {
            $path = $this->avatar->store('avatars', 'public');
            $user->avatar_url = "/storage/{$path}";
        }

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'dark_mode' => $this->darkMode,
        ]);

        session()->flash('message', 'Settings updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin-settings')->layout('layouts.adminLayout');
    }
}
