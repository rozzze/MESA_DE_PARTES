<?php

use App\Livewire\DocumentRequests\DocumentRequestCreate;
use App\Livewire\DocumentReviews\DocumentReviewsShow;
use App\Livewire\DocumentReviews\DocumentReviewsIndex;
use App\Livewire\DocumentType\DocumentTypeCreate;
use App\Livewire\DocumentType\DocumentTypeEdit;
use App\Livewire\DocumentType\DocumentTypeIndex;
use App\Livewire\Requirements\RequirementCreate;
use App\Livewire\Requirements\RequirementEdit;
use App\Livewire\Requirements\RequirementIndex;
use App\Livewire\Roles\RoleCreate;
use App\Livewire\Roles\RoleEdit;
use App\Livewire\Roles\RoleIndex;
use App\Livewire\Roles\RoleShow;
use App\Livewire\Solicitudes\SolicitudesIndex;
use App\Livewire\Users\UserIndex;
use App\Livewire\Users\UserCreate;
use App\Livewire\Users\UserEdit;
use App\Livewire\Users\UserShow;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get("users", UserIndex::class)->name("users.index");
    Route::get("users/create", UserCreate::class)->name("users.create");
    Route::get("users/{id}/edit", UserEdit::class)->name("users.edit");
    Route::get("users/{id}/show", UserShow::class)->name("users.show");

    Route::get("roles", RoleIndex::class)->name("roles.index");
    Route::get("roles/create", RoleCreate::class)->name("roles.create");
    Route::get("roles/{id}/edit", RoleEdit::class)->name("roles.edit");
    Route::get("roles/{id}", RoleShow::class)->name("roles.show");

    Route::get("requirements", RequirementIndex::class)->name("requirements.index");
    Route::get("requirements/create",RequirementCreate::class)->name("requirements.create");
    Route::get("requirements/{id}/edit",RequirementEdit::class)->name("requirements.edit");

    Route::get("document-types", DocumentTypeIndex::class)->name("doctype.index");
    Route::get("document-types/create", DocumentTypeCreate::class)->name("doctype.create");
    Route::get("document-types/{id}/edit", DocumentTypeEdit::class)->name("doctype.edit");

    Route::get('/document-requests/create', DocumentRequestCreate::class)->name('docrequest.create');

    Route::get('mis-solicitudes', SolicitudesIndex::class)->name('solicitudes.index');

    Route::get('document-reviews', DocumentReviewsIndex::class)->name('documentreviews.index');
    Route::get('document-reviews/{id}', DocumentReviewsShow::class)->name('documentreviews.show');
    
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
