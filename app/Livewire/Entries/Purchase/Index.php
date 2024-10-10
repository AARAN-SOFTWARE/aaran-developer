<?php

namespace App\Livewire\Entries\Purchase;

use Aaran\Entries\Models\Purchase;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    #region[create]
    public function create(): void
    {
        $this->redirect(route('purchase.upsert', ['0']));
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $obj = Purchase::find($id);
            $this->common->vid = $obj->id;
            return $obj;
        }
        return null;
    }
    #endregion

    #region[trashData]
    public function trashData(): void
    {
        $obj = $this->getObj($this->common->vid);
        DB::table('purchaseitems')->where('purchase_id', '=', $this->common->vid)->delete();
        $obj->delete();
        $this->showDeleteModal = false;
    }
    #endregion

    #region[Render]
    public function render()
    {
        $this->getListForm->searchField = 'purchase_no';
        $this->getListForm->sortField = 'purchase_no';
        return view('livewire.entries.purchase.index')->with([
            'list' => $this->getListForm->getList(Purchase::class, function ($query) {
                return $query->where('company_id', '=', session()->get('company_id'))->where('acyear',session()->get('acyear'));
            }),
        ]);
    }
    #endregion
}
