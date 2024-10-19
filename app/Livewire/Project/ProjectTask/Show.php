<?php

namespace App\Livewire\Project\ProjectTask;

use Aaran\Projects\Models\ProjectImage;
use Aaran\Projects\Models\ProjectTask;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class Show extends Component
{
    use CommonTraitNew;
    public $projectTask;
    public $projectTaskImage;

    public function mount($id)
    {
        $this->projectTask = ProjectTask::find($id);
        $this->projectTaskImage = ProjectImage::where('project_task_id', $this->projectTask->id)->get()->toarray();
    }

    public function render()
    {
        return view('livewire.project.project-task.show');
    }
}
