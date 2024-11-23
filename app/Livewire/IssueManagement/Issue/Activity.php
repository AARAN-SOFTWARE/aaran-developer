<?php

namespace App\Livewire\IssueManagement\Issue;

use Aaran\Common\Models\Common;
use Aaran\IssueManagement\Models\Issue;
use Aaran\IssueManagement\Models\IssueActivity;
use Aaran\IssueManagement\Models\IssueImage;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Activity extends Component
{
    use CommonTraitNew;

    use WithFileUploads;

    #region[Properties]
    public $issue_id;
    public $issueData;
    public $title;
    public $issueImages;
    public $body;
    public $module;
    public $priority;
    public $status;
    public $due_date;
    public $assignee;
    public $verified = '';
    public $verified_on;
    public $images = [];
    public $old_images = [];
    public $status_id;

    #endregion

    #region[Mount]
    public function mount($id): void
    {
        $this->issueData = Issue::find($id);
        $this->issueImages = IssueImage::where('issue_id', $id)->get()->toarray();
        $this->issue_id = $id;
        $this->common->active_id = 1;
        $this->title = $this->issueData->vname;
        $this->body = $this->issueData->body;
        $this->module_id = $this->issueData->module_id;
        $this->module_name = Common::find($this->issueData->module_id)->vname;
        $this->assignee = $this->issueData->assignee_id;
        $this->priority = $this->issueData->priority_id;
        $this->status = $this->issueData->status_id;
        $this->old_images = IssueImage::where('issue_id', $id)->get();
        $this->due_date = Carbon::now()->format('Y-m-d');
        $this->verified_on = Carbon::now()->format('Y-m-d');
    }
    #endregion

    #region[Save]
    public function getsave()
    {
        $this->issueData->vname = $this->title;
        $this->issueData->body = $this->body;
        $this->issueData->module_id = $this->module_id;
        $this->issueData->assignee_id = $this->assignee;
        $this->issueData->priority_id = $this->priority;
        $this->issueData->status_id = $this->status;
        $this->issueData->due_date = $this->due_date;
        $this->issueData->save();
        $this->saveIssueImage($this->issue_id);
        $this->getRoute();
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
            'label_id' => 19, // Assuming label_id for modules is 3
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshModule($v);
    }

    public function getModuleList(): void
    {
        $this->moduleCollection = $this->module_name ?
            Common::search(trim($this->module_name))->where('label_id', '=', '19')->get() :
            Common::where('label_id', '=', '24')->orWhere('label_id', '=', '19')->get();
    }
#endregion

    #region[SaveIssueImage]
    public function saveIssueImage($id)
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

    #region[Delete Image]
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

    #region[SaveImage]
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
    #endregion

    #region[EditIssue]
    public function editIssue()
    {
        $this->showEditModal = true;
    }
    #endregion

    #region[getSave]
    public function getSaveIssueActivity(): void
    {
        if ($this->common->vid == '') {
            $IssueActivity = new IssueActivity();
            $extraFields = [
                'issue_id' => $this->issue_id,
                'status_id' => $this->status_id ?: '1',
                'reporter_id' => auth()->id(),
            ];
            $this->common->save($IssueActivity, $extraFields);
            $this->clearFields();
            $message = "Saved";
        } else {
            $IssueActivity = IssueActivity::find($this->common->vid);
            $extraFields = [
                'issue_id' => $this->issue_id,
                'status_id' => $this->status_id,
                'reporter_id' => auth()->id(),
            ];
            $this->common->edit($IssueActivity, $extraFields);
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
            $IssueActivity = IssueActivity::find($id);
            $this->common->vid = $IssueActivity->id;
            $this->common->vname = $IssueActivity->vname;
            $this->issue_id = $IssueActivity->issue_id;
            $this->status_id = $IssueActivity->status_id;
            $this->common->active_id = $IssueActivity->active_id;
            return $IssueActivity;
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
        $this->status_id = '';
    }
    #endregion

    #region[Edit Activity]
    public function editActivity($id)
    {
        $this->clearFields();
        $this->getObj($id);
    }
    #endregion

    #region[Get Route]
    public function getRoute()
    {
        return redirect(route('issues.activities', [$this->issue_id]));
    }

    public function render()
    {
        $this->getModuleList();
        return view('livewire.issue-management.issue.activity')->with
        (['list' => IssueActivity::where('issue_id','=',$this->issue_id)->get(), 'users' => DB::table('users')->where('users.tenant_id', session()->get('tenant_id'))->get(),]);
    }
    #endregion
}
