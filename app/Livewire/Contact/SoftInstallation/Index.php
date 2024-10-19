<?php

namespace App\Livewire\Contact\SoftInstallation;

use Aaran\Contact\Models\SoftInstallation;
use Aaran\Master\Models\Contact;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Collection;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;
    #region[Properties]
    public $domain_url;
    public $db_user;
    public $db_password;
    public $git_url;
    public $soft_version;
    public $status;
    public  $install_date;

    #endregion

    #region[Get-Save]
    public function getSave(): void
    {
        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $SoftInstallation = new SoftInstallation();
                $extraFields = [
                    'contact_id' => $this->contact_id,
                    'domain_url' => $this->domain_url,
                    'db_user' => $this->db_user,
                    'db_password' => $this->db_password,
                    'git_url' => $this->git_url,
                    'soft_version' => $this->soft_version,
                    'status' => $this->status,
                    'install_date' => $this->install_date
                ];
                $this->common->save($SoftInstallation, $extraFields);
                $message = "Saved";
            } else {
                $SoftInstallation = SoftInstallation::find($this->common->vid);
                $extraFields = [
                    'contact_id' => $this->contact_id,
                    'domain_url' => $this->domain_url,
                    'db_user' => $this->db_user,
                    'db_password' => $this->db_password,
                    'git_url' => $this->git_url,
                    'soft_version' => $this->soft_version,
                    'status' => $this->status,
                    'install_date' => $this->install_date
                ];
                $this->common->edit($SoftInstallation, $extraFields);
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
    }
    #endregion

    #region[Contact]

    public $contact_id = '';
    public $contact_name = '';
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

    public function refreshContact($v): void
    {
        $this->contact_id = $v['id'];
        $this->contact_name = $v['name'];
        $this->contactTyped = false;
    }

    public function getContactList(): void
    {
        $this->contactCollection = !empty($this->contact_name) ? Contact::search(trim($this->contact_name))
            ->get() : Contact::all();
    }

    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $SoftInstallation = SoftInstallation::find($id);
            $this->common->vid = $SoftInstallation->id;
            $this->common->vname = $SoftInstallation->vname;
            $this->contact_id = $SoftInstallation->contact_id;
            $this->contact_name = $SoftInstallation->contact_id ? Contact::find($SoftInstallation->contact_id)->vname : '';
            $this->domain_url = $SoftInstallation->domain_url;
            $this->db_user = $SoftInstallation->db_user;
            $this->db_password = $SoftInstallation->db_password;
            $this->git_url = $SoftInstallation->git_url;
            $this->soft_version = $SoftInstallation->soft_version;
            $this->status = $SoftInstallation->status;
            $this->install_date = $SoftInstallation->install_date;
            $this->common->active_id = $SoftInstallation->active_id;
            return $SoftInstallation;
        }
        return null;
    }

    #region[Clear-Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->contact_id = '';
        $this->contact_name = '';
        $this->domain_url = '';
        $this->db_user = '';
        $this->db_password = '';
        $this->git_url = '';
        $this->soft_version = '';
        $this->status = '';
        $this->install_date = '';
        $this->common->active_id = '1';
    }
    #endregion

    #endregion
    public function render()
    {
        $this->getContactList();

        return view('livewire.contact.soft-installation.index')->with([
            'soft' => $this->getListForm->getList(SoftInstallation::class),
        ]);
    }
}
