<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
	use WithFileUploads;

	public string $name = '';
	public string $email = '';
	public string $phone = '';
	public string $password = '';
	public string $password_confirmation = '';
	public $avatar;
	public ?string $currentAvatar = null;

	public function mount(): void
	{
		$user = Auth::user();
		$this->name = $user->name ?? '';
		$this->email = $user->email ?? '';
		$this->phone = $user->phone ?? '';
		$this->currentAvatar = $user->avatar;
	}

	public function updatedAvatar(): void
	{
		$this->validate([
			'avatar' => 'image|max:2048', // 2MB max
		], [
			'avatar.image' => 'File harus berupa gambar',
			'avatar.max' => 'Ukuran file maksimal 2MB',
		]);
	}

	public function removeAvatar(): void
	{
		$this->avatar = null;
	}

	public function save(): void
	{
		$rules = [
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
			'phone' => ['nullable', 'string', 'max:20'],
		];

		// Only validate password if it's being changed
		if ($this->password) {
			$rules['password'] = ['required', 'confirmed', Password::defaults()];
		}

		$this->validate($rules, [
			'name.required' => 'Nama harus diisi',
			'email.required' => 'Email harus diisi',
			'email.email' => 'Format email tidak valid',
			'email.unique' => 'Email sudah digunakan',
			'password.confirmed' => 'Konfirmasi password tidak cocok',
		]);

		$user = Auth::user();

		// Handle avatar upload
		if ($this->avatar) {
			// Delete old avatar if exists
			if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
				Storage::disk('public')->delete($user->avatar);
			}

			// Store new avatar
			$avatarPath = $this->avatar->store('avatars', 'public');
			$user->avatar = $avatarPath;
		}

		// Update user details
		$user->name = $this->name;
		$user->email = $this->email;
		$user->phone = $this->phone;

		// Update password if provided
		if ($this->password) {
			$user->password = Hash::make($this->password);
		}

		$user->save();

		// Log activity
		logActivity('updated_profile', 'User', $user->id);

		// Reset password fields
		$this->password = '';
		$this->password_confirmation = '';
		$this->avatar = null;
		$this->currentAvatar = $user->avatar;

		$this->dispatch('notify', type: 'success', message: 'Profil berhasil diperbarui!');
	}

	public function getAvatarUrlProperty(): string
	{
		if ($this->avatar) {
			return $this->avatar->temporaryUrl();
		}

		if ($this->currentAvatar) {
			return Storage::url($this->currentAvatar);
		}

		// Default avatar
		return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=0ea5e9&color=fff&size=200';
	}

	public function render()
	{
		return view('livewire.edit-profile');
	}
}
