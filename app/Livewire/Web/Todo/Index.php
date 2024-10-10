<?php

namespace App\Livewire\Web\Todo;

use Aaran\Web\Models\Todo;
use App\Livewire\Trait\CommonTraitNew;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Rule('required|min:4|max:60')]
    public mixed $name;
    public $search;

    public function create()
    {
        $validated = $this->validateOnly('name');

        Todo::create([
            'name' => $validated['name'],
        ]);
//        dd($validated);
        $this->reset('name');
        $this->name='';
        session()->flash('success', 'Created');
//        $this->redirect(route('todos'));
    }

    public function delete(Todo $todoId)
    {
        $todoId->delete();
    }

    public function render()
    {
        return view('livewire.web.todo.index', [
            'todo' => Todo::latest()
                ->where('name', 'like', '%' . $this->search . '%')
                ->paginate(5)
        ]);
    }

}
