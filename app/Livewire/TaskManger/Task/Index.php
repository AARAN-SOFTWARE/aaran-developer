<?php

namespace App\Livewire\TaskManger\Task;

use Aaran\Taskmanager\Models\Task;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use CommonTraitNew;
    use WithFileUploads;

    #region[property]
    public $body;
    public $image;
    public $allocated;
    public $verified;
    public $verified_on;
    public $status;
    public $old_image;
    #endregion

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vid == '') {
            $task = new Task();
            $extraFields = [
                'body' => $this->body,
                'image' => $this->save_image(),
                'allocated' => $this->allocated,
                'status' => $this->status,
                'user_id' => auth()->id(),
                'verified' => $this->verified,
                'verified_on' => $this->verified_on,
            ];
            $this->common->save($task, $extraFields);
            $this->clearFields();
            $message = "Saved";
        } else {
            $task = Task::find($this->common->vid);
            $extraFields = [
                'body' => $this->body,
                'image' => $this->save_image(),
                'allocated' => $this->allocated,
                'status' => $this->status,
                'user_id' => auth()->id(),
                'verified' => $this->verified,
                'verified_on' => $this->verified_on,
            ];
            $this->common->edit($task, $extraFields);
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
            $task = Task::find($id);
            $this->common->vid = $task->id;
            $this->common->vname = $task->vname;
            $this->body = $task->body;
            $this->old_image = $task->image;
            $this->status = $task->status;
            $this->allocated = $task->allocated;
            $this->verified = $task->verified;
            $this->verified_on = $task->verified_on;
            $this->common->active_id = $task->active_id;
            return $task;
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
        $this->body = '';
        $this->image = '';
        $this->old_image = '';
        $this->allocated = '';
        $this->verified = '';
        $this->verified_on = '';
        $this->status = '';
    }
    #endregion


    #region[image]
    public function save_image()
    {
        if ($this->image) {

            $image = $this->image;
            $filename = $this->image->getClientOriginalName();

            if (Storage::disk('public')->exists(Storage::path('public/images/' . $this->old_image))) {
                Storage::disk('public')->delete(Storage::path('public/images/' . $this->old_image));
            }

            $image->storeAs('public/images', $filename);

            return $filename;

        } else {
            if ($this->old_image) {
                return $this->old_image;
            } else {
                return 'no_image';
            }
        }
    }

    #endregion

    public function getRoute()
    {
        return route('task');
    }

    public function render()
    {
        return view('livewire.task-manger.task.index')->with([
            'list' => $this->getListForm->getList(Task::class),
            'users' => DB::table('users')->where('users.tenant_id', session()->get('tenant_id'))->get(),
        ]);
    }
}
