<?php

namespace App\Livewire\Entries\Sales;

use Aaran\Entries\Models\Sale;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use CommonTraitNew;
    use WithPagination;

    #region[create]
    public function create(): void
    {
        ini_set('max_execution_time', 3600);
        $this->redirect(route('sales.upsert', ['0']));
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $obj = Sale::find($id);
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
        DB::table('saleitems')->where('sale_id', '=', $this->common->vid)->delete();
        $obj->delete();
        $this->showDeleteModal = false;
    }
    #endregon

//    #region[print]
//    public function print($id): void
//    {
//        $this->redirect(route('sales.print', [$id]));
//    }
//    #endregion

    #region[render]
    public function render()
    {
        $this->getListForm->searchField='invoice_no';
        $this->getListForm->sortField='invoice_no';
        return view('livewire.entries.sales.index')->with([
            'list'=>$this->getListForm->getList(Sale::class,function ($query){
                return  $query->where('company_id','=',session()->get('company_id'))->where('acyear',session()->get('acyear'));
            }),
        ]);
    }
    #endregion
}
