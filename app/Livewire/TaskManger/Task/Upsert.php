<?php

namespace App\Livewire\TaskManger\Task;

use Aaran\Taskmanager\Models\Reply;
use Aaran\Taskmanager\Models\Task;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class Upsert extends Component
{
    use CommonTraitNew;
    public $taskData;
    public $verified;
    public $verified_on;

    public function mount($id)
    {
        $this->taskData=Task::find($id);
    }

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vid == '') {
            $task_replay = new Reply();
            $extraFields = [
                'task_id'=>$this->taskData->id,
                'user_id'=>auth()->id(),
                'verified'=>$this->verified,
                'verified_on'=>$this->verified_on,
            ];
            $this->common->save($task_replay,$extraFields);
            $this->clearFields();
            $message = "Saved";
        } else {
            $task_replay = Reply::find($this->common->vid);
            $extraFields = [
                'task_id'=>$this->taskData->id,
                'user_id'=>auth()->id(),
                'verified'=>$this->verified,
                'verified_on'=>$this->verified_on,
            ];
            $this->common->edit($task_replay,$extraFields);
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
            $task_replay = Reply::find($id);
            $this->common->vid = $task_replay->id;
            $this->common->vname = $task_replay->vname;
            $this->verified=$task_replay->verified;
            $this->verified_on=$task_replay->verified_on;
            $this->common->active_id = $task_replay->active_id;
            return $task_replay;
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
        $this->verified = '';
        $this->verified_on = '';
    }
    #endregion

    public function getList()
    {
        return Reply::select('replies.*')->where('task_id',$this->taskData->id)->orderBy('id','asc')->paginate($this->getListForm->perPage);
    }

    public function render()
    {
        return view('livewire.task-manger.task.upsert')->with(['list'=>$this->getList(),]);
    }
}
