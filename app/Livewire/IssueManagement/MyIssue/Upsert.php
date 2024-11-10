<?php

namespace App\Livewire\IssueManagement\MyIssue;

use Aaran\Taskmanager\Models\Activities;
use Aaran\Taskmanager\Models\Reply;
use Aaran\Taskmanager\Models\Task;
use Aaran\Taskmanager\Models\TaskImage;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Carbon;
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
    public $body;
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
        $this->body = $this->taskData->body;
        $this->allocated = $this->taskData->allocated;
        $this->priority = $this->taskData->priority;
        $this->status = $this->taskData->status;
        $this->old_images=TaskImage::where('task_id',$id)->get();
        $this->cdate=Carbon::now()->format('Y-m-d');
        $this->verified_on=Carbon::now()->format('Y-m-d');
    }

    public function getsave()
    {
        $this->taskData->vname=$this->taskTitle;
        $this->taskData->body = $this->body;
        $this->taskData->allocated = $this->allocated;
        $this->taskData->priority = $this->priority;
        $this->taskData->status = $this->status;
        $this->taskData->save();
        $this->saveTaskImage($this->task_id);
        $this->getRoute();
    }

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
        $this->estimated = '';
        $this->duration = '';
        $this->start_on = '';
        $this->end_on = '';
        $this->remarks = '';
        $this->verified = '';
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
        return redirect(route('task.upsert',[$this->task_id]));
    }

    public function render()
    {
        return view('livewire.task-manger.task.upsert')->with(['list'=>$this->getList(), 'users' => DB::table('users')->where('users.tenant_id', session()->get('tenant_id'))->get(),]);
    }
}
