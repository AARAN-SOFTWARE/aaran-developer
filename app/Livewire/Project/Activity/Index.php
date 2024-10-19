<?php

namespace App\Livewire\Project\Activity;

use Aaran\Projects\Models\ProjectActivity;
use Aaran\Projects\Models\ProjectTask;
use Aaran\Projects\Models\Workflow;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;
    #region[Properties]
    public $projectTaskData;
    public $description;
    public $start_date;
    public $end_date;
    public $total_duration;
    public $status;
    #endregion

    #region[mount]
    public function mount($id)
    {
        $this->projectTaskData=ProjectTask::find($id);
        $this->status=$this->projectTaskData->status;
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
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'total_duration' => $this->total_duration,
            ];
            $this->common->save($projectActivity, $extraFields);
            $this->updateTaskStatus();
            $this->clearFields();
            $message = "Saved";
        } else {
            $projectActivity = ProjectActivity::find($this->common->vid);
            $extraFields = [
                'project_task_id' => $this->projectTaskData->id,
                'description' => $this->description,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'total_duration' => $this->total_duration,
            ];
            $this->common->edit($projectActivity, $extraFields);
            $this->updateTaskStatus();
            $this->clearFields();
            $message = "Updated";
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }

    public function updateTaskStatus()
    {
        if ($this->status){
           $this->projectTaskData->status = $this->status;
           $this->projectTaskData->save();
           if ($this->status==6){
               $obj=Workflow::where('id',$this->projectTaskData->workflow_id)->first();
               $obj->status=7;
               $obj->active_id=false;
               $obj->save();
           }
        }
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
            $this->start_date = $projectActivity->start_date;
            $this->end_date = $projectActivity->end_date;
            $this->total_duration = $projectActivity->total_duration;
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
        $this->start_date = '';
        $this->end_date = '';
        $this->total_duration = '';
        $this->common->active_id = '1';
    }
    #endregion

    #region[Render]

    public function render()
    {
        return view('livewire.project.activity.index')->with([
            'list' => $this->getListForm->getList(ProjectActivity::class,function ($q){
                return $q->where('project_task_id',$this->projectTaskData->id);
            }),
        ]);
    }
    #endregion
}
