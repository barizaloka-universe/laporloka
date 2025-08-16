<?php

use Livewire\Volt\Volt;

it('can render', function () {
    $component = Volt::test('buat_laporan');

    $component->assertSee('');
});
