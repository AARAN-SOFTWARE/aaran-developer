<?php

namespace App\Livewire\Trait;

use Illuminate\Support\Carbon;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;

trait CommonTrait
{
    use WithPagination;

    public $start_date;
    public $end_date;
    public $filter;
    public $byOrder;
    public bool $showEditModal = false;
    public bool $showFilters = false;
    public bool $showDeleteModal = false;

    public bool $sortAsc = true;
    public string $perPage = "100";
    public string $activeRecord = "1";

    public string $searches = "";
    public string $vid = "";
    #[Rule('required')]
    public string $vname = '';
    public bool $active_id = false;
    public string $sortField = 'vname';

    public function rules(): array
    {
        return [
            'vname' => 'required',
        ];
    }

    public function toggleShowFilters(): void
    {
        $this->showFilters = !$this->showFilters;
    }

    public function deleteSelect($id): void
    {
        $this->showDeleteModal = true;
        $this->vid = $id;
    }

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }

    public function create(): void
    {
        $this->clearFields();
        $this->showEditModal = true;
    }

    public function clearFields(): void
    {
        $this->vid = '';
        $this->vname = '';
        $this->active_id = '1';
        $this->searches = '';
        $this->order_name='';
        $this->desc='';

    }

    public function resetFilters()
    {
        $this->activeRecord='1';
        $this->resetPage();
        $this->showFilters = false;
        $this->start_date='';
        $this->end_date='';
        $this->filter='';
        $this->byOrder='';
    }

    public function save(): void
    {
        $message = $this->getSave();
        session()->flash('success', '"' . $this->vname . '"  has been' . $message . ' .');
        $this->clearFields();
        $this->showEditModal = false;
    }

    public function edit($id): void
    {
        $this->clearFields();
        $this->getObj($id);
        $this->showEditModal = true;
    }

    public function getDelete($id): void
    {
        if ($id) {
            $this->clearFields();
            $this->getObj($id);
            $this->showDeleteModal = true;
        }
    }

    public function delete(): void
    {

        if ($this->vid) {
            $obj = $this->getObj($this->vid);
            $obj->delete();
            $this->showDeleteModal = false;
            $this->clearFields();
        }
    }
}
