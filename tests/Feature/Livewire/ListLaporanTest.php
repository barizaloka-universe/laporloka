<?php

use Livewire\Volt\Volt;

it('can render', function () {
    $component = Volt::test('list_laporan');

    $component->assertSee('');
});
