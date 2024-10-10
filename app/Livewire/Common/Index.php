<?php

namespace App\Livewire\Common;

use Aaran\Common\Models\Common;
use Aaran\Common\Models\Label;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use CommonTraitNew;

    #region[Properties]
    public mixed $module;
    public mixed $desc = '';
    public mixed $desc_1 = '';
    public mixed $label_id;
    public mixed $labelData;

    public array $filter = [];
    #endregion

    #region[Mount]
    public function mount($id)
    {
        if ($id != null) {
            $this->filter[] = $id;
            $this->module = Label::find($id);
        }
    }
    #endregion

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $Common = new Common();
                $extraFields = [
                    'label_id' => $this->module->id,
                    'desc' => $this->desc,
                    'desc_1' => $this->desc_1,
                ];
                $this->common->save($Common, $extraFields);
                $this->clearFields();
                $message = "Saved";
            } else {
                $Common = Common::find($this->common->vid);
                $extraFields = [
                    'label_id' => $this->module->id,
                    'desc' => $this->desc,
                    'desc_1' => $this->desc_1,
                ];
                $this->common->edit($Common, $extraFields);
                $this->clearFields();
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $Common = Common::find($id);
            $this->common->vid = $Common->id;
            $this->common->vname = $Common->vname;
            $this->common->active_id = $Common->active_id;
            $this->desc = $Common->desc;
            $this->desc_1 = $Common->desc_1;
            $this->label_id = $Common->label_id;
            return $Common;
        }
        return null;
    }
    #endregion

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->common->active_id = '1';
        $this->desc = '';
        $this->desc_1 = '';
        $this->label_id = '';
    }
    #endregion

    #region[Render]
    public function getRoute()
    {
        return route('commons');
    }

    public function render()
    {
        return view('livewire.common.index')->with([
            'list' => $this->getListForm->getList(Common::class, function ($query) {
                return $query->orderBy('label_id', 'asc')
                    ->when($this->filter, function ($query, $filter) {
                        return $query->whereIn('label_id', $filter);
                    });

            }),
        ]);
    }
    #endregion
}
