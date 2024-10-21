<?php

namespace App\Livewire\Installation\Maintenance;

use Aaran\Installation\Models\Maintenance;
use Aaran\Installation\Models\SoftInstallation;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    #region[Properties]
    public $latest_version;
    public $vdate;
    public $notes;
    public $soft_installations_id ;
    public $soft_installations_data ;
    public $status;

    #endregion

    #region[Mount]
    public function mount($id)
    {
        $this->soft_installations_id = $id;
        $this->soft_installations_data = SoftInstallation::find($id);
        $this->common->vname = $this->soft_installations_data->soft_version;
    }
    #endregion

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
                $this->updateStatus();
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
                $this->updateStatus();
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
    }
    #endregion

    #region[Status]
    public function updateStatus()
    {
        $obj = SoftInstallation::find($this->soft_installations_id);
        $obj->status = $this->status;
        $obj->save();
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
    #endregion

    #region[Clear-Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->latest_version = '';
        $this->vdate = Carbon::now()->format('Y-m-d');
        $this->notes = '';
        $this->common->active_id = '1';
    }
    #endregion
    public function render()
    {
        return view('livewire.Installation.maintenance.index')->with([
            'list' => $this->getListForm->getList(Maintenance::class,function ($query) {
                return $query->where('soft_installations_id', $this->soft_installations_id);
            }),
        ]);
    }
}
