<?php

namespace App\Livewire\Client\Payment;

use Aaran\Client\Models\Payment;
use Aaran\Client\Models\SoftReq;
use Aaran\Common\Models\Common;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Collection;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    #region[property]
    public $status_id;
    public $remarks;
    public $vdate;
    public $softData;
    #endregion

    public function mount($id)
    {
        $this->softData = SoftReq::find($id);
//        dd($this->taskData);
    }

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vid == '') {
            $payment = new Payment();
            $extraFields = [
                'remarks' => $this->remarks,
                'plan_id' => $this->plan_id,
                'software_id' => $this->software_id,
                'service_id' => $this->service_id,
                'status_id' => $this->status_id ?: 1,
                'vdate' => $this->vdate,
            ];
            $this->common->save($payment, $extraFields);
            $this->clearFields();
            $message = "Saved";
        } else {
            $payment = Payment::find($this->common->vid);
            $extraFields = [
                'remarks' => $this->remarks,
                'plan_id' => $this->plan_id,
                'software_id' => $this->status_id,
                'service_id' => $this->service_id,
                'status_id' => $this->status_id ?: 1,
                'vdate' => $this->vdate,
            ];
            $this->common->edit($payment, $extraFields);
            $this->clearFields();
            $message = "Updated";
        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
    }

    #endregion

    #region[plan]
    public $plan_id = '';
    public $plan_name = '';
    public Collection $planCollection;
    public $highlightPlan = 0;
    public $planTyped = false;

    public function decrementPlan(): void
    {
        if ($this->highlightPlan === 0) {
            $this->highlightPlan = count($this->planCollection) - 1;
            return;
        }
        $this->highlightPlan--;
    }

    public function incrementPlan(): void
    {
        if ($this->highlightPlan === count($this->planCollection) - 1) {
            $this->highlightPlan = 0;
            return;
        }
        $this->highlightPlan++;
    }

    public function setPlan($name, $id): void
    {
        $this->plan_name = $name;
        $this->plan_id = $id;
        $this->getPlanList();
    }

    public function enterPlan(): void
    {
        $obj = $this->planCollection[$this->highlightPlan] ?? null;

        $this->plan_name = '';
        $this->planCollection = Collection::empty();
        $this->highlightPlan = 0;

        $this->plan_name = $obj['vname'] ?? '';
        $this->plan_id = $obj['id'] ?? '';
    }

    public function refreshPlan($v): void
    {
        $this->plan_id = $v['id'];
        $this->plan_name = $v['name'];
        $this->planTyped = false;
    }

    public function planSave($name)
    {
        $obj = Common::create([
            'label_id' => 27, // Assuming label_id for plans is 24
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshPlan($v);
    }

    public function getPlanList(): void
    {
        $this->planCollection = $this->plan_name ?
            Common::search(trim($this->plan_name))->where('label_id', '=', '27')->get() :
            Common::where('label_id', '=', '27')->orWhere('label_id', '=', '24')->get();
    }
#endregion

    #region[service]
    public $service_id = '';
    public $service_name = '';
    public Collection $serviceCollection;
    public $highlightService = 0;
    public $serviceTyped = false;

    public function decrementService(): void
    {
        if ($this->highlightService === 0) {
            $this->highlightService = count($this->serviceCollection) - 1;
            return;
        }
        $this->highlightService--;
    }

    public function incrementService(): void
    {
        if ($this->highlightService === count($this->serviceCollection) - 1) {
            $this->highlightService = 0;
            return;
        }
        $this->highlightService++;
    }

    public function setService($name, $id): void
    {
        $this->service_name = $name;
        $this->service_id = $id;
        $this->getServiceList();
    }

    public function enterService(): void
    {
        $obj = $this->serviceCollection[$this->highlightService] ?? null;

        $this->service_name = '';
        $this->serviceCollection = Collection::empty();
        $this->highlightService = 0;

        $this->service_name = $obj['vname'] ?? '';
        $this->service_id = $obj['id'] ?? '';
    }

    public function refreshService($v): void
    {
        $this->service_id = $v['id'];
        $this->service_name = $v['name'];
        $this->serviceTyped = false;
    }

    public function serviceSave($name)
    {
        $obj = Common::create([
            'label_id' => 28, // Assuming label_id for services is 24
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshService($v);
    }

    public function getServiceList(): void
    {
        $this->serviceCollection = $this->service_name ?
            Common::search(trim($this->service_name))->where('label_id', '=', '28')->get() :
            Common::where('label_id', '=', '28')->orWhere('label_id', '=', '24')->get();
    }
#endregion

    #region[software]
    public $software_id = '';
    public $software_name = '';
    public Collection $softwareCollection;
    public $highlightSoftware = 0;
    public $softwareTyped = false;

    public function decrementSoftware(): void
    {
        if ($this->highlightSoftware === 0) {
            $this->highlightSoftware = count($this->softwareCollection) - 1;
            return;
        }
        $this->highlightSoftware--;
    }

    public function incrementSoftware(): void
    {
        if ($this->highlightSoftware === count($this->softwareCollection) - 1) {
            $this->highlightSoftware = 0;
            return;
        }
        $this->highlightSoftware++;
    }

    public function setSoftware($name, $id): void
    {
        $this->software_name = $name;
        $this->software_id = $id;
        $this->getSoftwareList();
    }

    public function enterSoftware(): void
    {
        $obj = $this->softwareCollection[$this->highlightSoftware] ?? null;

        $this->software_name = '';
        $this->softwareCollection = Collection::empty();
        $this->highlightSoftware = 0;

        $this->software_name = $obj['vname'] ?? '';
        $this->software_id = $obj['id'] ?? '';
    }

    public function refreshSoftware($v): void
    {
        $this->software_id = $v['id'];
        $this->software_name = $v['name'];
        $this->softwareTyped = false;
    }

    public function softwareSave($name)
    {
        $obj = Common::create([
            'label_id' => 26, // Assuming label_id for software is 24
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshSoftware($v);
    }

    public function getSoftwareList(): void
    {
        $this->softwareCollection = $this->software_name ?
            Common::search(trim($this->software_name))->where('label_id', '=', '26')->get() :
            Common::where('label_id', '=', '26')->orWhere('label_id', '=', '24')->get();
    }
#endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $obj = Payment::find($id);
            $this->common->vid = $obj->id;
            $this->common->vname = $obj->vname;
            $this->remarks = $obj->remarks;
            $this->status_id = $obj->status_id;
            $this->vdate = $obj->due_date;
            $this->plan_id = $obj->plan_id;
            $this->plan_name = Common::find($obj->plan_id)->vname;
            $this->software_id = $obj->software_id;
            $this->software_name = Common::find($obj->software_id)->vname;
            $this->service_id = $obj->service_id;
            $this->service_name = Common::find($obj->service_id)->vname;
            $this->common->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->common->active_id = '1';
        $this->remarks = '';
        $this->status_id = '';
        $this->vdate = '';
        $this->plan_id = '';
        $this->plan_name = '';
        $this->software_id = '';
        $this->software_name = '';
        $this->status_id = '';
        $this->service_id = '';
        $this->service_name = '';
    }
    #endregion

    public function render()
    {
        $this->getPlanList();
        $this->getSoftwareList();
        $this->getServiceList();
        return view('livewire.client.payment.index')->with([
            'list' => $this->getListForm->getList(Payment::class),
        ]);
    }
}
