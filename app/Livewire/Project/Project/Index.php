<?php

namespace App\Livewire\Project\Project;

use Aaran\Projects\Models\project;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    public $description;
    public $vdate;


    #region[mount]
    public function mount()
    {
        $this->vdate=Carbon::now()->format('Y-m-d');
    }
    #endregion

    #region[rules]
    public function rules(): array
    {
        return [
            'common.vname' => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'common.vname.required' => 'The :attribute is required.',
        ];
    }

    public function validationAttributes()
    {
        return [
            'common.vname' => 'Title',
        ];
    }
    #endregion

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vid == '') {
            $project = new project();
            $extraFields = [
                'description' => $this->description,
                'vdate' => $this->vdate,

            ];
            $this->common->save($project, $extraFields);
            $this->clearFields();
            $message = "Saved";
        } else {
            $project = project::find($this->common->vid);
            $extraFields = [
                'description' => $this->description,
                'vdate' => $this->vdate,
            ];
            $this->common->edit($project, $extraFields);
            $this->clearFields();
            $message = "Updated";
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $project = project::find($id);
            $this->common->vid = $project->id;
            $this->common->vname = $project->vname;
            $this->description = $project->description;
            $this->vdate = $project->vdate;
            $this->common->active_id = $project->active_id;
            return $project;
        }
        return null;
    }
    #endregion

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->description = '';
        $this->vdate = Carbon::now()->format('Y-m-d');
        $this->common->active_id = '1';
    }
    #endregion

    #region[Render]
    public function render()
    {
        return view('livewire.project.project.index')->with([
            'list' => $this->getListForm->getList(project::class),
        ]);
    }
    #endregion
}
