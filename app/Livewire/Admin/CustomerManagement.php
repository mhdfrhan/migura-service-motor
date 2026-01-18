<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class CustomerManagement extends Component
{
    use WithPagination;

    public $search = '';

    public $filterRole = 'all';

    public $filterStatus = 'all';

    public $sortBy = 'created_at';

    public $sortDirection = 'desc';

    public $selectedUser = null;

    // Edit form
    public $userId = null;

    public $name = '';

    public $email = '';

    public $phone = '';

    public $address = '';

    public $role = 'customer';

    public $is_active = true;

    public $password = '';

    public $password_confirmation = '';

    protected $queryString = ['search', 'filterRole', 'filterStatus', 'sortBy', 'sortDirection'];

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$this->userId,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'role' => 'required|in:customer,admin,staff',
            'is_active' => 'boolean',
        ];

        if ($this->password) {
            $rules['password'] = 'min:8|confirmed';
        }

        return $rules;
    }

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

    public function sortByColumn($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function viewDetail($id)
    {
        $this->selectedUser = User::withCount([
            'bookings',
            'reviews',
            'notifications',
        ])
            ->with(['bookings' => function ($query) {
                $query->latest()->limit(5);
            }])
            ->findOrFail($id);

        // Calculate total spent
        $this->selectedUser->total_spent = $this->selectedUser->bookings()
            ->whereIn('status', ['completed'])
            ->sum('total_price');

        $this->dispatch('open-modal', 'user-detail-modal');
    }

    public function closeDetailModal()
    {
        $this->dispatch('close-modal', 'user-detail-modal');
        $this->selectedUser = null;
    }

    public function openEditModal($id)
    {
        $user = User::findOrFail($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->role = $user->role;
        $this->is_active = $user->is_active;
        $this->password = '';
        $this->password_confirmation = '';

        $this->dispatch('open-modal', 'user-edit-modal');
    }

    public function closeEditModal()
    {
        $this->dispatch('close-modal', 'user-edit-modal');
        $this->resetForm();
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        $user = User::findOrFail($this->userId);

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

        $user->update($data);

        $this->closeEditModal();
        $this->dispatch('notify', type: 'success', message: 'Data pengguna berhasil diperbarui!');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_active' => ! $user->is_active]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        $this->dispatch('notify', type: 'success', message: "Pengguna berhasil {$status}!");
    }

    public function confirmDelete($id)
    {
        $this->dispatch('confirm-delete', userId: $id);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting current user
        if ($user->id === auth()->id()) {
            $this->dispatch('notify', type: 'error', message: 'Tidak dapat menghapus akun sendiri!');

            return;
        }

        // Check if user has bookings
        if ($user->bookings()->exists()) {
            $this->dispatch('notify', type: 'error', message: 'Tidak dapat menghapus pengguna yang memiliki booking!');

            return;
        }

        $user->delete();
        $this->dispatch('notify', type: 'success', message: 'Pengguna berhasil dihapus!');
    }

    private function resetForm()
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
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->orWhere('phone', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->filterRole !== 'all', function ($query) {
                $query->where('role', $this->filterRole);
            })
            ->when($this->filterStatus !== 'all', function ($query) {
                $query->where('is_active', $this->filterStatus === 'active');
            })
            ->withCount('bookings')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(15);

        $stats = [
            'total_users' => User::count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'total_staff' => User::where('role', 'staff')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'active_users' => User::where('is_active', true)->count(),
            'inactive_users' => User::where('is_active', false)->count(),
        ];

        return view('livewire.admin.customer-management', [
            'users' => $users,
            'stats' => $stats,
        ]);
    }
}
