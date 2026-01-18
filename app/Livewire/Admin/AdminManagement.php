<?php

namespace App\Livewire\Admin;

use App\Exports\AdminsExport;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AdminManagement extends Component
{
    use WithPagination;

    public $search = '';

    public $selectedUser = null;

    // Form fields
    public $userId = null;

    public $name = '';

    public $email = '';

    public $phone = '';

    public $password = '';

    public $password_confirmation = '';

    public $is_active = true;

    protected $listeners = ['refreshAdmins' => '$refresh'];

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$this->userId,
            'phone' => 'nullable|string|max:20',
            'is_active' => 'boolean',
        ];

        if ($this->userId) {
            // Update: password optional
            if ($this->password) {
                $rules['password'] = 'required|min:8|confirmed';
            }
        } else {
            // Create: password required
            $rules['password'] = 'required|min:8|confirmed';
        }

        return $rules;
    }

    protected $messages = [
        'name.required' => 'Nama harus diisi.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'password.required' => 'Password harus diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createAdmin()
    {
        $this->resetForm();
        $this->dispatch('open-modal', 'admin-form-modal');
    }

    public function editAdmin($id)
    {
        $user = User::where('id', $id)->where('role', 'admin')->firstOrFail();

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone ?? '';
        $this->is_active = $user->is_active;
        $this->password = '';
        $this->password_confirmation = '';

        $this->dispatch('open-modal', 'admin-form-modal');
    }

    public function saveAdmin()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => 'admin',
            'is_active' => $this->is_active,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $user->update($data);
            session()->flash('success', 'Admin berhasil diperbarui!');
        } else {
            User::create($data);
            session()->flash('success', 'Admin berhasil ditambahkan!');
        }

        $this->resetForm();
        $this->dispatch('close-modal', 'admin-form-modal');
        $this->dispatch('refreshAdmins');
    }

    public function deleteAdmin($id)
    {
        $user = User::where('id', $id)->where('role', 'admin')->firstOrFail();

        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun sendiri!');
            return;
        }

        $user->delete();
        session()->flash('success', 'Admin berhasil dihapus!');
        $this->dispatch('refreshAdmins');
    }

    public function toggleStatus($id)
    {
        $user = User::where('id', $id)->where('role', 'admin')->firstOrFail();

        // Prevent deactivating yourself
        if ($user->id === auth()->id() && !$user->is_active) {
            session()->flash('error', 'Anda tidak dapat menonaktifkan akun sendiri!');
            return;
        }

        $user->update(['is_active' => !$user->is_active]);
        session()->flash('success', 'Status admin berhasil diperbarui!');
        $this->dispatch('refreshAdmins');
    }

    public function resetForm()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->is_active = true;
        $this->resetErrorBag();
    }

    public function export()
    {
        $filename = 'admins-'.now()->format('Y-m-d-His').'.xlsx';

        return Excel::download(new AdminsExport($this->search), $filename);
    }

    public function render()
    {
        $admins = User::where('role', 'admin')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->orWhere('phone', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $stats = [
            'total' => User::where('role', 'admin')->count(),
            'active' => User::where('role', 'admin')->where('is_active', true)->count(),
            'inactive' => User::where('role', 'admin')->where('is_active', false)->count(),
        ];

        return view('livewire.admin.admin-management', [
            'admins' => $admins,
            'stats' => $stats,
        ]);
    }
}
