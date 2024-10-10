<?php

namespace App\Livewire\Demo\Data\Factory;

use Aaran\Entries\Models\Purchaseitem;
use Aaran\Entries\Models\Saleitem;
use Aaran\Master\Models\Company;
use Aaran\Master\Models\ContactDetail;
use Aaran\Master\Models\Order;
use Aaran\Master\Models\Product;
use Aaran\Master\Models\Style;
use Aaran\Transaction\Models\Transaction;
use Livewire\Component;

class Index extends Component
{
    public $count;
    public function runFactoryProduct()
    {
        Product::factory()->count($this->count)->create();
        $successMessage = 'Factory Create Successfully.';
        $this->dispatch('notify', ...['type' => 'success', 'content' => $successMessage]);
    }

    public function runFactoryCompany()
    {
        Company::factory()->count($this->count)->create();
        $successMessage = 'Factory Create Successfully.';
        $this->dispatch('notify', ...['type' => 'success', 'content' => $successMessage]);
    }

    public function runFactoryContactDetail()
    {
        ContactDetail::factory()->count($this->count)->create();
        $successMessage = 'Factory Create Successfully.';
        $this->dispatch('notify', ...['type' => 'success', 'content' => $successMessage]);
    }

    public function runFactoryOrder()
    {
        Order::factory()->count($this->count)->create();
        $successMessage = 'Factory Create Successfully.';
        $this->dispatch('notify', ...['type' => 'success', 'content' => $successMessage]);
    }

    public function runFactoryStyle()
    {
        Style::factory()->count($this->count)->create();
        $successMessage = 'Factory Create Successfully.';
        $this->dispatch('notify', ...['type' => 'success', 'content' => $successMessage]);
    }

    public function runFactoryTransaction()
    {
        Transaction::factory()->count($this->count)->create();
        $successMessage = 'Factory Create Successfully.';
        $this->dispatch('notify', ...['type' => 'success', 'content' => $successMessage]);
    }

    public function runFactorySale()
    {
        Saleitem::factory()->count($this->count)->create();
        $successMessage = 'Factory Create Successfully.';
        $this->dispatch('notify', ...['type' => 'success', 'content' => $successMessage]);
    }

    public function runFactoryPurchaseItem()
    {
        Purchaseitem::factory()->count($this->count)->create();
        $successMessage = 'Factory Create Successfully.';
        $this->dispatch('notify', ...['type' => 'success', 'content' => $successMessage]);
    }
    public function render()
    {
        return view('livewire.demo.data.factory.index');
    }
}
