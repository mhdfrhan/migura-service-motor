<?php

namespace App\Livewire\Admin;

use App\Exports\UsersExport;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserManagement extends Component
{
    use WithPagination;

    public $search = '';

    public $filterRole = 'all';

    public $filterStatus = 'all';

    public $selectedUser = null;

    // Form fields
    public $userId = null;

    public $name = '';

    public $email = '';

    public $phone = '';

    public $address = '';

    public $role = 'customer';

    public $is_active = true;

    public $password = '';

    public $password_confirmation = '';

    protected $listeners = ['refreshUsers' => '$refresh'];

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$this->userId,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'role' => 'required|in:customer,admin,staff',
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
        'role.required' => 'Role harus dipilih.',
        'password.required' => 'Password harus diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterRole()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function createUser()
    {
        $this->resetForm();
        $this->dispatch('open-modal', 'user-form-modal');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);

        // Prevent editing yourself's role
        if ($user->id === auth()->id()) {
            session()->flash('error', 'Anda tidak dapat mengedit akun sendiri!');
            return;
        }

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone ?? '';
        $this->address = $user->address ?? '';
        $this->role = $user->role;
        $this->is_active = $user->is_active;
        $this->password = '';
        $this->password_confirmation = '';

        $this->dispatch('open-modal', 'user-form-modal');
    }

    public function saveUser()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'role' => $this->role,
            'is_active' => $this->is_active,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            
            // Prevent changing your own role
            if ($user->id === auth()->id() && $data['role'] !== auth()->user()->role) {
                session()->flash('error', 'Anda tidak dapat mengubah role akun sendiri!');
                return;
            }

            $user->update($data);
            session()->flash('success', 'User berhasil diperbarui!');
        } else {
            User::create($data);
            session()->flash('success', 'User berhasil ditambahkan!');
        }

        $this->resetForm();
        $this->dispatch('close-modal', 'user-form-modal');
        $this->dispatch('refreshUsers');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun sendiri!');
            return;
        }

        $user->delete();
        session()->flash('success', 'User berhasil dihapus!');
        $this->dispatch('refreshUsers');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // Prevent deactivating yourself
        if ($user->id === auth()->id() && !$user->is_active) {
            session()->flash('error', 'Anda tidak dapat menonaktifkan akun sendiri!');
            return;
        }

        $user->update(['is_active' => !$user->is_active]);
        session()->flash('success', 'Status user berhasil diperbarui!');
        $this->dispatch('refreshUsers');
    }

    public function resetForm()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->address = '';
        $this->role = 'customer';
        $this->is_active = true;
        $this->password = '';
        $this->password_confirmation = '';
        $this->resetErrorBag();
    }

    public function export()
    {
        $filename = 'users-'.now()->format('Y-m-d-His').'.xlsx';

        return Excel::download(new UsersExport($this->search, $this->filterRole, $this->filterStatus), $filename);
    }

    public function render()
    {
        $users = User::when($this->filterRole !== 'all', function ($query) {
                $query->where('role', $this->filterRole);
            })
            ->when($this->filterStatus !== 'all', function ($query) {
                $query->where('is_active', $this->filterStatus === 'active');
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->orWhere('phone', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $stats = [
            'total' => User::count(),
            'admin' => User::where('role', 'admin')->count(),
            'staff' => User::where('role', 'staff')->count(),
            'customer' => User::where('role', 'customer')->count(),
            'active' => User::where('is_active', true)->count(),
            'inactive' => User::where('is_active', false)->count(),
        ];

        return view('livewire.admin.user-management', [
            'users' => $users,
            'stats' => $stats,
        ]);
    }
}
