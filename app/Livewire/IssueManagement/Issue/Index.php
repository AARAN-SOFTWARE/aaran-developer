<?php

namespace App\Livewire\IssueManagement\Issue;

use Aaran\Common\Models\Common;
use Aaran\IssueManagement\Models\Issue;
use Aaran\IssueManagement\Models\IssueImage;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use CommonTraitNew;

    use WithFileUploads;

    #region[property]
    public $body;
    public $assignee_id;
    public $due_date;
    public $priority_id;
    public $status_id;
    public $reporter_id;
    public $flag;
    public $verified;
    public $verified_on;

    public $images = [];
    public $old_images = [];
    public $filter = '';

    #endregion

    public function mount($id=null)
    {
        if ($id != null) {
            $this->filter = $id;
        }
    }

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vid == '') {

            $issue = new Issue();

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

            $this->common->save($issue, $extraFields);
            $this->saveIssueImage($issue->id);
            $this->clearFields();

            $message = "Saved";

        } else {

            $issue = Issue::find($this->common->vid);

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

            $this->common->edit($issue, $extraFields);
            $this->saveIssueImage($issue->id);
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
            $this->module_name = Common::find($obj->module_id)->vname;
            $this->assignee_id = $obj->assignee_id;
            $this->due_date = $obj->due_date;
            $this->priority_id = $obj->priority_id;
            $this->status_id = $obj->status_id;
            $this->reporter_id = $obj->reporter_id;
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
        $data = IssueImage::where('issue_id', $id)->get();
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
        $this->module_name = '';
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

    #region[render]
    public function render()
    {
        $this->getModuleList();

        return view('livewire.issue-management.issue.index')->with([
            'list' => $this->getListForm->getList(Issue::class, function ($q) {
                if ($this->filter == 2) {
                    return $q->where('assignee_id', '=', auth()->id());
                } elseif ($this->filter == 3) {
                    return $q->where('assignee_id', '=', 2);
                } elseif ($this->filter == 4) {
                    return null;
                } else {
                    return $q->where('reporter_id', '=', auth()->id());
                }


//                return $q
//                    ->where('reporter_id', auth()->id())
//                    ->orWhere('assignee_id', '=', auth()->id());
            }),
        ]);
    }
    #endregion
}
