<?php

namespace App\Livewire\TaskManger\AllTask;

use Aaran\Taskmanager\Models\Task;
use Aaran\Taskmanager\Models\TaskImage;
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
    public $allocated;
    public $priority;
    public $status;
    public $verified;
    public $verified_on;

    public $images = [];
    public $old_images = [];
    #endregion

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vid == '') {
            $task = new Task();
            $extraFields = [
                'body' => $this->body,
                'allocated' => $this->allocated,
                'status' => $this->status,
                'priority' => $this->priority,
                'user_id' => auth()->id(),
                'verified' => $this->verified,
                'verified_on' => $this->verified_on,
            ];
            $this->common->save($task, $extraFields);
            $this->saveTaskImage($task->id);
            $this->clearFields();
            $message = "Saved";
        } else {
            $task = Task::find($this->common->vid);
            $extraFields = [
                'body' => $this->body,
                'allocated' => $this->allocated,
                'status' => $this->status,
                'priority' => $this->priority,
                'user_id' => auth()->id(),
                'verified' => $this->verified,
                'verified_on' => $this->verified_on,
            ];
            $this->common->edit($task, $extraFields);
            $this->saveTaskImage($task->id);
            $this->clearFields();
            $message = "Updated";
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }

    public function saveTaskImage($id)
    {
        foreach ($this->old_images as $old_image) {
            $old_image->save();
        }

        if ($this->images != []) {
            foreach ($this->images as $image) {
                TaskImage::create([
                    'task_id' => $id,
                    'image' => $this->saveImage($image),
                ]);
            }
        }
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
            $this->status = $task->status;
            $this->priority = $task->priority;
            $this->allocated = $task->allocated;
            $this->verified = $task->verified;
            $this->verified_on = $task->verified_on;
            $this->common->active_id = $task->active_id;
            $this->old_images = TaskImage::where('task_id', $id)->get();
            return $task;
        }
        return null;
    }

    public function getTaskImage($id)
    {
        $data = TaskImage::where('task_id', $id)->get();
        $arrayImage = [];
        foreach ($data as $key => $value) {
            $arrayImage[$key]['imgSrc'] = URL(\Illuminate\Support\Facades\Storage::url('images/' . $value->image));
        }
        return $arrayImage;
    }
    #endregion

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->common->active_id = '1';
        $this->body = '';
        $this->priority = '';
        $this->allocated = '';
        $this->verified = '';
        $this->verified_on = '';
        $this->status = '';
        $this->images = [];
        $this->old_images = [];
    }
    #endregion

    #region[image]
    public function saveImage($image)
    {
        if ($image) {

            $filename = $image->getClientOriginalName();


            $image->storeAs('/images', $filename, 'public');

            return $filename;

        } else {
            return 'no image';
        }
    }

    public function DeleteImage($id)
    {
        if ($id) {
            $obj = TaskImage::find($id);
            if (Storage::disk('public')->exists(Storage::path('public/images/' . $obj->image))) {
                Storage::disk('public')->delete(Storage::path('public/images/' . $obj->image));
            }
            $obj->delete();
        }
    }

    #endregion

    public function getRoute()
    {
        return route('task');
    }

    public function render()
    {
        return view('livewire.task-manger.all-task.index')->with([
            'list' => $this->getListForm->getList(Task::class, function ($q) {
                return $q
                    ->where('user_id', auth()->id())
                    ->orWhere('allocated', '=', auth()->id());
            }),
            'users' => DB::table('users')->where('users.tenant_id', session()->get('tenant_id'))->get(),
        ]);
    }
}
