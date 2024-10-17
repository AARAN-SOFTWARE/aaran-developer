<?php

namespace App\Livewire\Project\WorkFlow;

use Aaran\Projects\Models\project;
use Aaran\Projects\Models\Workflow;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;


    #region[property]
    public $estimated;
    public $duration;
    public $status;
    public $notes;
    public $projectId;
    #endregion

    #region[rules]
    public function rules(): array
    {
        return [
            'common.vname' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'common.vname.required' => 'The :attribute is required.',
        ];
    }

    public function validationAttributes()
    {
        return [
            'common.vname' => 'Project Title',
        ];
    }
    #endregion
    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vid == '') {
            $workflow = new Workflow();
            $extraFields = [
                'project_id' => $this->project_id,
                'estimated' => $this->estimated,
                'duration' => $this->duration,
                'status' => $this->status ?: 1,
                'notes' => $this->notes,
                'user_id' => auth()->id(),
            ];
            $this->common->save($workflow, $extraFields);
            $this->clearFields();
            $message = "Saved";
        } else {
            $workflow = Workflow::find($this->common->vid);
            $extraFields = [
                'project_id' => $this->project_id,
                'estimated' => $this->estimated,
                'duration' => $this->duration,
                'status' => $this->status,
                'notes' => $this->notes,
                'user_id' => auth()->id(),
            ];
            $this->common->edit($workflow, $extraFields);
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
            $workflow = Workflow::find($id);
            $this->common->vid = $workflow->id;
            $this->common->vname = $workflow->vname;
            $this->project_id = $workflow->project_id;
            $this->project_name = $workflow->Project->vname;
            $this->estimated = $workflow->estimated;
            $this->duration = $workflow->duration;
            $this->status = $workflow->status;
            $this->notes = $workflow->notes;
            $this->common->active_id = $workflow->active_id;
            return $workflow;
        }
        return null;
    }

    #endregion

    #region[project]

    public $project_id = '';
    public $project_name = '';
    public Collection $projectCollection;
    public $highlightProject = 0;
    public $projectTyped = false;

    public function decrementProject(): void
    {
        if ($this->highlightProject === 0) {
            $this->highlightProject = count($this->projectCollection) - 1;
            return;
        }
        $this->highlightProject--;
    }

    public function incrementProject(): void
    {
        if ($this->highlightProject === count($this->projectCollection) - 1) {
            $this->highlightProject = 0;
            return;
        }
        $this->highlightProject++;
    }

    public function setProject($name, $id): void
    {
        $this->project_name = $name;
        $this->project_id = $id;
        $this->getProjectList();
    }

    public function enterProject(): void
    {
        $obj = $this->projectCollection[$this->highlightProject] ?? null;

        $this->project_name = '';
        $this->projectCollection = Collection::empty();
        $this->highlightProject = 0;

        $this->project_name = $obj['vname'] ?? '';
        $this->project_id = $obj['id'] ?? '';
    }

    public function refreshProject($v): void
    {
        $this->project_id = $v['id'];
        $this->project_name = $v['name'];
        $this->projectTyped = false;
    }

    public function getProjectList(): void
    {
        $this->projectCollection = $this->project_name ? project::search(trim($this->project_name))
            ->get() : project::all();
    }

#endregion

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->project_id = '';
        $this->project_name = '';
        $this->estimated = Carbon::tomorrow()->format('Y-m-d');
        $this->duration = '';
        $this->status = '1';
        $this->notes = '';
        $this->common->active_id = '1';
    }
    #endregion

    #region[Render]
    public function render()
    {
    $this->getProjectList();
        return view('livewire.project.work-flow.index')->with([
            'list' => $this->getListForm->getList(Workflow::class,function ($query){
                return $query->where('project_id',$this->projectId);
            }),
        ]);
    }
    #endregion
}
