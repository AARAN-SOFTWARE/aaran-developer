<?php

namespace App\Livewire\Contact\Maintenance;

use Aaran\Contact\Models\Maintenance;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;
    #region[Properties]
    public $latest_version;
    public $vdate;
    public $notes;
    public $soft_installations_id ;

    #endregion

    public function mount($id)
    {
        $this->soft_installations_id = $id;
    }

    #region[Get-Save]
    public function getSave(): void
    {
        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $Maintenance = new Maintenance();
                $extraFields = [
                    'soft_installations_id' => $this->soft_installations_id,
                    'latest_version' => $this->latest_version,
                    'vdate' => $this->vdate,
                    'notes' => $this->notes,
                ];
                $this->common->save($Maintenance, $extraFields);
                $message = "Saved";
            } else {
                $Maintenance = Maintenance::find($this->common->vid);
                $extraFields = [
                    'soft_installations_id' => $this->soft_installations_id,
                    'latest_version' => $this->latest_version,
                    'vdate' => $this->vdate,
                    'notes' => $this->notes,
                ];
                $this->common->edit($Maintenance, $extraFields);
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
            $Maintenance = Maintenance::find($id);
            $this->common->vid = $Maintenance->id;
            $this->common->vname = $Maintenance->vname;
            $this->latest_version = $Maintenance->latest_version;
            $this->vdate = $Maintenance->vdate;
            $this->notes = $Maintenance->notes;
            $this->common->active_id = $Maintenance->active_id;
            return $Maintenance;
        }
        return null;
    }

    #region[Clear-Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->latest_version = '';
        $this->vdate = '';
        $this->notes = '';
        $this->common->active_id = '1';
    }
    #endregion
    public function render()
    {
        return view('livewire.contact.maintenance.index')->with([
            'list' => $this->getListForm->getList(Maintenance::class),
        ]);
    }
}
