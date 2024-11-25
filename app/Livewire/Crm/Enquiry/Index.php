<?php

namespace App\Livewire\Crm\Enquiry;

use Aaran\Crm\Models\Enquiry;
use Aaran\Master\Models\Contact;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    #region[Properties]
    public string $body = '';
    public mixed $status_id;
    #endregion

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $obj = new Enquiry();
                $extraFields = [
                    'contact_id' => $this->contact_id,
                    'body' => $this->body,
                    'status_id' => $this->status_id?:1,
                ];
                $this->common->save($obj, $extraFields);
                $this->clearFields();
                $message = "Saved";
            } else {
                $obj = Enquiry::find($this->common->vid);
                $extraFields = [
                    'contact_id' => $this->contact_id,
                    'body' => $this->body,
                    'status_id' => $this->status_id?:1,
                ];
                $this->common->edit($obj, $extraFields);
                $this->clearFields();
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $Common = Enquiry::find($id);
            $this->common->vid = $Common->id;
            $this->common->vname = $Common->vname;
            $this->common->active_id = $Common->active_id;
            $this->contact_id = $Common->contact_id;
            $this->body = $Common->body;
            $this->status_id = $Common->status_id;
            return $Common;
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
        $this->contact_id = '';
        $this->body = '';
        $this->status_id = '';
    }
    #endregion

    #region[Contact]
    #[validate]
    public $contact_name = '';
    public $contact_id = '';
    public Collection $contactCollection;
    public $highlightContact = 0;
    public $contactTyped = false;

    public function decrementContact(): void
    {
        if ($this->highlightContact === 0) {
            $this->highlightContact = count($this->contactCollection) - 1;
            return;
        }
        $this->highlightContact--;
    }

    public function incrementContact(): void
    {
        if ($this->highlightContact === count($this->contactCollection) - 1) {
            $this->highlightContact = 0;
            return;
        }
        $this->highlightContact++;
    }

    public function setContact($name, $id): void
    {
        $this->contact_name = $name;
        $this->contact_id = $id;
        $this->getContactList();
    }

    public function enterContact(): void
    {
        $obj = $this->contactCollection[$this->highlightContact] ?? null;

        $this->contact_name = '';
        $this->contactCollection = Collection::empty();
        $this->highlightContact = 0;

        $this->contact_name = $obj['vname'] ?? '';
        $this->contact_id = $obj['id'] ?? '';
    }

    #[On('refresh-contact')]
    public function refreshContact($v): void
    {
        $this->contact_id = $v['id'];
        $this->contact_name = $v['name'];
        $this->contactTyped = false;

    }

    public function getContactList(): void
    {

        $this->contactCollection = $this->contact_name ? Contact::search(trim($this->contact_name))
            ->where('company_id', '=', session()->get('company_id'))
            ->get() : Contact::where('company_id', '=', session()->get('company_id'))->get();

    }

    #endregion

    #region[Render]
    public function getRoute()
    {
        return route('enquiries');
    }

    public function render()
    {
        $this->getContactList();
        return view('livewire.crm.enquiry.index')->with([
            'list' => $this->getListForm->getList(Enquiry::class, function ($query) {
                return $query->orderBy('id', 'asc');
            }),
        ]);
    }
    #endregion
}
