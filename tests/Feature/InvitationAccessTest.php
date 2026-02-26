<?php

use App\Models\User;
use App\Models\Invitation;
use App\Models\Subscription;
use App\Models\Template;
use Illuminate\Support\Facades\Route;

beforeEach(function () {
    // Setup a dummy route that uses our middleware
    Route::get('/invitation/{invitation:slug}', function () {
        return 'Invitation Content';
    })->middleware('check.active.subscription')->name('invitation.show');
});

it('allows access to active subscription', function () {
    $user = User::factory()->create();
    $template = Template::create(['name' => 'T1', 'slug' => 't1', 'blade_path' => 't1.blade.php']);
    
    $invitation = Invitation::create([
        'user_id' => $user->id,
        'template_id' => $template->id,
        'slug' => 'johndoe',
    ]);

    $package = \App\Models\Package::create(['name' => 'Base', 'price' => 0, 'duration_days' => 10]);

    Subscription::create([
        'user_id' => $user->id,
        'package_id' => $package->id,
        'status' => 'active',
        'expires_at' => now()->addDays(3),
    ]);

    $response = $this->get('/invitation/johndoe');
    $response->assertStatus(200);
    $response->assertSee('Invitation Content');
});

it('blocks access to inactive subscription', function () {
    $user = User::factory()->create();
    $template = Template::create(['name' => 'T1', 'slug' => 't1', 'blade_path' => 't1.blade.php']);
    
    $invitation = Invitation::create([
        'user_id' => $user->id,
        'template_id' => $template->id,
        'slug' => 'janedoe',
    ]);

    $package = \App\Models\Package::create(['name' => 'Base', 'price' => 0, 'duration_days' => 10]);

    Subscription::create([
        'user_id' => $user->id,
        'package_id' => $package->id,
        'status' => 'active',
        'expires_at' => now()->subDays(1), // expired!
    ]);

    $response = $this->get('/invitation/janedoe');
    $response->assertStatus(403);
});
