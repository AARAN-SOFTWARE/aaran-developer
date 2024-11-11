<?php

namespace App\Livewire\IssueManagement\Issue;

use Aaran\IssueManagement\Models\Issue;
use Aaran\IssueManagement\Models\IssueImage;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Activity extends Component
{
    use CommonTraitNew;

    use WithFileUploads;

    #region[property]

    public $images = [];
    public $old_images = [];

    public Issue $issue;

    #endregion


    #region[getSave]
    public function mount($id = null)
    {
        if ($id) {
          $this->issue =  $this->getObj($id);
        }
    }
    #endregion

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vid == '') {

            $task = new Issue();

            $extraFields = [
                'body' => $this->body,
                'module_id' => $this->module_id,
                'assignee_id' => $this->assignee_id,
                'due_date' => $this->due_date,
                'priority_id' => $this->priority_id,
                'status_id' => $this->status_id,
                'reporter_id' => auth()->id(),
                'flag' => $this->flag,
                'verified' => $this->verified,
                'verified_on' => $this->verified_on,
            ];

            $this->common->save($task, $extraFields);
            $this->saveIssueImage($task->id);
            $this->clearFields();

            $message = "Saved";

        } else {

            $task = Issue::find($this->common->vid);

            $extraFields = [
                'body' => $this->body,
                'module_id' => $this->module_id,
                'assignee_id' => $this->assignee_id,
                'due_date' => $this->due_date,
                'priority_id' => $this->priority_id,
                'status_id' => $this->status_id,
                'reporter_id' => auth()->id(),
                'flag' => $this->flag,
                'verified' => $this->verified,
                'verified_on' => $this->verified_on,
            ];

            $this->common->edit($task, $extraFields);
            $this->saveIssueImage($task->id);
            $this->clearFields();

            $message = "Updated";
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }

    public function saveIssueImage($id): void
    {
        foreach ($this->old_images as $old_image) {
            $old_image->save();
        }

        if ($this->images != []) {
            foreach ($this->images as $image) {
                IssueImage::create([
                    'issue_id' => $id,
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
            $obj = Issue::find($id);
            $this->common->vid = $obj->id;
            $this->common->vname = $obj->vname;
            $this->body = $obj->body;
            $this->module_id = $obj->module_id;
            $this->assignee_id = $obj->assignee_id;
            $this->assignee = $obj->assignee->name;
            $this->due_date = $obj->due_date;
            $this->priority_id = $obj->priority_id;
            $this->status_id = $obj->status_id;
            $this->reporter_id = $obj->reporter_id;
            $this->reporter = $obj->reporter->name;
            $this->flag = $obj->flag;
            $this->verified = $obj->verified;
            $this->verified_on = $obj->verified_on;
            $this->common->active_id = $obj->active_id;
            $this->old_images = IssueImage::where('issue_id', $id)->get();
            return $obj;
        }
        return null;
    }

    public function getIssueImage($id)
    {
        $data = IssueImage::where('task_id', $id)->get();
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
        $this->module_id = '';
        $this->assignee_id = '';
        $this->due_date = '';
        $this->priority_id = '';
        $this->status_id = '';
        $this->reporter_id = '';
        $this->flag = '';
        $this->verified = '';
        $this->verified_on = '';
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
            $obj = IssueImage::find($id);
            if (Storage::disk('public')->exists(Storage::path('public/images/' . $obj->image))) {
                Storage::disk('public')->delete(Storage::path('public/images/' . $obj->image));
            }
            $obj->delete();
        }
    }

    #endregion

    public function getRoute()
    {
        return route('allTask');
    }

    public function render()
    {
        return view('livewire.issue-management.issue.activity')->with([
            'list' => $this->getListForm->getList(Issue::class, function ($q) {
                return $q
                    ->where('reporter_id', auth()->id())
                    ->orWhere('assignee_id', '=', auth()->id());
            }),
        ]);
    }
}
