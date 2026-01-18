<?php

use App\Livewire\Admin\LocationManagement;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(LocationManagement::class)
        ->assertStatus(200);
});
