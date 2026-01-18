<?php

namespace App\Livewire\Admin;

use App\Models\PaymentMethod;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentMethodManagement extends Component
{
	use WithPagination;

	public bool $editMode = false;
	public ?int $methodId = null;

	// Form fields
	public string $type = 'bank_transfer';
	public string $name = '';
	public string $code = '';
	public string $account_number = '';
	public string $account_name = '';
	public string $icon_color = '#0ea5e9';
	public bool $is_active = true;
	public int $sort_order = 0;

	protected function rules(): array
	{
		$uniqueRule = 'unique:payment_methods,code';
		if ($this->methodId) {
			$uniqueRule .= ',' . $this->methodId;
		}

		return [
			'type' => 'required|in:bank_transfer,e_wallet',
			'name' => 'required|string|max:255',
			'code' => 'required|string|max:50|' . $uniqueRule,
			'account_number' => 'nullable|string|max:50',
			'account_name' => 'required|string|max:255',
			'icon_color' => 'required|string|max:20',
			'is_active' => 'boolean',
			'sort_order' => 'integer|min:0',
		];
	}

	protected $messages = [
		'name.required' => 'Nama metode pembayaran harus diisi',
		'code.required' => 'Kode harus diisi',
		'code.unique' => 'Kode sudah digunakan',
		'account_name.required' => 'Nama pemilik rekening harus diisi',
	];

	public function openCreateModal(): void
	{
		$this->resetForm();
		$this->editMode = false;
		$this->dispatch('open-modal', 'payment-method-form-modal');
	}

	public function openEditModal(int $id): void
	{
		$method = PaymentMethod::findOrFail($id);
		$this->methodId = $method->id;
		$this->type = $method->type;
		$this->name = $method->name;
		$this->code = $method->code;
		$this->account_number = $method->account_number ?? '';
		$this->account_name = $method->account_name;
		$this->icon_color = $method->icon_color;
		$this->is_active = $method->is_active;
		$this->sort_order = $method->sort_order;
		$this->editMode = true;
		$this->dispatch('open-modal', 'payment-method-form-modal');
	}

	public function closeModal(): void
	{
		$this->resetForm();
		$this->resetValidation();
		$this->dispatch('close-modal', 'payment-method-form-modal');
	}

	public function save(): void
	{
		$this->validate();

		$data = [
			'type' => $this->type,
			'name' => $this->name,
			'code' => $this->code,
			'account_number' => $this->account_number,
			'account_name' => $this->account_name,
			'icon_color' => $this->icon_color,
			'is_active' => $this->is_active,
			'sort_order' => $this->sort_order,
		];

		if ($this->editMode && $this->methodId) {
			$method = PaymentMethod::findOrFail($this->methodId);
			$method->update($data);
			logActivity('updated_payment_method', PaymentMethod::class, $this->methodId);
			$message = 'Metode pembayaran berhasil diperbarui!';
		} else {
			$method = PaymentMethod::create($data);
			logActivity('created_payment_method', PaymentMethod::class, $method->id);
			$message = 'Metode pembayaran berhasil ditambahkan!';
		}

		$this->closeModal();
		$this->dispatch('notify', type: 'success', message: $message);
	}

	public function toggleActive(int $id): void
	{
		$method = PaymentMethod::findOrFail($id);
		$method->is_active = !$method->is_active;
		$method->save();

		$status = $method->is_active ? 'diaktifkan' : 'dinonaktifkan';
		logActivity('toggled_payment_method', PaymentMethod::class, $id, [], ['is_active' => $method->is_active]);
		$this->dispatch('notify', type: 'success', message: "Metode pembayaran berhasil {$status}!");
	}

	public function confirmDelete(int $id): void
	{
		$this->dispatch('confirm-delete', methodId: $id);
	}

	public function delete(int $id): void
	{
		$method = PaymentMethod::findOrFail($id);
		logActivity('deleted_payment_method', PaymentMethod::class, $id, ['name' => $method->name]);
		$method->delete();

		$this->dispatch('notify', type: 'success', message: 'Metode pembayaran berhasil dihapus!');
	}

	protected function resetForm(): void
	{
		$this->methodId = null;
		$this->type = 'bank_transfer';
		$this->name = '';
		$this->code = '';
		$this->account_number = '';
		$this->account_name = '';
		$this->icon_color = '#0ea5e9';
		$this->is_active = true;
		$this->sort_order = 0;
	}

	public function render()
	{
		$paymentMethods = PaymentMethod::orderBy('type')
			->orderBy('sort_order')
			->paginate(10);

		$stats = [
			'total' => PaymentMethod::count(),
			'active' => PaymentMethod::where('is_active', true)->count(),
			'banks' => PaymentMethod::where('type', 'bank_transfer')->count(),
			'wallets' => PaymentMethod::where('type', 'e_wallet')->count(),
		];

		return view('livewire.admin.payment-method-management', [
			'paymentMethods' => $paymentMethods,
			'stats' => $stats,
		]);
	}
}
