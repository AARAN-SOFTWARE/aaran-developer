<?php

namespace App\Livewire\Crm\Enquiry;

use Aaran\Crm\Models\Enquiry;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    #region[Properties]
    public string $body = '';
    public mixed $status_id;

    #endregion

    public function create(): void
    {
        $this->redirect(route('enquiries.upsert', ['0']));
    }

    public function getObj($id)
    {
        if ($id) {
            $obj = Enquiry::find($id);
            $this->common->vid = $obj->id;
            return $obj;
        }
        return null;
    }

    #region[Render]
    public function getRoute()
    {
        return route('enquiries');
    }

    public function render()
    {
        return view('livewire.crm.enquiry.index')->with([
            'enquiries' => $this->getListForm->getList(Enquiry::class, function ($query) {
                return $query->orderBy('id', 'asc');
            }),
        ]);
    }
    #endregion
}
