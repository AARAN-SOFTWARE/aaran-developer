<?php

namespace App\Livewire\Project\Activity;

use Aaran\Projects\Models\ProjectActivity;
use Aaran\Projects\Models\ProjectTask;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;
    #region[Properties]
    public $projectTaskData;
    public $description;
    #endregion

    #region[mount]
    public function mount($id)
    {
        $this->projectTaskData=ProjectTask::find($id);
    }
    #endregion

    #region[rules]
    public function rules(): array
    {
        return [
            'common.vname' => 'required',
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
            $projectActivity = new ProjectActivity();
            $extraFields = [
                'project_task_id' => $this->projectTaskData->id,
                'description' => $this->description,

            ];
            $this->common->save($projectActivity, $extraFields);
            $this->clearFields();
            $message = "Saved";
        } else {
            $projectActivity = ProjectActivity::find($this->common->vid);
            $extraFields = [
                'project_task_id' => $this->projectTaskData->id,
                'description' => $this->description,
            ];
            $this->common->edit($projectActivity, $extraFields);
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
            $projectActivity = ProjectActivity::find($id);
            $this->common->vid = $projectActivity->id;
            $this->common->vname = $projectActivity->vname;
            $this->description = $projectActivity->description;
            $this->common->active_id = $projectActivity->active_id;
            return $projectActivity;
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
        $this->common->active_id = '1';
    }
    #endregion

    #region[Render]

    public function render()
    {
        return view('livewire.project.activity.index')->with([
            'list' => $this->getListForm->getList(ProjectActivity::class),
        ]);
    }
    #endregion
}
