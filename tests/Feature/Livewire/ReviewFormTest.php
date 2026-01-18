<?php

use App\Livewire\ReviewForm;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ReviewForm::class)
        ->assertStatus(200);
});
