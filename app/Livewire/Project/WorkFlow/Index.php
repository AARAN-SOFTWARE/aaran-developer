<?php

namespace App\Livewire\Project\WorkFlow;

use Aaran\Common\Models\Common;
use Aaran\Common\Models\Label;
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
    public $projectId = '';
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
                'label_id' => $this->label_id,
                'model_id' => $this->model_id,
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
                'label_id' => $this->label_id,
                'model_id' => $this->model_id,
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
            $this->label_id = $workflow->label_id;
            $this->label_name = $workflow->label->vname;
            $this->model_id = $workflow->model_id;
            $this->model_name = $workflow->model->vname;
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
        $this->label_name = '';
        $this->label_id = '';
        $this->model_id = '';
        $this->model_name = '';
        $this->estimated = Carbon::tomorrow()->format('Y-m-d');
        $this->duration = '';
        $this->status = '1';
        $this->notes = '';
        $this->common->active_id = '1';
    }
    #endregion

    #region[label]
    public $label_id = '';
    public $label_name = '';
    public Collection $labelCollection;
    public $highlightLabel = 0;
    public $labelTyped = false;

    public function decrementLabel(): void
    {
        if ($this->highlightLabel === 0) {
            $this->highlightLabel = count($this->labelCollection) - 1;
            return;
        }
        $this->highlightLabel--;
    }

    public function incrementLabel(): void
    {
        if ($this->highlightLabel === count($this->labelCollection) - 1) {
            $this->highlightLabel = 0;
            return;
        }
        $this->highlightLabel++;
    }

    public function setLabel($name, $id): void
    {
        $this->label_name = $name;
        $this->label_id = $id;
        $this->getLabelList();
    }

    public function enterLabel(): void
    {
        $obj = $this->labelCollection[$this->highlightLabel] ?? null;

        $this->label_name = '';
        $this->labelCollection = Collection::empty();
        $this->highlightLabel = 0;

        $this->label_name = $obj['vname'] ?? '';
        $this->label_id = $obj['id'] ?? '';
    }

    public function refreshLabel($v): void
    {
        $this->label_id = $v['id'];
        $this->label_name = $v['name'];
        $this->labelTyped = false;
    }

    public function labelSave($name)
    {
        $obj = Label::create([
            'vname' => $name,
            'cols' => 1,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshLabel($v);
    }

    public function getLabelList(): void
    {
        $this->labelCollection = $this->label_name ?
            Label::search(trim($this->label_name))->where('id', '>', '23')->get() :
            Label::where('id', '>', '23')->get();
    }
    #endregion

    #region[model]
    public $model_id = '';
    public $model_name = '';
    public Collection $modelCollection;
    public $highlightModel = 0;
    public $modelTyped = false;

    public function decrementModel(): void
    {
        if ($this->highlightModel === 0) {
            $this->highlightModel = count($this->modelCollection) - 1;
            return;
        }
        $this->highlightModel--;
    }

    public function incrementModel(): void
    {
        if ($this->highlightModel === count($this->modelCollection) - 1) {
            $this->highlightModel = 0;
            return;
        }
        $this->highlightModel++;
    }

    public function setModel($name, $id): void
    {
        $this->model_name = $name;
        $this->model_id = $id;
        $this->getModelList();
    }

    public function enterModel(): void
    {
        $obj = $this->modelCollection[$this->highlightModel] ?? null;

        $this->model_name = '';
        $this->modelCollection = Collection::empty();
        $this->highlightModel = 0;

        $this->model_name = $obj['vname'] ?? '';
        $this->model_id = $obj['id'] ?? '';
    }

    public function refreshModel($v): void
    {
        $this->model_id = $v['id'];
        $this->model_name = $v['name'];
        $this->modelTyped = false;
    }

    public function modelSave($name)
    {
        $obj = Common::create([
            'label_id' => $this->label_id,
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshModel($v);
    }

    public function getModelList(): void
    {
        $this->modelCollection = $this->model_name ?
            Common::search(trim($this->model_name))->where('label_id', '=', $this->label_id)->get() :
            Common::where('label_id', '=', $this->label_id)->Orwhere('label_id', '=', '1')->get();
    }
    #endregion

    #region[Render]

    public function mount($id = null): void
    {
        $this->projectId = $id;
    }


    public function render()
    {
        $this->getLabelList();
        $this->getModelList();
        $this->getProjectList();

        return view('livewire.project.work-flow.index')->with([

            'list' => $this->getListForm->getList(Workflow::class, function ($query) {
                return $query->when($this->projectId, function ($q) {
                    return $q->where('project_id', $this->projectId);
                });

            }),
        ]);
    }
    #endregion
}
