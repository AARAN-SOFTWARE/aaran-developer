<?php

namespace App\Livewire\Web\Dashboard;

use Aaran\Blog\Models\Post;
//use Aaran\Entries\Models\Purchase;
//use Aaran\Entries\Models\Sale;
use Aaran\IssueManagement\Models\Issue;
use Aaran\IssueManagement\Models\IssueImage;
use Aaran\Master\Models\Contact;
//use Aaran\Master\Models\Product;
use Aaran\Taskmanager\Models\Task;
use Aaran\Taskmanager\Models\TaskImage;
//use Aaran\Transaction\Models\Transaction;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;


    public $blogs;
    public $user;
    public $issues;
    public $myTasks;
    public $openTasks;
    public $myIssues;

    public function getIssue()
    {
        $this->issues = Issue::latest()->get();
    }

    public function getmyIssue()
    {
        $this->myIssues = Issue::latest()->where('assignee_id','=','2')->get();
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

    public function getBlog()
    {
        $this->blogs = Post::latest()->get();
    }


    public function getTask()
    {
        $this->myTasks = Task::latest()->where('allocated_id', '=', auth()->id())->get();
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
    public function getopenTask()
    {
        $this->openTasks = Task::latest()->where('allocated_id', '=', '2')->get();
    }



    public function render()
    {
        $this->getIssue();
        $this->getBlog();
        $this->getTask();
        $this->getopenTask();
        $this->getmyIssue();

        return view('livewire.web.dashboard.index');
    }
}
