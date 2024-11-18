<?php

namespace App\Livewire\TaskManger\Task;

use Aaran\Common\Models\Common;
use Aaran\Taskmanager\Models\Activities;
use Aaran\Taskmanager\Models\Reply;
use Aaran\Taskmanager\Models\Task;
use Aaran\Taskmanager\Models\TaskImage;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upsert extends Component
{
    use CommonTraitNew;
    use WithFileUploads;
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

    public $taskTitle;
    public $taskBody;
    public $allocated;
    public $priority;
    public $status;
    public $images=[];
    public $old_images=[];


    #endregion

    public function mount($id)
    {
        $this->taskData=Task::find($id);
//        dd($this->taskData);
        $this->taskImage = TaskImage::where('task_id', $id)->get()->toarray();
        $this->task_id=$id;
        $this->common->active_id=1;
        $this->taskTitle=$this->taskData->vname;
        $this->taskBody = $this->taskData->body;
        $this->allocated = $this->taskData->allocated_id;
        $this->priority = $this->taskData->priority_id;
        $this->status = $this->taskData->status_id;
        $this->module_id = $this->taskData->module_id;
        $this->module_name = Common::find($this->taskData->module_id)->vname;
        $this->job_id = $this->taskData->job_id;
        $this->job_name = Common::find($this->taskData->job_id)->vname;
        $this->old_images=TaskImage::where('task_id',$id)->get();
        $this->cdate=Carbon::now()->format('Y-m-d');
        $this->verified_on=Carbon::now()->format('Y-m-d');
    }

    public function getsave()
    {
        $this->taskData->vname=$this->taskTitle;
        $this->taskData->body = $this->taskBody;
        $this->taskData->allocated_id = $this->allocated;
        $this->taskData->priority_id = $this->priority;
        $this->taskData->status_id = $this->status;
        $this->taskData->save();
        $this->saveTaskImage($this->task_id);
        $this->getRoute();
    }

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
            'label_id' => 24, // Assuming label_id for modules is 3
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
            Common::where('label_id', '=', '24')->orWhere('label_id', '=', '24')->get();
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
            'label_id' => 25, // Assuming label_id for jobs is 24
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
            Common::where('label_id', '=', '25')->orWhere('label_id', '=', '24')->get();
    }
#endregion
    public function saveTaskImage($id)
    {
        foreach ($this->old_images as $old_image) {
            $old_image->save();
        }

        if ($this->images!=[]){
            foreach ($this->images as $image){
                TaskImage::create([
                    'task_id'=>$id,
                    'image'=>$this->saveImage($image),
                ]);
            }
        }
    }

    public function DeleteImage($id)
    {
        if ($id){
            $obj=TaskImage::find($id);
            if (Storage::disk('public')->exists(Storage::path('public/images/' . $obj->image))) {
                Storage::disk('public')->delete(Storage::path('public/images/' .$obj->image));
            }
            $obj->delete();
        }
    }

    public function saveImage($image)
    {
        if ($image) {

            $filename = $image->getClientOriginalName();


            $image->storeAs('/images', $filename,'public');

            return $filename;

        } else {
            return 'no image';
        }
    }

    public function editTask()
    {
        $this->showEditModal=true;
    }

    #region[getSave]
    public function getSaveActivity(): void
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
//                'verified'=>$this->verified,
//                'verified_on'=>$this->verified_on,
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
//                'verified'=>$this->verified,
//                'verified_on'=>$this->verified_on,
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
            $this->estimated = $activity->estimated;
            $this->duration = $activity->duration;
            $this->start_on = $activity->start_on;
            $this->end_on = $activity->end_on;
            $this->cdate = $activity->cdate;
            $this->remarks = $activity->remarks;
//            $this->verified = $activity->verified;
//            $this->verified_on = $activity->verified_on;
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
        $this->estimated = '';
        $this->duration = '';
        $this->start_on = '';
        $this->end_on = '';
        $this->remarks = '';
//        $this->verified = '';
    }

    public function editActivity($id)
    {
        $this->clearFields();
        $this->getObj($id);
    }
    #endregion

    public function getList()
    {
        return Activities::select('activities.*')
            ->where('task_id',$this->taskData->id)
            ->orderBy('id','asc')
            ->paginate($this->getListForm->perPage);
    }

    public function getRoute()
    {
        return redirect(route('tasks.upsert',[$this->task_id]));
    }

    public function render()
    {
        $this->getJobList();
        $this->getModuleList();
        return view('livewire.task-manger.task.upsert')->with(['list'=>$this->getList(), 'users' => DB::table('users')->where('users.tenant_id', session()->get('tenant_id'))->get(),]);
    }
}
