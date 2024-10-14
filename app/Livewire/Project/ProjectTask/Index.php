<?php

namespace App\Livewire\Project\ProjectTask;

use Aaran\Projects\Models\ProjectTask;
use Aaran\Projects\Models\Workflow;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    #region[property]
    public $description;
    public $status;
    public $assignee;
    #endregion

    #region[rules]
    public function rules(): array
    {
        return [
            'common.vname' => 'required',
            'assignee' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'common.vname.required' => 'The :attribute is required.',
            'assignee.required' => 'The :attribute is required.',
        ];
    }

    public function validationAttributes()
    {
        return [
            'common.vname' => 'Task Name',
            'assignee' => 'Assignee',
        ];
    }
    #endregion

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vid == '') {
            $this->validate();
            $ProjectTask = new ProjectTask();
            $extraFields = [
                'workflow_id' => $this->workflow_id,
                'description' => $this->description,
                'status' => $this->status ?: 1,
                'assignee' => $this->assignee,
                'user_id' => auth()->id(),
            ];
            $this->common->save($ProjectTask, $extraFields);
            $this->clearFields();
            $message = "Saved";
        } else {
            $ProjectTask = ProjectTask::find($this->common->vid);
            $extraFields = [
                'workflow_id' => $this->workflow_id,
                'description' => $this->description,
                'status' => $this->status,
                'assignee' => $this->assignee,
                'user_id' => auth()->id(),
            ];
            $this->common->edit($ProjectTask, $extraFields);
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
            $ProjectTask = ProjectTask::find($id);
            $this->common->vid = $ProjectTask->id;
            $this->common->vname = $ProjectTask->vname;
            $this->workflow_id = $ProjectTask->workflow_id;
            $this->workflow_name = $ProjectTask->Workflow->vname;
            $this->description = $ProjectTask->description;
            $this->status = $ProjectTask->status;
            $this->assignee = $ProjectTask->assignee;
            $this->common->active_id = $ProjectTask->active_id;
            return $ProjectTask;
        }
        return null;
    }

    #endregion

    #region[WorkFlow]

    public $workflow_id = '';
    public $workflow_name = '';
    public Collection $workflowCollection;
    public $highlightWorkflow = 0;
    public $workflowTyped = false;

    public function decrementWorkflow(): void
    {
        if ($this->highlightWorkflow === 0) {
            $this->highlightWorkflow = count($this->workflowCollection) - 1;
            return;
        }
        $this->highlightWorkflow--;
    }

    public function incrementWorkflow(): void
    {
        if ($this->highlightWorkflow === count($this->workflowCollection) - 1) {
            $this->highlightWorkflow = 0;
            return;
        }
        $this->highlightWorkflow++;
    }

    public function setWorkflow($name, $id): void
    {
        $this->workflow_name = $name;
        $this->workflow_id = $id;
        $this->getWorkflowList();
    }

    public function enterWorkflow(): void
    {
        $obj = $this->workflowCollection[$this->highlightWorkflow] ?? null;

        $this->workflow_name = '';
        $this->workflowCollection = Collection::empty();
        $this->highlightWorkflow = 0;

        $this->workflow_name = $obj['vname'] ?? '';
        $this->workflow_id = $obj['id'] ?? '';
    }

    public function refreshWorkflow($v): void
    {
        $this->workflow_id = $v['id'];
        $this->workflow_name = $v['name'];
        $this->workflowTyped = false;
    }

    public function getWorkflowList(): void
    {
        $this->workflowCollection = $this->workflow_name ? WorkFlow::search(trim($this->workflow_name))
            ->get() : WorkFlow::all();
    }

#endregion

#region[Clear Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->workflow_id = '';
        $this->workflow_name = '';
        $this->description = '';
        $this->status = '';
        $this->assignee = '';
        $this->common->active_id = '1';
    }

    #endregion
    public function render()
    {
        $this->getWorkflowList();
        return view('livewire.project.project-task.index')->with([
            'list' => $this->getListForm->getList(ProjectTask::class),
            'users' => DB::table('users')->select('users.*')->get(),
        ]);
    }
}
