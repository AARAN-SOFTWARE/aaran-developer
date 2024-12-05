<?php

namespace App\Livewire\Crm\Enquiry;

use Aaran\Crm\Models\Enquiry;
use Aaran\Master\Models\Contact;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Upsert extends Component
{
    use CommonTraitNew;

    #region[Properties]
    public string $body = '';
    public mixed $status_id;
    public $enq;

    //
    public $mobile;
    public $whatsapp;
    public $email;
    //

    #endregion

    #region[Validation]
    public function rules(): array
    {
        return [
            'common.vname' => 'required|min:3',
            'body' => 'required|min:5',
            //
            'mobile' => 'required|min:10',
            //
        ];
    }

    public function messages()
    {
        return [
            'common.vname.required' => ' :attribute is required.',
            'body.required' => ' :attribute is required.',
            //
            'mobile.required' => ' :attribute is required.',
            //

        ];
    }

    public function mount($id)
    {
        if ($id != 0) {
            $obj = Enquiry::find($id);
            $this->common->vid = $obj->id;
            $this->common->vname = $obj->vname;
            $this->contact_id = $obj->contact_id;
            $this->contact_name = $obj->contact->vname;
            //
            $this->mobile = $obj->mobile;
            $this->whatsapp = $obj->whatsapp;
            $this->email = $obj->email;
            //
            $this->body = $obj->body;
            $this->status_id = $obj->status_id;
            $this->common->active_id =$obj->active_id;
        }
    }

    public function validationAttributes()
    {
        return [
            'common.vname' => 'Title',
            'body' => 'Description',
        ];
    }
    #endregion

    #region[getSave]
    public
    function getSave(): void
    {
        $this->validate($this->rules());

        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $obj = new Enquiry();
                $extraFields = [
                    'contact_id' => $this->contact_id,
                    'body' => $this->body,
//                    'status_id' => $this->status_id ?: 1,
                    //
                    'mobile' => $this->mobile,
                    'whatsapp' => $this->whatsapp,
                    'email' => $this->email,
                    //
                    'active_id' => 1
                ];
                $this->common->save($obj, $extraFields);
                $this->clearFields();
                $message = "Saved";
            } else {
                $obj = Enquiry::find($this->common->vid);
                $extraFields = [
                    'contact_id' => $this->contact_id,
                    'body' => $this->body,
                    'status_id' => $this->status_id ?: 1,
                    //
                    'mobile' => $this->mobile,
                    'whatsapp' => $this->whatsapp,
                    'email' =>$this->email,
                    //
                ];
                $this->common->edit($obj, $extraFields);
                $this->clearFields();
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
        $this-> redirect(route('enquiries'));
    }

#endregion


    #region[getObj]
    public
    function getObj($id)
    {
        if ($id) {
            $Common = Enquiry::find($id);
            $this->common->vid = $Common->id;
            $this->common->vname = $Common->vname;
            $this->common->active_id = $Common->active_id;
            $this->contact_id = $Common->contact_id;
            $this->contact_name = $Common->contact_name;
            //
            $this->mobile = $Common->mobile;
            $this->whatsapp = $Common->whatsapp;
            $this->email = $Common->email;
            //
            $this->body = $Common->body;
            $this->status_id = $Common->status_id;
            return $Common;
        }
        return null;
    }

#endregion

    #region[Clear Fields]
    public
    function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->common->active_id = '1';
        $this->contact_id = '';
        $this->contact_name = '';
        //
        $this->mobile = '';
        $this->whatsapp = '';
        $this->email = '';
        //
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

    #endregion

    #region[Render]
    public function getRoute()
    {
        $this->redirect(route('enquiries'));
    }

    public function render()
    {

        $this->getContactList();
        return view('livewire.crm.enquiry.upsert');

    }

    public function getBack()
    {
        return route('enquiries');
    }
    #endregion
}
