<?php

namespace App\Livewire\Web\Dashboard;

use Aaran\Blog\Models\Post;
use Aaran\Entries\Models\Purchase;
use Aaran\Entries\Models\Sale;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\Product;
use Aaran\Transaction\Models\Transaction;
use App\Helper\ConvertTo;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;


    public $blogs;
    public $user;


    public function getBlog()
    {
        $this->blogs = Post::latest()->get();
    }


    public function render()
    {
        $this->getBlog();

        return view('livewire.web.dashboard.index');
    }
}
