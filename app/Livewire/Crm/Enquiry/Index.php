<?php

namespace App\Livewire\Crm\Enquiry;

use Aaran\Crm\Models\Enquiry;
use Aaran\Common\Models\Common;
use Aaran\Master\Models\Contact;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;
    public $contact_id = 1;

    #region[Properties]
    public string $body = '';
    public mixed $status_id;
    public $contact_person;
    public $mobile;
    public $whatsapp;
    public $email;
    #endregion

    //
    public $showConfirmation = false;
    public $existingData = [];
    //

//    #region[Auto-fill]
//    public function updatedCommonVname($value)
//    {
//        $obj = Enquiry::where('vname', $value)->first();
//
//        if ($obj) {
//            $this->whatsapp = $obj->whatsapp;
//            $this->email = $obj->email;
//        } else {
//            $this->whatsapp = '';
//            $this->email = '';
//        }
//    }
//    #endregion

   #region[Confirmation Message and Auto-Fill]
    public function updatedCommonVname($value)
    {
        // Check if mobile exists
        $existingEntry = Enquiry::where('vname', $value)->first();

        if ($existingEntry) {
            $this->showConfirmation = true;
            $this->existingData = [
                'contact_person' => $existingEntry->contact_person,
                'whatsapp' => $existingEntry->whatsapp,
                'email' => $existingEntry->email,
            ];
        } else {
            $this->showConfirmation = false;
            $this->existingData = [];
        }
    }

    public function autofill()
    {
        // Autofill fields with existing data
        $this->contact_person = $this->existingData['contact_person'];
        $this->whatsapp = $this->existingData['whatsapp'];
        $this->email = $this->existingData['email'];

        $this->showConfirmation = false; // Hide the confirmation message
    }

    #endregion


    #region[Rules]
    public function rules(): array
    {
        return [
            'common.vname' => 'required|min:10',
            'contact_person' => 'required',
            'body' => 'required|min:5',
        ];
    }
    #endregion

    #region[Validation]
    public function validationAttributes()
    {
        return [
            'common.vname' => 'Mobile',
            'body' => 'Description',
            'contact_person' => 'Contact Name',
        ];
    }
    #endregion

    #region[Messages]
    public function messages()
    {
        return [
            'common.vname.required' => ' :attribute is required.',
            'body.required' => ' :attribute is required.',
            'contact_person.required' => ' :attribute is required.',

            //
            'mobile.required' => ' :attribute is required.',
            //

        ];
    }
    #endregion

    #region[getSave]
    public function getSave(): void
    {
        $this->validate($this->rules());

        if ($this->common->vname != '') {

            if ($this->common->vid == '') {

                $obj = new Enquiry();

                $extraFields = [
                    'contact_id' => $this->contact_id?:1,
                    'contact_person' => $this->contact_person,
                    'body' => $this->body,
                    'whatsapp' => $this->whatsapp,
                    'email' => $this->email,
                    'active_id' => 1
                ];

                $this->common->save($obj, $extraFields);
                $this->clearFields();
                $message = "Saved";

            } else {

                $obj = Enquiry::find($this->common->vid);

                $extraFields = [
                    'contact_id' => $this->contact_id?:1,
                    'contact_person' => $this->contact_person,
                    'body' => $this->body,
//                    'status_id' => $this->status_id ?: 1,
                    //
                    'whatsapp' => $this->whatsapp,
                    'email' => $this->email,
                    //
                ];
                $this->common->edit($obj, $extraFields);
                $this->clearFields();
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
//        $this-> redirect(route('enquiries'));
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $Common = Enquiry::find($id);
            $this->common->vid = $Common->id;
            $this->common->vname = $Common->vname;
            $this->contact_person = $Common->contact_person;
            $this->common->active_id = $Common->active_id;
//            $this->contact_name = $Common->contact_name;
            $this->whatsapp = $Common->whatsapp;
            $this->email = $Common->email;
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
        $this->contact_person = '';
        $this->common->active_id = '1';
        $this->contact_id = '';
//        $this->contact_name = '';
        //
        $this->whatsapp = '';
        $this->email = '';
        //
        $this->body = '';
        $this->status_id = '';
    }
    #endregion



//    #region[Contact]
//    #[validate]
//    public $contact_name = '';
//    public $contact_id = '';
//    public Collection $contactCollection;
//    public $highlightContact = 0;
//    public $contactTyped = false;
//
//    public function decrementContact(): void
//    {
//        if ($this->highlightContact === 0) {
//            $this->highlightContact = count($this->contactCollection) - 1;
//            return;
//        }
//        $this->highlightContact--;
//    }
//
//    public function incrementContact(): void
//    {
//        if ($this->highlightContact === count($this->contactCollection) - 1) {
//            $this->highlightContact = 0;
//            return;
//        }
//        $this->highlightContact++;
//    }
//
//    public function setContact($name, $id): void
//    {
//        $this->contact_name = $name;
//        $this->contact_id = $id;
//        $this->getContactList();
//    }
//
//    public function enterContact(): void
//    {
//        $obj = $this->contactCollection[$this->highlightContact] ?? null;
//
//        $this->contact_name = '';
//        $this->contactCollection = Collection::empty();
//        $this->highlightContact = 0;
//
//        $this->contact_name = $obj['vname'] ?? '';
//        $this->contact_id = $obj['id'] ?? '';
//    }
//
//    #[On('refresh-contact')]
//    public function refreshContact($v): void
//    {
//        $this->contact_id = $v['id'];
//        $this->contact_name = $v['name'];
//        $this->contactTyped = false;
//
//    }
//
//    public function getContactList(): void
//    {
//
//        $this->contactCollection = $this->contact_name ? Contact::search(trim($this->contact_name))
//            ->where('company_id', '=', session()->get('company_id'))
//            ->get() : Contact::where('company_id', '=', session()->get('company_id'))->get();
//
//    }
//
//    #endregion

    #region[render]
    public function render()
    {
//        $this->getContactList();
        return view('livewire.crm.enquiry.index')->with([
            'enquiries' => $this->getListForm->getList(Enquiry::class, function ($query) {
                return $query->orderBy('id', 'asc');
            }),
        ]);
    }
    #endregion
}

