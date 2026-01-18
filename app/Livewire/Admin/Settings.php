<?php

namespace App\Livewire\Admin;

use App\Models\SystemSetting;
use Livewire\Component;

class Settings extends Component
{
    public $settings = [];

    public $editingKey = null;

    public $editValue = '';

    public $editType = 'string';

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $this->settings = SystemSetting::orderBy('key')->get()->mapWithKeys(function ($setting) {
            return [$setting->key => [
                'id' => $setting->id,
                'key' => $setting->key,
                'value' => $setting->typed_value,
                'type' => $setting->type,
                'description' => $setting->description,
            ]];
        })->toArray();
    }

    public function startEdit($key)
    {
        $this->editingKey = $key;
        $this->editValue = is_array($this->settings[$key]['value']) 
            ? json_encode($this->settings[$key]['value'], JSON_PRETTY_PRINT)
            : (string) $this->settings[$key]['value'];
        $this->editType = $this->settings[$key]['type'];
    }

    public function cancelEdit()
    {
        $this->editingKey = null;
        $this->editValue = '';
        $this->editType = 'string';
    }

    public function saveSetting($key)
    {
        $this->validate([
            'editValue' => 'required',
            'editType' => 'required|in:string,integer,boolean,json,array',
        ]);

        $setting = SystemSetting::where('key', $key)->first();

        if (!$setting) {
            session()->flash('error', 'Setting tidak ditemukan');
            return;
        }

        // Convert value based on type
        $value = match ($this->editType) {
            'integer' => (int) $this->editValue,
            'boolean' => filter_var($this->editValue, FILTER_VALIDATE_BOOLEAN),
            'json', 'array' => json_decode($this->editValue, true),
            default => $this->editValue,
        };

        $setting->value = match ($this->editType) {
            'boolean' => $value ? 'true' : 'false',
            'json', 'array' => json_encode($value),
            default => (string) $value,
        };

        $setting->type = $this->editType;
        $setting->save();

        // Clear cache
        \Illuminate\Support\Facades\Cache::forget("setting.{$key}");

        session()->flash('success', 'Setting berhasil diperbarui!');
        $this->loadSettings();
        $this->cancelEdit();
    }

    public function render()
    {
        return view('livewire.admin.settings');
    }
}
