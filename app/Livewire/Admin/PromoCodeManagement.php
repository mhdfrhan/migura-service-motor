<?php

namespace App\Livewire\Admin;

use App\Models\PromoCode;
use Livewire\Component;
use Livewire\WithPagination;

class PromoCodeManagement extends Component
{
    use WithPagination;

    public $search = '';

    public $filterStatus = 'all';

    public $promoCodeId = null;

    public $code = '';

    public $description = '';

    public $discountType = 'percentage';

    public $discountValue = 0;

    public $minTransaction = 0;

    public $maxDiscount = null;

    public $usageLimit = null;

    public $validFrom = '';

    public $validUntil = '';

    public $isActive = true;

    protected $listeners = ['refreshPromoCodes' => '$refresh'];

    protected function rules(): array
    {
        return [
            'code' => 'required|string|max:50|unique:promo_codes,code,'.$this->promoCodeId,
            'description' => 'required|string|max:500',
            'discountType' => 'required|in:percentage,fixed',
            'discountValue' => 'required|numeric|min:0',
            'minTransaction' => 'required|numeric|min:0',
            'maxDiscount' => 'nullable|numeric|min:0',
            'usageLimit' => 'nullable|integer|min:1',
            'validFrom' => 'required|date',
            'validUntil' => 'required|date|after_or_equal:validFrom',
            'isActive' => 'boolean',
        ];
    }

    protected $messages = [
        'code.required' => 'Kode promo harus diisi.',
        'code.unique' => 'Kode promo sudah digunakan.',
        'description.required' => 'Deskripsi harus diisi.',
        'discountType.required' => 'Tipe diskon harus dipilih.',
        'discountValue.required' => 'Nilai diskon harus diisi.',
        'discountValue.min' => 'Nilai diskon minimal 0.',
        'validFrom.required' => 'Tanggal mulai harus diisi.',
        'validUntil.required' => 'Tanggal berakhir harus diisi.',
        'validUntil.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal mulai.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function createPromoCode()
    {
        $this->resetForm();
        $this->dispatch('open-modal', 'promo-code-form-modal');
    }

    public function editPromoCode($id)
    {
        $promoCode = PromoCode::findOrFail($id);

        $this->promoCodeId = $promoCode->id;
        $this->code = $promoCode->code;
        $this->description = $promoCode->description;
        $this->discountType = $promoCode->discount_type;
        $this->discountValue = $promoCode->discount_value;
        $this->minTransaction = $promoCode->min_transaction;
        $this->maxDiscount = $promoCode->max_discount;
        $this->usageLimit = $promoCode->usage_limit;
        $this->validFrom = $promoCode->valid_from->format('Y-m-d');
        $this->validUntil = $promoCode->valid_until->format('Y-m-d');
        $this->isActive = $promoCode->is_active;

        $this->dispatch('open-modal', 'promo-code-form-modal');
    }

    public function savePromoCode()
    {
        $this->validate();

        $data = [
            'code' => strtoupper($this->code),
            'description' => $this->description,
            'discount_type' => $this->discountType,
            'discount_value' => $this->discountValue,
            'min_transaction' => $this->minTransaction,
            'max_discount' => $this->maxDiscount,
            'usage_limit' => $this->usageLimit,
            'valid_from' => $this->validFrom,
            'valid_until' => $this->validUntil,
            'is_active' => $this->isActive,
        ];

        if ($this->promoCodeId) {
            $promoCode = PromoCode::findOrFail($this->promoCodeId);
            $promoCode->update($data);
            session()->flash('success', 'Promo code berhasil diperbarui!');
        } else {
            PromoCode::create($data);
            session()->flash('success', 'Promo code berhasil ditambahkan!');
        }

        $this->resetForm();
        $this->dispatch('close-modal', 'promo-code-form-modal');
        $this->dispatch('refreshPromoCodes');
    }

    public function deletePromoCode($id)
    {
        $promoCode = PromoCode::findOrFail($id);

        // Check if promo code has been used
        if ($promoCode->usages()->count() > 0) {
            $this->dispatch('notify', type: 'error', message: 'Promo code tidak dapat dihapus karena sudah digunakan!');

            return;
        }

        $promoCode->delete();
        session()->flash('success', 'Promo code berhasil dihapus!');
        $this->dispatch('refreshPromoCodes');
    }

    public function toggleStatus($id)
    {
        $promoCode = PromoCode::findOrFail($id);
        $promoCode->update(['is_active' => ! $promoCode->is_active]);
        session()->flash('success', 'Status promo code berhasil diperbarui!');
        $this->dispatch('refreshPromoCodes');
    }

    public function resetForm()
    {
        $this->promoCodeId = null;
        $this->code = '';
        $this->description = '';
        $this->discountType = 'percentage';
        $this->discountValue = 0;
        $this->minTransaction = 0;
        $this->maxDiscount = null;
        $this->usageLimit = null;
        $this->validFrom = '';
        $this->validUntil = '';
        $this->isActive = true;
        $this->resetErrorBag();
    }

    public function render()
    {
        $promoCodes = PromoCode::query()
            ->when($this->filterStatus !== 'all', function ($query) {
                if ($this->filterStatus === 'active') {
                    $query->where('is_active', true)
                        ->where('valid_from', '<=', today())
                        ->where('valid_until', '>=', today());
                } elseif ($this->filterStatus === 'inactive') {
                    $query->where('is_active', false);
                } elseif ($this->filterStatus === 'expired') {
                    $query->where('valid_until', '<', today());
                }
            })
            ->when($this->search, function ($query) {
                $query->where('code', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $stats = [
            'total' => PromoCode::count(),
            'active' => PromoCode::where('is_active', true)
                ->where('valid_from', '<=', today())
                ->where('valid_until', '>=', today())
                ->count(),
            'inactive' => PromoCode::where('is_active', false)->count(),
            'expired' => PromoCode::where('valid_until', '<', today())->count(),
        ];

        return view('livewire.admin.promo-code-management', [
            'promoCodes' => $promoCodes,
            'stats' => $stats,
        ]);
    }
}
