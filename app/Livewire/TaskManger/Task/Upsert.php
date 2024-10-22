<?php

namespace App\Livewire\TaskManger\Task;

use Aaran\Taskmanager\Models\Activities;
use Aaran\Taskmanager\Models\Reply;
use Aaran\Taskmanager\Models\Task;
use Aaran\Taskmanager\Models\TaskImage;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class Upsert extends Component
{
    use CommonTraitNew;
    public $taskData;
    public $taskImage;
    #region[property]
    public $remarks;
    public $estimated;
    public $duration;
    public $start_on;
    public $end_on;
    public $cdate;
    public $task_id;
    public  $verified = '';
       public $verified_on;
    #endregion

    public function mount($id)
    {
        $this->taskData=Task::find($id);
        $this->taskImage = TaskImage::where('task_id', $id)->get()->toarray();
        $this->task_id=$id;
        $this->common->active_id=1;
    }

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vid == '') {
            $activity = new Activities();
            $extraFields = [
                'task_id' => $this->task_id,
                'estimated' => $this->estimated,
                'duration' => $this->duration,
                'start_on' => $this->start_on,
                'end_on' => $this->end_on,
                'cdate' => $this->cdate,
                'remarks' => $this->remarks,
                'user_id' => auth()->id(),
                'verified'=>$this->verified,
                'verified_on'=>$this->verified_on,
            ];
            $this->common->save($activity, $extraFields);
            $this->clearFields();
            $message = "Saved";
        } else {
            $activity = Activities::find($this->common->vid);
            $extraFields = [
                'task_id' => $this->task_id,
                'estimated' => $this->estimated,
                'duration' => $this->duration,
                'start_on' => $this->start_on,
                'end_on' => $this->end_on,
                'cdate' => $this->cdate,
                'remarks' => $this->remarks,
                'user_id' => auth()->id(),
                'verified'=>$this->verified,
                'verified_on'=>$this->verified_on,
            ];
            $this->common->edit($activity, $extraFields);
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
            $activity = Activities::find($id);
            $this->common->vid = $activity->id;
            $this->common->vname = $activity->vname;
            $this->task_id = $activity->task_id;
            $this->task_name = $activity->task->vname;
            $this->estimated = $activity->estimated;
            $this->duration = $activity->duration;
            $this->start_on = $activity->start_on;
            $this->end_on = $activity->end_on;
            $this->cdate = $activity->cdate;
            $this->remarks = $activity->remarks;
            $this->verified = $activity->verified;
            $this->verified_on = $activity->verified_on;
            $this->common->active_id = $activity->active_id;
            return $activity;
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
        $this->cdate='';
        $this->estimated = '';
        $this->duration = '';
        $this->start_on = '';
        $this->end_on = '';
        $this->remarks = '';
        $this->verified = '';
        $this->verified_on = '';
    }
    #endregion

    public function getList()
    {
        return Activities::select('activities.*')
            ->where('task_id',$this->taskData->id)
            ->orderBy('id','asc')
            ->paginate($this->getListForm->perPage);
    }

    public function render()
    {
        return view('livewire.task-manger.task.upsert')->with(['list'=>$this->getList(),]);
    }
}
