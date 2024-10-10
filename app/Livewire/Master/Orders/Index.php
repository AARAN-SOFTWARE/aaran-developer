<?php

namespace App\Livewire\Master\Orders;

use Aaran\Master\Models\Order;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    #region[properties]
    public $order_name = '';
    #endregion

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $order = new Order();
                $extraFields = [
                    'order_name' => $this->order_name,
                    'company_id' => session()->get('company_id'),
                ];
                $this->common->save($order, $extraFields);
                $message = "Saved";
            } else {
                $order = Order::find($this->common->vid);
                $extraFields = [
                    'order_name' => $this->order_name,
                    'company_id' => session()->get('company_id'),
                ];
                $this->common->edit($order, $extraFields);
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message.' Successfully']);
        }
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $order = Order::find($id);
            $this->common->vid = $order->id;
            $this->common->vname = $order->vname;
            $this->common->active_id = $order->active_id;
            $this->order_name = $order->order_name;
            return $order;
        }
        return null;
    }
    #endregion

    #region[clearFields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->common->active_id = '1';
        $this->order_name = '';
    }
    #endregion

    #region[getRoute]
    public function getRoute()
    {
        return route('orders');
    }
    #endregion

    #region[render]
    public function render()
    {
        $this->getListForm->searchField = 'order_name';

        return view('livewire.master.orders.index')->with([
            'list' => $this->getListForm->getList(Order::class,function ($query){
                return $query->where('company_id',session()->get('company_id'));
            }),
        ]);
    }
    #endregion
}
