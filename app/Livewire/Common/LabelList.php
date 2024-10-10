<?php

namespace App\Livewire\Common;

use Aaran\Common\Models\Label;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;
use Livewire\WithPagination;

class LabelList extends Component
{
  use CommonTraitNew;
  use WithPagination;

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vid == '') {
            $label = new Label();
            $this->common->save($label);

            $message = "Saved";
        } else {
            $label = Label::find($this->common->vid);
            $this->common->edit($label);
            $message = "Updated";
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $label = Label::find($id);
            $this->common->vid = $label->id;
            $this->common->vname = $label->vname;
            $this->common->active_id = $label->active_id;
            return $label;
        }
        return null;
    }
    #endregion

    #region[render]
    public function getRoute()
    {
        return route('labels');
    }

    public function render()
    {
        return view('livewire.common.label-list')
            ->with([
            'list' => $this->getListForm->getList(Label::class,function ($query){
                return $query->where('id','>','');
            }),
        ]);
    }
    #endregion
}
