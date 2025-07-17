<?php

namespace App\Livewire\DocumentType;

use App\Models\DocumentType;
use App\Models\Role; // Importa el modelo Role
use Livewire\Component;

class DocumentTypeIndex extends Component
{
    public $documentTypes;
    public $roles; // Propiedad para almacenar todos los roles
    public $filterRole = ''; // Propiedad para el filtro de rol, inicializada vacía

    protected $listeners = ['delete' => 'delete'];

    public function mount()
    {
        // Carga todos los roles disponibles una sola vez al montar el componente
        $this->roles = Role::all();
        // Llama al método para cargar los tipos de documento inicialmente
        $this->loadDocumentTypes();
    }

    // Método para cargar y aplicar los filtros a los tipos de documento
    public function loadDocumentTypes()
    {
        $query = DocumentType::with(['requirements', 'roles']);

        // Aplicar filtro por rol si está seleccionado
        if (!empty($this->filterRole)) {
            $query->whereHas('roles', function ($q) {
                $q->where('roles.id', $this->filterRole);
            });
        }

        $this->documentTypes = $query->get();
    }

    // Método que se ejecuta automáticamente cuando filterRole cambia
    public function updatedFilterRole()
    {
        $this->loadDocumentTypes(); // Recarga los tipos de documento con el nuevo filtro
    }

    // Método para limpiar todos los filtros
    public function clearFilters()
    {
        $this->filterRole = ''; // Resetea el filtro de rol
        $this->loadDocumentTypes(); // Recarga los tipos de documento sin filtros
    }

    // ***** NUEVO MÉTODO PARA MOSTRAR DESCRIPCIÓN *****
    public function showDescription($id)
    {
        $docType = DocumentType::findOrFail($id);
        // Retorna un array con el título y la descripción
        return [
            'title' => 'Descripción de ' . $docType->nombre,
            'description' => $docType->descripcion,
        ];
    }
    // ************************************************

    public function delete($id)
    {
        $docType = DocumentType::findOrFail($id);
        $docType->requirements()->detach();
        $docType->roles()->detach();
        $docType->delete();

        $this->loadDocumentTypes(); // Recarga los tipos de documento después de eliminar
        session()->flash('success', 'Tipo de documento eliminado correctamente.');
    }

    public function render()
    {
        return view('livewire.document-type.document-type-index');
    }
}