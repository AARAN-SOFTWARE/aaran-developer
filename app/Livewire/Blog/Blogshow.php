<?php

namespace App\Livewire\Blog;

use Aaran\Blog\Models\Post;
use Livewire\Component;

class Blogshow extends Component
{
    public $blog;

    public function mount($id)
    {
          $this->blog = Post::find($id);
    }

    public function render()
    {
        return view('livewire.blog.blogshow')->layout('layouts.web');
    }
}
