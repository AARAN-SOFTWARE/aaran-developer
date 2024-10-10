<?php

namespace App\Livewire\Common\DemoRequest;

use Aaran\Web\Models\DemoRequest;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    public $phone;
    public $email;
    public $subject;
    public $message;

    public function getSave()
    {
        $this->validate([
                'email' => 'required|email',
                'phone' => 'required|numeric|digits:10',
            ]
        );
        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $DemoRequest = new DemoRequest();
                $extraFields = [
                    'phone' => $this->phone,
                    'email' => $this->email,
                    'subject' => $this->subject,
                    'message' => $this->message,
                ];
                $this->common->save($DemoRequest, $extraFields);
                $message = "Saved";
            }else {
                $DemoRequest = DemoRequest::find($this->common->vid);
                $extraFields = [
                    'phone' => $this->phone,
                    'email' => $this->email,
                    'subject' => $this->subject,
                    'message' => $this->message,
                ];
                $this->common->edit($DemoRequest, $extraFields);
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
        $this->clearFields();
    }

    #region[Get-Obj]
    public function getObj($id)
    {
        if ($id) {
            $DemoRequest = DemoRequest::find($id);
            $this->common->vid = $DemoRequest->id;
            $this->common->vname = $DemoRequest->vname;
            $this->phone = $DemoRequest->phone;
            $this->email = $DemoRequest->email;
            $this->subject = $DemoRequest->subject;
            $this->message = $DemoRequest->message;
            return $DemoRequest;
        }
        return null;
    }
    #endregion

    #region[Clear-Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->phone = '';
        $this->email = '';
        $this->subject = '';
        $this->message = '';
        $this->common->active_id = 1;
    }

    #endregion
    public function render()
    {
        return view('livewire.common.demo-request.index')->with([
            'list' => $this->getListForm->getList(DemoRequest::class,function ($query){
                return $query->where('id','>','');
            }),
        ]);
    }
}
