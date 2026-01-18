<?php

namespace App\Livewire\Admin;

use App\Models\ServicePackage;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceManagement extends Component
{
    use WithPagination;

    public $search = '';

    public $filterStatus = 'all';

    public $editMode = false;

    public $packageId = null;

    // Form fields
    public $name = '';

    public $description = '';

    public $base_price = '';

    public $features = '';

    public $estimated_duration = '';

    public $is_popular = false;

    public $is_active = true;

    public $sort_order = 0;

    protected $queryString = ['search', 'filterStatus'];

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'base_price' => 'required|numeric|min:0',
            'features' => 'nullable|string',
            'estimated_duration' => 'required|integer|min:1',
            'is_popular' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
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

    public function openCreateModal()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->dispatch('open-modal', 'service-form-modal');
    }

    public function openEditModal($id)
    {
        $package = ServicePackage::findOrFail($id);

        $this->packageId = $package->id;
        $this->name = $package->name;
        $this->description = $package->description;
        $this->base_price = $package->base_price;
        $this->features = is_array($package->features) ? implode("\n", $package->features) : '';
        $this->estimated_duration = $package->estimated_duration;
        $this->is_popular = $package->is_popular;
        $this->is_active = $package->is_active;
        $this->sort_order = $package->sort_order;

        $this->editMode = true;
        $this->dispatch('open-modal', 'service-form-modal');
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->resetValidation();
        $this->dispatch('close-modal', 'service-form-modal');
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'base_price' => $this->base_price,
            'features' => $this->features ? array_filter(array_map('trim', explode("\n", $this->features))) : [],
            'estimated_duration' => $this->estimated_duration,
            'is_popular' => $this->is_popular,
            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
        ];

        if ($this->editMode) {
            $package = ServicePackage::findOrFail($this->packageId);
            $package->update($data);
            $message = 'Paket layanan berhasil diperbarui!';
        } else {
            ServicePackage::create($data);
            $message = 'Paket layanan berhasil ditambahkan!';
        }

        $this->closeModal();
        $this->dispatch('notify', type: 'success', message: $message);
    }

    public function toggleStatus($id)
    {
        $package = ServicePackage::findOrFail($id);
        $package->update(['is_active' => ! $package->is_active]);

        $status = $package->is_active ? 'diaktifkan' : 'dinonaktifkan';
        $this->dispatch('notify', type: 'success', message: "Paket layanan berhasil {$status}!");
    }

    public function togglePopular($id)
    {
        $package = ServicePackage::findOrFail($id);
        $package->update(['is_popular' => ! $package->is_popular]);

        $status = $package->is_popular ? 'ditandai sebagai populer' : 'dihapus dari populer';
        $this->dispatch('notify', type: 'success', message: "Paket layanan berhasil {$status}!");
    }

    public function confirmDelete($id)
    {
        $this->dispatch('confirm-delete', packageId: $id);
    }

    public function delete($id)
    {
        $package = ServicePackage::findOrFail($id);

        // Check if package has bookings
        if ($package->bookings()->exists()) {
            $this->dispatch('notify', type: 'error', message: 'Tidak dapat menghapus paket yang sudah digunakan untuk booking!');

            return;
        }

        $package->delete();
        $this->dispatch('notify', type: 'success', message: 'Paket layanan berhasil dihapus!');
    }

    private function resetForm()
    {
        $this->packageId = null;
        $this->name = '';
        $this->description = '';
        $this->base_price = '';
        $this->features = '';
        $this->estimated_duration = '';
        $this->is_popular = false;
        $this->is_active = true;
        $this->sort_order = 0;
    }

    public function render()
    {
        $packages = ServicePackage::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            })
            ->when($this->filterStatus !== 'all', function ($query) {
                $query->where('is_active', $this->filterStatus === 'active');
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.admin.service-management', [
            'packages' => $packages,
        ]);
    }
}
