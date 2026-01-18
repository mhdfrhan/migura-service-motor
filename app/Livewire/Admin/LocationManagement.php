<?php

namespace App\Livewire\Admin;

use App\Models\Location;
use Livewire\Component;
use Livewire\WithPagination;

class LocationManagement extends Component
{
    use WithPagination;

    public $search = '';

    public $filterStatus = 'all';

    public $sortBy = 'sort_order';

    public $sortDirection = 'asc';

    public $selectedLocation = null;

    // Form fields
    public $locationId = null;

    public $name = '';

    public $code = '';

    public $address = '';

    public $latitude = null;

    public $longitude = null;

    public $phone = '';

    public $email = '';

    public $open_time = '08:00';

    public $close_time = '20:00';

    public $operating_days = [];

    public $max_service_radius_km = 10;

    public $daily_capacity = 50;

    public $slot_capacity = 5;

    public $is_active = true;

    public $is_main_branch = false;

    public $sort_order = 0;

    public $description = '';

    public $facilities = [];

    protected $queryString = ['search', 'filterStatus', 'sortBy', 'sortDirection'];

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:locations,code,'.$this->locationId,
            'address' => 'required|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'open_time' => 'required',
            'close_time' => 'required',
            'operating_days' => 'required|array|min:1',
            'max_service_radius_km' => 'required|numeric|min:1|max:100',
            'daily_capacity' => 'required|integer|min:1',
            'slot_capacity' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'is_main_branch' => 'boolean',
            'sort_order' => 'integer',
            'description' => 'nullable|string',
            'facilities' => 'array',
        ];
    }

    public function updatingSearch()
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

    public function openCreateModal()
    {
        $this->resetForm();
        $this->dispatch('open-modal', 'location-form-modal');
    }

    public function openEditModal($id)
    {
        $location = Location::findOrFail($id);

        $this->locationId = $location->id;
        $this->name = $location->name;
        $this->code = $location->code;
        $this->address = $location->address;
        $this->latitude = $location->latitude;
        $this->longitude = $location->longitude;
        $this->phone = $location->phone;
        $this->email = $location->email;
        $this->open_time = $location->open_time;
        $this->close_time = $location->close_time;
        $this->operating_days = $location->operating_days ?? [];
        $this->max_service_radius_km = $location->max_service_radius_km;
        $this->daily_capacity = $location->daily_capacity;
        $this->slot_capacity = $location->slot_capacity;
        $this->is_active = $location->is_active;
        $this->is_main_branch = $location->is_main_branch;
        $this->sort_order = $location->sort_order;
        $this->description = $location->description;
        $this->facilities = $location->facilities ?? [];

        $this->dispatch('open-modal', 'location-form-modal');
    }

    public function viewDetail($id)
    {
        $this->selectedLocation = Location::findOrFail($id);
        $this->dispatch('open-modal', 'location-detail-modal');
    }

    public function closeDetailModal()
    {
        $this->dispatch('close-modal', 'location-detail-modal');
        $this->selectedLocation = null;
    }

    public function editFromDetail($id)
    {
        // Close detail modal first
        $this->dispatch('close-modal', 'location-detail-modal');
        $this->selectedLocation = null;

        // Wait a moment then open edit modal
        $this->dispatch('open-edit-delayed', id: $id);
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'code' => $this->code,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'phone' => $this->phone,
            'email' => $this->email,
            'open_time' => $this->open_time,
            'close_time' => $this->close_time,
            'operating_days' => $this->operating_days,
            'max_service_radius_km' => $this->max_service_radius_km,
            'daily_capacity' => $this->daily_capacity,
            'slot_capacity' => $this->slot_capacity,
            'is_active' => $this->is_active,
            'is_main_branch' => $this->is_main_branch,
            'sort_order' => $this->sort_order,
            'description' => $this->description,
            'facilities' => $this->facilities,
        ];

        if ($this->locationId) {
            $location = Location::findOrFail($this->locationId);
            $location->update($data);
            $message = 'Lokasi berhasil diperbarui!';
        } else {
            Location::create($data);
            $message = 'Lokasi berhasil ditambahkan!';
        }

        $this->dispatch('close-modal', 'location-form-modal');
        $this->resetForm();
        $this->dispatch('notify', type: 'success', message: $message);
    }

    public function toggleStatus($id)
    {
        $location = Location::findOrFail($id);
        $location->update(['is_active' => ! $location->is_active]);

        $status = $location->is_active ? 'diaktifkan' : 'dinonaktifkan';
        $this->dispatch('notify', type: 'success', message: "Lokasi berhasil {$status}!");
    }

    public function confirmDelete($id)
    {
        $this->dispatch('confirm-delete', locationId: $id);
    }

    public function delete($id)
    {
        $location = Location::findOrFail($id);

        // Check if location is used in bookings
        // if ($location->bookings()->exists()) {
        //     $this->dispatch('notify', type: 'error', message: 'Tidak dapat menghapus lokasi yang memiliki booking!');
        //     return;
        // }

        $location->delete();
        $this->dispatch('notify', type: 'success', message: 'Lokasi berhasil dihapus!');
    }

    private function resetForm()
    {
        $this->locationId = null;
        $this->name = '';
        $this->code = '';
        $this->address = '';
        $this->latitude = null;
        $this->longitude = null;
        $this->phone = '';
        $this->email = '';
        $this->open_time = '08:00';
        $this->close_time = '20:00';
        $this->operating_days = [];
        $this->max_service_radius_km = 10;
        $this->daily_capacity = 50;
        $this->slot_capacity = 5;
        $this->is_active = true;
        $this->is_main_branch = false;
        $this->sort_order = 0;
        $this->description = '';
        $this->facilities = [];
        $this->resetValidation();
    }

    public function render()
    {
        $locations = Location::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('code', 'like', '%'.$this->search.'%')
                        ->orWhere('address', 'like', '%'.$this->search.'%')
                        ->orWhere('phone', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->filterStatus !== 'all', function ($query) {
                $query->where('is_active', $this->filterStatus === 'active');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        $stats = [
            'total_locations' => Location::count(),
            'active_locations' => Location::where('is_active', true)->count(),
            'inactive_locations' => Location::where('is_active', false)->count(),
            'main_branches' => Location::where('is_main_branch', true)->count(),
        ];

        return view('livewire.admin.location-management', [
            'locations' => $locations,
            'stats' => $stats,
        ]);
    }
}
