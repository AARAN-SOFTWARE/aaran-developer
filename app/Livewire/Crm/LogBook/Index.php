<?php

namespace App\Livewire\Crm\LogBook;

use Aaran\Crm\Models\Logbook;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class Index extends Component
{

    use CommonTraitNew;

    #region[property]
    public $action;
    public $description;

    #endregion

    #region[Validation]
    public function rules(): array
    {
        return [
            'common.vname' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'common.vname.required' => ' Mention The :attribute',
        ];
    }

    public function validationAttributes()
    {
        return [
            'common.vname' => 'Model',
        ];
    }
    #endregion

    #region[getSave]
    public function getSave(): void
    {
        $this->validate($this->rules());

        if ($this->common->vid == '') {

            $logbook = new Logbook();

            $extraFields = [
                'action' => $this->action,
                'description' => $this->description,
                'user_id' => auth()->id(),
            ];

            $this->common->save($logbook, $extraFields);
            $this->clearFields();
            $message = "Saved";
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $obj = Logbook::find($id);
            $this->common->vid = $obj->id;
            $this->common->vname = $obj->vname;
            $this->action = $obj->body;
            $this->description = $obj->action_id;
            $this->common->active_id = $obj->active_id;
            return $obj;
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
        $this->action = '';
        $this->description = '';

    }
    #endregion

    #region[Render]
    public function render()
    {
        return view('livewire.crm.log-book.index')->with([
            'list' => $this->getListForm->getList(Logbook::class),
        ]);
    }
    #endregion

}
