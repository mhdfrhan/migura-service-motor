<?php

use App\Livewire\Admin\CustomerManagement;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(CustomerManagement::class)
        ->assertStatus(200);
});
