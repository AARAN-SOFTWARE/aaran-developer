<?php

namespace App\Livewire\TaskManger\Task;

use Aaran\Common\Models\Common;
use Aaran\Taskmanager\Models\Task;
use Aaran\Taskmanager\Models\TaskImage;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Collection;
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
    public $priority_id;
    public $status_id;
    public $due_date;
    public $allocated_id;
    public $reporter_id;
    public $flag;

    public $images = [];
    public $old_images = [];
    public $filter = '';
    public $jobFilter = [];

    #endregion

    #region[Validation]
    public function rules(): array
    {
        return [
            'common.vname' => 'required',
            'body' => 'required',
            'job_id' => 'required',
            'module_id' => 'required',
            'allocated_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'common.vname.required' => 'The :attribute required',
            'body' => 'Write :attribute ',
            'job_id' => 'Mention The :attribute',
            'module_id' => 'Define The :attribute',
            'allocated_id' => 'Allocate The :attribute',
        ];
    }

    public function validationAttributes()
    {
        return [
            'common.vname' => 'Title',
            'body' => 'Something',
            'job_id' => 'Job',
            'module_id' => 'Module',
            'allocated_id' => 'Assignee',
        ];
    }

    #endregion

    public function mount($id = null)
    {
        if ($id != null) {
            $this->filter = $id;
        }
    }

    #region[getSave]
    public function getSave(): void
    {
        $this->validate($this->rules());

        if ($this->common->vid == '') {
            $task = new Task();
            $extraFields = [
                'job_id' => $this->job_id,
                'module_id' => $this->module_id,
                'body' => $this->body,
                'priority_id' => $this->priority_id ?: 1,
                'status_id' => $this->status_id ?: 1,
                'due_date' => $this->due_date,
                'allocated_id' => $this->allocated_id,
                'reporter_id' => auth()->id(),
                'flag' => $this->flag,
            ];
            $this->common->save($task, $extraFields);
            $this->saveTaskImage($task->id);
            $this->clearFields();
            $message = "Saved";
        } else {
            $task = Task::find($this->common->vid);
            $extraFields = [
                'job_id' => $this->job_id,
                'module_id' => $this->module_id,
                'body' => $this->body,
                'priority_id' => $this->priority_id ?: 1,
                'status_id' => $this->status_id ?: 1,
                'due_date' => $this->due_date,
                'allocated_id' => $this->allocated_id,
                'reporter_id' => auth()->id(),
                'flag' => $this->flag,
            ];
            $this->common->edit($task, $extraFields);
            $this->saveTaskImage($task->id);
            $this->clearFields();
            $message = "Updated";
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }

    public function saveTaskImage($id): void
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
            $obj = Task::find($id);
            $this->common->vid = $obj->id;
            $this->common->vname = $obj->vname;
            $this->body = $obj->body;
            $this->priority_id = $obj->priority_id;
            $this->status_id = $obj->status_id;
            $this->due_date = $obj->due_date;
            $this->allocated_id = $obj->allocated_id;
            $this->reporter_id = $obj->reporter_id;
            $this->job_id = $obj->job_id;
            $this->job_name = Common::find($obj->job_id)->vname;
            $this->module_id = $obj->module_id;
            $this->module_name = Common::find($obj->module_id)->vname;
            $this->flag = $obj->flag;
            $this->common->active_id = $obj->active_id;
            $this->old_images = TaskImage::where('task_id', $id)->get();
            return $obj;
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
        $this->job_id = '';
        $this->job_name = '';
        $this->module_id = '';
        $this->module_name = '';
        $this->body = '';
        $this->priority_id = '';
        $this->status_id = '';
        $this->due_date = '';
        $this->allocated_id = '';
        $this->flag = '';
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

    #region[job]
    public $job_id = '';
    public $job_name = '';
    public Collection $jobCollection;
    public $highlightJob = 0;
    public $jobTyped = false;

    public function decrementJob(): void
    {
        if ($this->highlightJob === 0) {
            $this->highlightJob = count($this->jobCollection) - 1;
            return;
        }
        $this->highlightJob--;
    }

    public function incrementJob(): void
    {
        if ($this->highlightJob === count($this->jobCollection) - 1) {
            $this->highlightJob = 0;
            return;
        }
        $this->highlightJob++;
    }

    public function setJob($name, $id): void
    {
        $this->job_name = $name;
        $this->job_id = $id;
        $this->getJobList();
    }

    public function enterJob(): void
    {
        $obj = $this->jobCollection[$this->highlightJob] ?? null;

        $this->job_name = '';
        $this->jobCollection = Collection::empty();
        $this->highlightJob = 0;

        $this->job_name = $obj['vname'] ?? '';
        $this->job_id = $obj['id'] ?? '';
    }


    public function refreshJob($v): void
    {
        $this->job_id = $v['id'];
        $this->job_name = $v['name'];
        $this->jobTyped = false;
    }

    public function jobSave($name)
    {
        $obj = Common::create([
            'label_id' => 25,
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshJob($v);
    }

    public function getJobList(): void
    {
        $this->jobCollection = $this->job_name ?
            Common::search(trim($this->job_name))->where('label_id', '=', '25')->get() :
            Common::where('label_id', '=', '25')->orWhere('label_id', '=', '1')->get();
    }

#endregion

    #region[module]
    public $module_id = '';
    public $module_name = '';
    public Collection $moduleCollection;
    public $highlightModule = 0;
    public $moduleTyped = false;

    public function decrementModule(): void
    {
        if ($this->highlightModule === 0) {
            $this->highlightModule = count($this->moduleCollection) - 1;
            return;
        }
        $this->highlightModule--;
    }

    public function incrementModule(): void
    {
        if ($this->highlightModule === count($this->moduleCollection) - 1) {
            $this->highlightModule = 0;
            return;
        }
        $this->highlightModule++;
    }

    public function setModule($name, $id): void
    {
        $this->module_name = $name;
        $this->module_id = $id;
        $this->getModuleList();
    }

    public function enterModule(): void
    {
        $obj = $this->moduleCollection[$this->highlightModule] ?? null;

        $this->module_name = '';
        $this->moduleCollection = Collection::empty();
        $this->highlightModule = 0;

        $this->module_name = $obj['vname'] ?? '';
        $this->module_id = $obj['id'] ?? '';
    }


    public function refreshModule($v): void
    {
        $this->module_id = $v['id'];
        $this->module_name = $v['name'];
        $this->moduleTyped = false;
    }

    public function moduleSave($name)
    {
        $obj = Common::create([
            'label_id' => 24,
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshModule($v);
    }

    public function getModuleList(): void
    {
        $this->moduleCollection = $this->module_name ?
            Common::search(trim($this->module_name))->where('label_id', '=', '24')->get() :
            Common::where('label_id', '=', '24')->orWhere('label_id', '=', '1')->get();
    }

#endregion

    #region[Render]
    public function getRoute()
    {
        return redirect(route('tasks'));
    }

    public function render()
    {
        $this->getModuleList();
        $this->getJobList();


        return view('livewire.task-manger.task.index')->with([
            'list' => $this->getListForm->getList(Task::class, function ($q) {

                if ($this->filter == 2) {
                    $q->where('allocated_id', '=', auth()->id());

                } elseif ($this->filter == 3) {
                    $q->where('allocated_id', '=', 2);

                } elseif ($this->filter == 4) {

                } else {
                    $q->where('reporter_id', '=', auth()->id());
                }

                if ($this->jobFilter) {
                    $q->where(function ($query) {
                        return $query->where('job_id', '=', $this->jobFilter);
                    });
                }
                return $q;
            }),
            'users' => DB::table('users')->where('users.tenant_id', session()->get('tenant_id'))->get(),
        ]);
    }
    #endregion

}
