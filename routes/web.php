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

    Route::get("users", UserIndex::class)->name("users.index")->middleware("permission:ver-usuarios|crear-usuario|editar-usuario|eliminar-usuario");
    Route::get("users/create", UserCreate::class)->name("users.create")->middleware("permission:crear-usuario");
    Route::get("users/{id}/edit", UserEdit::class)->name("users.edit")->middleware("permission:editar-usuario");
    Route::get("users/{id}/show", UserShow::class)->name("users.show");

    Route::get("roles", RoleIndex::class)->name("roles.index")->middleware("permission:administrar-roles");
    Route::get("roles/create", RoleCreate::class)->name("roles.create")->middleware("permission:administrar-roles");
    Route::get("roles/{id}/edit", RoleEdit::class)->name("roles.edit")->middleware("permission:administrar-roles");
    Route::get("roles/{id}", RoleShow::class)->name("roles.show")->middleware("permission:administrar-roles");

    Route::get("requirements", RequirementIndex::class)->name("requirements.index")->middleware("permission:ver-requisitos|crear-requisito|editar-requisito|eliminar-requisito");
    Route::get("requirements/create",RequirementCreate::class)->name("requirements.create")->middleware("permission:crear-requisito");
    Route::get("requirements/{id}/edit",RequirementEdit::class)->name("requirements.edit")->middleware("permission:editar-requisito");

    Route::get("document-types", DocumentTypeIndex::class)->name("doctype.index")->middleware("permission:ver-documentos|crear-documento|editar-documento|eliminar-documento");
    Route::get("document-types/create", DocumentTypeCreate::class)->name("doctype.create")->middleware("permission:crear-documento");
    Route::get("document-types/{id}/edit", DocumentTypeEdit::class)->name("doctype.edit")->middleware("permission:editar-documento");

    Route::get('/document-requests/create', DocumentRequestCreate::class)->name('docrequest.create')->middleware("permission:crear-solicitud");

    Route::get('mis-solicitudes', SolicitudesIndex::class)->name('solicitudes.index')->middleware("permission:ver-mis-solicitudes");

    Route::get('document-reviews', DocumentReviewsIndex::class)->name('documentreviews.index')->middleware("permission:ver-solicitudes|atender-solicitud");
    Route::get('document-reviews/{id}', DocumentReviewsShow::class)->name('documentreviews.show')->middleware("permission:aprobar-solicitud|rechazar-solicitud");
    
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
