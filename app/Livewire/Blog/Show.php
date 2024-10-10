<?php

namespace App\Livewire\Blog;

use Aaran\Blog\Models\Comment;
use Aaran\Blog\Models\Post;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    use CommonTraitNew;


    public $posts;
    public $post_id;
    public $vid = '';
    public $body;
    public $user_id;
    public $commentsCount;


    public function mount($id = null)
    {
        if ($id != null) {
            $this->posts = Post::find($id);
            $this->post_id = $id;
            $this->user_id = Auth::id();
            $this->commentsCount = Comment::where('post_id', $id)->count();
        }
    }

    #region[Save]
    public function save()
    {
        $this->validate([
                'user_id' => 'required',
                'body' => 'required|min:3',
            ]
        );
        if ($this->post_id != '') {
            if ($this->vid == '') {
                Comment::create([
                    'body' => $this->body,
                    'user_id' => Auth::id(),
                    'post_id' => $this->post_id,
                ]);
            } else {
                $comment = Comment::find($this->vid);
                $comment->body = $this->body;
                $comment->user_id = Auth::id();
                $comment->post_id = $this->post_id;
                if ($comment->user_id == Auth::id()) {
                    $comment->save();
                }
            }
            $this->clearFields();
        }
    }

    #endregion

    public
    function clearFields()
    {
        $this->body = '';

    }

    #region[Edit]
    public
    function editComment($id)
    {
        $obj = Comment::find($id);
        $this->vid = $obj->id;
        $this->body = $obj->body;
        $this->user_id = $obj->user_id;
        $this->post_id = $obj->post_id;
    }

    public
    function deleteComment($id)
    {
        $obj = Comment::find($id);
        $obj->delete();
    }

    #endregion

    public function getObj($id)
    {
        if ($id){
            $Comment = Comment::find($id);
            $this->common->vid = $Comment->id;
            return $Comment;
        }
        return null;
    }
    public
    function render()
    {
        return view('livewire.blog.show')->with([
            'list' => Comment::where('post_id', '=', $this->post_id)->orderBy('created_at', 'desc')
                ->paginate(5)
        ]);
    }
}
