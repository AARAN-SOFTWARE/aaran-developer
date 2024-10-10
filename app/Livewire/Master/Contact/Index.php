<?php

namespace App\Livewire\Master\Contact;


use Aaran\Master\Models\Contact;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    public function create(): void
    {
        $this->redirect(route('contacts.upsert', ['0']));
    }

    public function getObj($id)
    {
        if ($id) {
            $obj = Contact::find($id);
            $this->common->vid = $obj->id;
            return $obj;
        }
        return null;
    }

    public function trashData(): void
    {
        $obj = $this->getObj($this->common->vid);
        DB::table('contact_details')->where('contact_id', '=', $this->common->vid)->delete();
        $obj->delete();
        $this->showDeleteModal = false;
    }

    public function getList()
    {
        return Contact::select(
            'contacts.*',
            'contact_type.vname as contact_type',
            'msme_type.vname as msme_type',
        )
            ->where('contacts.company_id',session()->get('company_id'))
            ->where('contacts.active_id',$this->getListForm->activeRecord)
            ->join('commons as contact_type', 'contact_type.id', '=', 'contacts.contact_type_id')
            ->join('commons as msme_type', 'msme_type.id', '=', 'contacts.msme_type_id')
            ->orderBy('contacts.id',$this->getListForm->sortAsc ? 'asc' : 'desc')
            ->paginate($this->getListForm->perPage);
    }

    public function render()
    {
        return view('livewire.master.contact.index')->with([
            'list' => $this->getList(),
        ]);
    }
}
