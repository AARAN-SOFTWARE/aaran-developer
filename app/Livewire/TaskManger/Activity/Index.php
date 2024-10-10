<?php

namespace App\Livewire\TaskManger\Activity;

use Aaran\Taskmanager\Models\Activities;
use Aaran\Taskmanager\Models\Task;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{

    use CommonTraitNew;

    #region[property]
    public $remarks;
    public $estimated;
    public $duration;
    public $start_on;
    public $end_on;
    public $cdate;
    #endregion

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
            $this->common->active_id = $activity->active_id;
            return $activity;
        }
        return null;
    }

    #endregion

    #region[task]

    public $task_id = '';
    public $task_name = '';
    public Collection $taskCollection;
    public $highlightTask = 0;
    public $taskTyped = false;

    public function decrementTask(): void
    {
        if ($this->highlightTask === 0) {
            $this->highlightTask = count($this->taskCollection) - 1;
            return;
        }
        $this->highlightTask--;
    }

    public function incrementTask(): void
    {
        if ($this->highlightTask === count($this->taskCollection) - 1) {
            $this->highlightTask = 0;
            return;
        }
        $this->highlightTask++;
    }

    public function setTask($name, $id): void
    {
        $this->task_name = $name;
        $this->task_id = $id;
        $this->getTaskList();
    }

    public function enterTask(): void
    {
        $obj = $this->taskCollection[$this->highlightTask] ?? null;

        $this->task_name = '';
        $this->taskCollection = Collection::empty();
        $this->highlightTask = 0;

        $this->task_name = $obj['vname'] ?? '';
        $this->task_id = $obj['id'] ?? '';
    }

    #[On('refresh-Task')]
    public function refreshTask($v): void
    {
        $this->task_id = $v['id'];
        $this->task_name = $v['name'];
        $this->taskTyped = false;

    }

    public function getTaskList(): void
    {

        $this->taskCollection = $this->task_name ? Task::search(trim($this->task_name))
            ->get() : Task::all();

    }

    #endregion

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->task_id = '';
        $this->task_name = '';
        $this->common->active_id = '1';
        $this->estimated = '';
        $this->duration = '';
        $this->start_on = '';
        $this->end_on = '';
        $this->remarks = '';
    }

    #endregion

//    public function getRoute()
//    {
//        return route('activity');
//    }

    public function render()
    {
        $this->getTaskList();
        return view('livewire.task-manger.activity.index')->with([
            'list' => $this->getListForm->getList(Activities::class),
            'users' => DB::table('users')->where('users.tenant_id', session()->get('tenant_id'))->get(),

        ]);
    }
}
