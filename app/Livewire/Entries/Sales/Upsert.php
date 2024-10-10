<?php

namespace App\Livewire\Entries\Sales;

use Aaran\Common\Models\Common;
use Aaran\Entries\Models\Sale;
use Aaran\Entries\Models\Saleitem;
use Aaran\Entries\Models\SalesEvent;
use Aaran\Master\Models\Company;
use Aaran\Master\Models\Contact;
use Aaran\Master\Models\ContactDetail;
use Aaran\Master\Models\Order;
use Aaran\Master\Models\Product;
use Aaran\Master\Models\Style;
use Aaran\MasterGst\Models\MasterGstEway;
use Aaran\MasterGst\Models\MasterGstIrn;
use Aaran\MasterGst\Models\MasterGstToken;
use App\Livewire\Forms\MasterGstApi;
use App\Livewire\Trait\CommonTraitNew;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Upsert extends Component
{
    use CommonTraitNew;

    #region[E-invoice properties]
    public MasterGstApi $masterGstApi;
    public $e_invoiceDetails;
    public $e_wayDetails;
    public $token;
    public $irnData;
    public $IrnCancel;
    public $sales_id;
    public $Irn_no;
    public $CnlRsn;
    public $CnlRem;
    #[validate]
    public $distance=0;
    public $showModel=false;
    public $successMessage='';
    public $Transid;
    public $Transname;
    public $Transdocno;
    public $TransdocDt;
    #[validate]
    public $Vehno;
    public $Vehtype;
    public $TransMode;
    #endregion

    #region[Properties]
    public string $uniqueno = '';
    public string $acyear = '';
    public string $invoice_no = '';
    public string $invoice_date = '';
    public string $sales_type = '';
    public string $destination = '';
    public string $bundle = '';
    public mixed $total_qty = 0;
    public mixed $total_taxable = '';
    public string $total_gst = '';
    public mixed $additional = '';
    public mixed $round_off = '';
    public mixed $grand_total = '';
    public mixed $qty = '';
    public mixed $price = '';
    public string $gst_percent = '';
    public string $itemIndex = "";
    #[validate]
    public $itemList = [];
    public $description;

    public string $company;
    public string $contact;
    public string $order;
    public string $transport;
    public string $ledger;
    public string $sale;
    public string $product;
    public string $colour;
    public string $size;
    public mixed $job_no = '';
    public $po_no;
    public $grandtotalBeforeRound;
    public $dc_no;
    public $no_of_roll;
    #endregion

    #region[rules]
    public function rules(): array
    {
        return [
            'contact_name' => 'required',
            'transport_name' => 'required',
            'distance' => 'required',
            'Vehno' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'contact_name.required' => 'The :attribute is required.',
            'transport_name.required' => 'The :attribute is required.',
            'distance.required' => 'The :attribute is required.',
            'Vehno.required' => 'The :attribute is required.',
        ];
    }

    public function validationAttributes()
    {
        return [
            'contact_name' => 'party name',
            'transport_name' => 'transport name',
            'distance' => 'distance ',
            'Vehno' => 'Vechile no',
        ];
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

    #region[Billing Address]
    public mixed $billing_id = '';

    public $billing_address = '';
    public Collection $billing_addressCollection;
    public $highlightBilling_address = 0;
    public $billing_addressTyped = false;

    public function decrementBilling_address(): void
    {
        if ($this->highlightBilling_address === 0) {
            $this->highlightBilling_address = count($this->billing_addressCollection) - 1;
            return;
        }
        $this->highlightBilling_address--;
    }

    public function incrementBilling_address(): void
    {
        if ($this->highlightBilling_address === count($this->billing_addressCollection) - 1) {
            $this->highlightBilling_address = 0;
            return;
        }
        $this->highlightBilling_address++;
    }

    public function setBilling_address($name, $id): void
    {
        $this->billing_address = $name;
        $this->billing_id = $id;
        $this->getBilling_address();
    }

    public function enterBilling_address(): void
    {
        $obj = $this->billing_addressCollection[$this->highlightBilling_address] ?? null;

        $this->billing_address = '';
        $this->billing_addressCollection = Collection::empty();
        $this->highlightBilling_address = 0;

        $this->billing_address = $obj['address_1'] ?? '';
        $this->billing_id = $obj['id'] ?? '';
    }

    #[On('refresh-billing_address')]
    public function refreshBilling_address($v): void
    {
        $this->billing_id = $v['id'];
        $this->billing_address = $v['name'];
        $this->billing_addressTyped = false;

    }

    public function getBilling_address(): void
    {

        $this->billing_addressCollection = $this->billing_address ? contactDetail::search(trim($this->billing_address))
            ->where('contact_id', '=', $this->contact_id)
            ->get() : contactDetail::all()->where('contact_id', '=', $this->contact_id);

    }

    #endregion

    #region[Shipping Address]

    public mixed $shipping_id = '';

    public $shipping_address = '';
    public Collection $shipping_addressCollection;
    public $highlightShipping_address = 0;
    public $shipping_addressTyped = false;

    public function decrementShipping_address(): void
    {
        if ($this->highlightShipping_address === 0) {
            $this->highlightShipping_address = count($this->shipping_addressCollection) - 1;
            return;
        }
        $this->highlightShipping_address--;
    }

    public function incrementShipping_address(): void
    {
        if ($this->highlightShipping_address === count($this->shipping_addressCollection) - 1) {
            $this->highlightShipping_address = 0;
            return;
        }
        $this->highlightShipping_address++;
    }

    public function setShipping_address($name, $id): void
    {
        $this->shipping_address = $name;
        $this->shipping_id = $id;
        $this->getShipping_address();
    }

    public function enterShipping_address(): void
    {
        $obj = $this->shipping_addressCollection[$this->highlightShipping_address] ?? null;

        $this->shipping_address = '';
        $this->shipping_addressCollection = Collection::empty();
        $this->highlightShipping_address = 0;

        $this->shipping_address = $obj['address_1'] ?? '';
        $this->shipping_id = $obj['id'] ?? '';
    }

    #[On('refresh-shipping_address')]
    public function refreshContact_detail_1($v): void
    {
        $this->shipping_id = $v['id'];
        $this->shipping_address = $v['name'];
        $this->shipping_addressTyped = false;

    }

    public function getShipping_address(): void
    {

        $this->shipping_addressCollection = $this->shipping_address ? contactDetail::search(trim($this->shipping_address))
            ->where('contact_id', '=', $this->contact_id)
            ->get() : contactDetail::all()->where('contact_id', '=', $this->contact_id);

    }

    #endregion

    #region[Order]

    #[Rule('required')]
    public $order_id = '';
    public $order_name = '';
    public Collection $orderCollection;
    public $highlightOrder = 0;
    public $orderTyped = false;

    public function decrementOrder(): void
    {
        if ($this->highlightOrder === 0) {
            $this->highlightOrder = count($this->orderCollection) - 1;
            return;
        }
        $this->highlightOrder--;
    }

    public function incrementOrder(): void
    {
        if ($this->highlightOrder === count($this->orderCollection) - 1) {
            $this->highlightOrder = 0;
            return;
        }
        $this->highlightOrder++;
    }

    public function setOrder($name, $id): void
    {
        $this->order_name = $name;
        $this->order_id = $id;
        $this->getOrderList();
    }

    public function enterOrder(): void
    {
        $obj = $this->orderCollection[$this->highlightOrder] ?? null;

        $this->order_name = '';
        $this->orderCollection = Collection::empty();
        $this->highlightOrder = 0;

        $this->order_name = $obj['vname'] ?? '';
        $this->order_id = $obj['id'] ?? '';
    }

    #[On('refresh-order')]
    public function refreshOrder($v): void
    {
        $this->order_id = $v['id'];
        $this->order_name = $v['name'];
        $this->orderTyped = false;

    }

    public function getOrderList(): void
    {
        $this->orderCollection = $this->order_name ? Order::search(trim($this->order_name))
            ->where('company_id', '=', session()->get('company_id'))
            ->get() : Order::where('company_id', '=', session()->get('company_id'))->get();;
    }

    #endregion

    #region[Style]

    public $style_id = '';
    public $style_name = '';
    public \Illuminate\Support\Collection $styleCollection;
    public $highlightStyle = 0;
    public $styleTyped = false;

    public function decrementStyle(): void
    {
        if ($this->highlightStyle === 0) {
            $this->highlightStyle = count($this->styleCollection) - 1;
            return;
        }
        $this->highlightStyle--;
    }

    public function incrementStyle(): void
    {
        if ($this->highlightStyle === count($this->styleCollection) - 1) {
            $this->highlightStyle = 0;
            return;
        }
        $this->highlightStyle++;
    }

    public function enterStyle(): void
    {
        $obj = $this->styleCollection[$this->highlightStyle] ?? null;

        $this->style_name = '';
        $this->styleCollection = Collection::empty();
        $this->highlightStyle = 0;

        $this->style_name = $obj['vname'] ?? '';;
        $this->style_id = $obj['id'] ?? '';;
    }

    public function setStyle($name, $id): void
    {
        $this->style_name = $name;
        $this->style_id = $id;
        $this->getStyleList();
    }

    #[On('refresh-style')]
    public function refreshStyle($v): void
    {
        $this->style_id = $v['id'];
        $this->style_name = $v['name'];
        $this->styleTyped = false;

    }

    public function getStyleList(): void
    {
        $this->styleCollection = $this->style_name ? Style::search(trim($this->style_name))
            ->get() : Style::all();
    }

    #endregion

    #region[Transport]
    #[validate]
    public $transport_name = '';
    public $transport_id = '';
    public Collection $transportCollection;
    public $highlightTransport = 0;
    public $transportTyped = false;

    public function decrementTransport(): void
    {
        if ($this->highlightTransport === 0) {
            $this->highlightTransport = count($this->transportCollection) - 1;
            return;
        }
        $this->highlightTransport--;
    }

    public function incrementTransport(): void
    {
        if ($this->highlightTransport === count($this->transportCollection) - 1) {
            $this->highlightTransport = 0;
            return;
        }
        $this->highlightTransport++;
    }

    public function setTransport($name, $id): void
    {
        $this->transport_name = $name;
        $this->transport_id = $id;
        $this->getTransportList();
    }

    public function enterTransport(): void
    {
        $obj = $this->transportCollection[$this->highlightTransport] ?? null;

        $this->transport_name = '';
        $this->transportCollection = Collection::empty();
        $this->highlightTransport = 0;

        $this->transport_name = $obj['vname'] ?? '';
        $this->transport_id = $obj['id'] ?? '';
    }

    public function refreshTransport($v): void
    {
        $this->transport_id = $v['id'];
        $this->transport_name = $v['name'];
        $this->transportTyped = false;

    }

    public function transportSave($name)
    {
        if ($name) {
            $obj = Common::create([
                'label_id' => '10',
                'vname' => $name,
                'active_id' => '1',
            ]);
            $v = ['name' => $name, 'id' => $obj->id];
            $this->refreshTransport($v);
        }
    }

    public function getTransportList(): void
    {
        $this->transportCollection = $this->transport_name ? Common::search(trim($this->transport_name))->where('label_id',
            '=', 11)
            ->get() : Common::where('label_id', '=', 11)->Orwhere('id','=','1')->get();
    }

    #endregion

    #region[Despatch]

    public $despatch_id = '';
    public $despatch_name = '';
    public Collection $despatchCollection;
    public $highlightDespatch = 0;
    public $despatchTyped = false;

    public function decrementDespatch(): void
    {
        if ($this->highlightDespatch === 0) {
            $this->highlightDespatch = count($this->despatchCollection) - 1;
            return;
        }
        $this->highlightDespatch--;
    }

    public function incrementDespatch(): void
    {
        if ($this->highlightDespatch === count($this->despatchCollection) - 1) {
            $this->highlightDespatch = 0;
            return;
        }
        $this->highlightDespatch++;
    }

    public function setDespatch($name, $id): void
    {
        $this->despatch_name = $name;
        $this->despatch_id = $id;
        $this->getdespatchList();
    }

    public function enterDespatch(): void
    {
        $obj = $this->despatchCollection[$this->highlightDespatch] ?? null;

        $this->despatch_name = '';
        $this->despatchCollection = Collection::empty();
        $this->highlightDespatch = 0;

        $this->despatch_name = $obj['vname'] ?? '';
        $this->despatch_id = $obj['id'] ?? '';
    }

    public function refreshDespatch($v): void
    {
        $this->despatch_id = $v['id'];
        $this->despatch_name = $v['name'];
        $this->despatchTyped = false;

    }

    public function despatchSave($name)
    {
        if ($name) {
            $obj = Common::create([
                'label_id' => '12',
                'vname' => $name,
                'active_id' => '1',
            ]);
            $v = ['name' => $name, 'id' => $obj->id];
            $this->refreshDespatch($v);
        }
    }

    public function getDespatchList(): void
    {
        $this->despatchCollection = $this->despatch_name ? Common::search(trim($this->despatch_name))->where('label_id',
            '=', 12)
            ->get() : Common::where('label_id', '=', 12)->get();
    }

    #endregion

    #region[Ledger]

    public $ledger_id = '';
    public $ledger_name = '';
    public Collection $ledgerCollection;
    public $highlightLedger = 0;
    public $ledgerTyped = false;

    public function decrementLedger(): void
    {
        if ($this->highlightLedger === 0) {
            $this->highlightLedger = count($this->ledgerCollection) - 1;
            return;
        }
        $this->highlightLedger--;
    }

    public function incrementLedger(): void
    {
        if ($this->highlightLedger === count($this->ledgerCollection) - 1) {
            $this->highlightLedger = 0;
            return;
        }
        $this->highlightLedger++;
    }

    public function setLedger($name, $id): void
    {
        $this->ledger_name = $name;
        $this->ledger_id = $id;
        $this->getLedgerList();
    }

    public function enterLedger(): void
    {
        $obj = $this->ledgerCollection[$this->highlightLedger] ?? null;

        $this->ledger_name = '';
        $this->ledgerCollection = Collection::empty();
        $this->highlightLedger = 0;

        $this->ledger_name = $obj['vname'] ?? '';
        $this->ledger_id = $obj['id'] ?? '';
    }

    public function refreshLedger($v): void
    {
        $this->ledger_id = $v['id'];
        $this->ledger_name = $v['name'];
        $this->ledgerTyped = false;

    }

    public function ledgerSave($name)
    {
        if ($name) {
            $obj = Common::create([
                'label_id' => '9',
                'vname' => $name,
                'active_id' => '1',
            ]);
            $v = ['name' => $name, 'id' => $obj->id];
            $this->refreshLedger($v);
        }
    }

    public function getLedgerList(): void
    {
        $this->ledgerCollection = $this->ledger_name ? Common::search(trim($this->ledger_name))->where('label_id', '=',
            10)
            ->get() : Common::where('label_id', '=', 10)->Orwhere('id','=','1')->get();
    }

    #endregion

    #region[Product]

    public $product_name = '';
    public $product_id = '';
    public mixed $gst_percent1 = '';
    public Collection $productCollection;
    public $highlightProduct = 0;
    public $productTyped = false;

    public function decrementProduct(): void
    {
        if ($this->highlightProduct === 0) {
            $this->highlightProduct = count($this->productCollection) - 1;
            return;
        }
        $this->highlightProduct--;
    }

    public function incrementProduct(): void
    {
        if ($this->highlightProduct === count($this->productCollection) - 1) {
            $this->highlightProduct = 0;
            return;
        }
        $this->highlightProduct++;
    }

    public function setProduct($name, $id, $percent): void
    {
        $this->product_name = $name;
        $this->product_id = $id;
        $this->gst_percent1 = Sale::commons($percent);
        $this->getProductList();
    }

    public function enterProduct(): void
    {
        $obj = $this->productCollection[$this->highlightProduct] ?? null;
        $this->product_name = '';
        $this->productCollection = Collection::empty();
        $this->highlightProduct = 0;

        $this->product_name = $obj['vname'] ?? '';
        $this->product_id = $obj['id'] ?? '';
        $this->gst_percent1 = Sale::commons($obj['gstpercent_id']) ?? '';
    }

    #[On('refresh-product')]
    public function refreshProduct($v): void
    {
        $this->product_id = $v['id'];
        $this->product_name = $v['name'];
        $this->gst_percent1 = Sale::commons($v['gstpercent_id']);
        $this->productTyped = false;

    }

    public function getProductList(): void
    {
        $this->productCollection = $this->product_name ? Product::search(trim($this->product_name))
            ->where('company_id', '=', session()->get('company_id'))
            ->get() : Product::all()->where('company_id', '=', session()->get('company_id'));
    }

    #endregion

    #region[Colour]
    public $colour_name = '';
    public $colour_id = '';
    public Collection $colourCollection;
    public $highlightColour = 0;
    public $colourTyped = false;

    public function decrementColour(): void
    {
        if ($this->highlightColour === 0) {
            $this->highlightColour = count($this->colourCollection) - 1;
            return;
        }
        $this->highlightColour--;
    }

    public function incrementColour(): void
    {
        if ($this->highlightColour === count($this->colourCollection) - 1) {
            $this->highlightColour = 0;
            return;
        }
        $this->highlightColour++;
    }

    public function enterColour(): void
    {
        $obj = $this->colourCollection[$this->highlightColour] ?? null;

        $this->colour_name = '';
        $this->colourCollection = Collection::empty();
        $this->highlightColour = 0;

        $this->colour_name = $obj['vname'] ?? '';
        $this->colour_id = $obj['id'] ?? '';
    }

    public function setColour($name, $id): void
    {
        $this->colour_name = $name;
        $this->colour_id = $id;
        $this->getColourList();
    }

    #[On('refresh-colour')]
    public function refreshColour($v): void
    {
        $this->colour_id = $v['id'];
        $this->colour_name = $v['name'];
        $this->colourTyped = false;
    }

    public function colourSave($name)
    {
        $obj = Common::create([
            'label_id' => 7,
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshColour($v);
    }

    public function getColourList(): void
    {
        $this->colourCollection = $this->colour_name ? Common::search(trim($this->colour_name))->where('label_id', '=',
            7)
            ->get() : Common::where('label_id', '=', 7)->Orwhere('id','=','1')->get();
    }

    #endregion

    #region[size]
    public $size_name = '';
    public $size_id = '';
    public Collection $sizeCollection;
    public $highlightSize = 0;
    public $sizeTyped = false;

    public function decrementSize(): void
    {
        if ($this->highlightSize === 0) {
            $this->highlightSize = count($this->sizeCollection) - 1;
            return;
        }
        $this->highlightSize--;
    }

    public function incrementSize(): void
    {
        if ($this->highlightSize === count($this->sizeCollection) - 1) {
            $this->highlightSize = 0;
            return;
        }
        $this->highlightSize++;
    }

    public function setSize($name, $id): void
    {
        $this->size_name = $name;
        $this->size_id = $id;
        $this->getSizeList();
    }

    public function enterSize(): void
    {
        $obj = $this->sizeCollection[$this->highlightSize] ?? null;

        $this->size_name = '';
        $this->sizeCollection = Collection::empty();
        $this->highlightSize = 0;

        $this->size_name = $obj['vname'] ?? '';
        $this->size_id = $obj['id'] ?? '';
    }

    #[On('refresh-size')]
    public function refreshSize($v): void
    {
        $this->size_id = $v['id'];
        $this->size_name = $v['name'];
        $this->sizeTyped = false;

    }

    public function sizeSave($name)
    {
        $obj = Common::create([
            'label_id' => '8',
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshSize($v);
    }

    public function getSizeList(): void
    {
        $this->sizeCollection = $this->size_name ? Common::search(trim($this->size_name))->where('label_id', '=', 8)
            ->get() : Common::where('label_id', '=', 8)->Orwhere('id','=','1')->get();
    }

    #endregion

    #region[Save]
    public function saveExit(): void
    {
            if ($this->uniqueno != '') {
                if ($this->common->vid == "") {

                    $this->validate($this->rules());

                    $obj = Sale::create([
                        'uniqueno' => session()->get('company_id').'~'.session()->get('acyear').'~'.Sale::nextNo(),
                        'acyear' => session()->get('acyear'),
                        'company_id' => session()->get('company_id'),
                        'contact_id' => $this->contact_id,
                        'invoice_no' => Sale::nextNo(),
                        'invoice_date' => $this->invoice_date,
                        'order_id' => $this->order_id ?: 1,
                        'billing_id' => $this->billing_id ?: ContactDetail::getId($this->contact_id),
                        'shipping_id' => $this->shipping_id ?: ContactDetail::getId($this->contact_id),
                        'style_id' => $this->style_id ?: 1,
                        'despatch_id' => $this->despatch_id ?: 31,
                        'job_no' => $this->job_no,
                        'sales_type' => $this->sales_type,
                        'transport_id' => $this->transport_id ?: 1,
                        'destination' => $this->destination,
                        'bundle' => $this->bundle,
                        'distance' => $this->distance,
                        'TransMode' => $this->TransMode,
                        'Transid' => $this->Transid,
                        'Transname' => $this->Transname,
                        'Transdocno' => $this->Transdocno,
                        'TransdocDt' => $this->TransdocDt,
                        'Vehno' => $this->Vehno,
                        'Vehtype' => $this->Vehtype,
                        'total_qty' => $this->total_qty,
                        'total_taxable' => $this->total_taxable,
                        'total_gst' => $this->total_gst,
                        'ledger_id' => $this->ledger_id ?: 1,
                        'additional' => $this->additional,
                        'round_off' => $this->round_off,
                        'grand_total' => $this->grand_total,
                        'active_id' => $this->common->active_id,

                    ]);
                    $this->sales_id=$obj->id;
                    $this->saveItem( $this->sales_id);
                    $this->contactUpdate();
                    $message = "Saved";


                } else {
                    $obj = Sale::find($this->common->vid);
                    $obj->uniqueno = session()->get('company_id').'~'.session()->get('acyear').'~'.$this->invoice_no;
                    $obj->acyear = session()->get('acyear');
                    $obj->company_id = session()->get('company_id');
                    if ($obj->contact_id == $this->contact_id) {
                        $obj->billing_id = $this->billing_id;
                        $obj->shipping_id = $this->shipping_id;
                    } else {
                        $obj->billing_id = ContactDetail::getId($this->contact_id);
                        $obj->shipping_id = $this->shipping_id;
                    }
                    $obj->contact_id = $this->contact_id;
                    $obj->invoice_no = $this->invoice_no;
                    $obj->invoice_date = $this->invoice_date;
                    $obj->order_id = $this->order_id;
                    $obj->style_id = $this->style_id;
                    $obj->despatch_id = $this->despatch_id;
                    $obj->job_no = $this->job_no;
                    $obj->sales_type = $this->sales_type;
                    $obj->transport_id = $this->transport_id;
                    $obj->destination = $this->destination;
                    $obj->bundle = $this->bundle;
                    $obj->distance = $this->distance;
                    $obj->TransMode = $this->TransMode;
                    $obj->Transid = $this->Transid;
                    $obj->Transname = $this->Transname;
                    $obj->Transdocno = $this->Transdocno;
                    $obj->TransdocDt = $this->TransdocDt;
                    $obj->Vehno = $this->Vehno;
                    $obj->Vehtype = $this->Vehtype;
                    $obj->total_qty = $this->total_qty;
                    $obj->total_taxable = $this->total_taxable;
                    $obj->total_gst = $this->total_gst;
                    $obj->ledger_id = $this->ledger_id;
                    $obj->additional = $this->additional;
                    $obj->round_off = $this->round_off;
                    $obj->grand_total = $this->grand_total;
                    $obj->active_id = $this->common->active_id;
                    $obj->save();
                    $this->sales_id=$obj->id;
                    DB::table('saleitems')->where('sale_id', '=', $this->sales_id)->delete();
                    $this->saveItem( $this->sales_id);
                    $this->contactUpdate();
                    $message = "Updated";
                }

                $this->dispatch('notify', ...['type' => 'success', 'content' => $message.' Successfully']);

            }

    }
    public function save()
    {
        $this->saveExit();
        $this->getRoute();
    }

    public function saveItem($id): void
    {
        foreach ($this->itemList as $sub) {
            Saleitem::create([
                'sale_id' => $id,
                'po_no' => $sub['po_no'],
                'dc_no' => $sub['dc_no'],
                'no_of_roll' => $sub['no_of_roll'],
                'product_id' => $sub['product_id'],
                'colour_id' => $sub['colour_id'] ?: '11',
                'size_id' => $sub['size_id'] ?: '14',
                'qty' => $sub['qty'],
                'price' => $sub['price'],
                'gst_percent' => $sub['gst_percent'],
                'description' => $sub['description'],
            ]);
        }
    }

    public function contactUpdate()
    {
        $obj=Contact::find($this->contact_id);
        $outstanding= $obj->contact_type_id==124?$obj->outstanding+$this->grand_total:$obj->outstanding-$this->grand_total;
        $obj->outstanding=$outstanding;
        $obj->save();
    }
    #endregion

    #region[api]
    #region[apiAuthenticate]
    public function apiAuthenticate()
    {
        $apiToken = MasterGstToken::orderByDesc('id')->first();
        if ($apiToken) {
            if (\Illuminate\Support\Carbon::now()->format('Y-m-d H:i:s') < $apiToken->expires_at) {
                $this->token = $apiToken->token;
            } else {
                $this->masterGstApi->authenticate();
                $obj = MasterGstToken::orderByDesc('id')->first();
                $this->token = $obj->token;
            }
        } else {
            $this->masterGstApi->authenticate();
            $obj = MasterGstToken::orderByDesc('id')->first();
            $this->token = $obj->token;
        }
    }
    #endregion
    #endregion

    #region[mount]
    public function mount($id): void
    {
        $this->apiAuthenticate();
        if ($id != 0) {
            $obj = Sale::find($id);
            $this->common->vid = $obj->id;
            $this->uniqueno = $obj->uniqueno;
            $this->acyear = $obj->acyear;
            $this->contact_id = $obj->contact_id;
            $this->contact_name = $obj->contact->vname;
            $this->invoice_no = $obj->invoice_no;
            $this->invoice_date = $obj->invoice_date;
            $this->order_id = $obj->order_id;
            $this->order_name = $obj->order->vname;
            $this->billing_id = $obj->billing_id;
            $this->billing_address = ContactDetail::printDetails($obj->billing_id)->get('address_1');
            $this->shipping_id = $obj->shipping_id;
            $this->shipping_address = ContactDetail::printDetails($obj->shipping_id)->get('address_1');
            $this->style_id = $obj->style_id;
            $this->style_name = $obj->style->vname;
            $this->despatch_id = $obj->despatch_id;
            $this->despatch_name = $obj->despatch_id ? Common::find($obj->despatch_id)->vname : '';
            $this->job_no = $obj->job_no;
            $this->sales_type = $obj->sales_type;
            $this->transport_id = $obj->transport_id;
            $this->transport_name = $obj->transport_id ? Common::find($obj->transport_id)->vname : '';
            $this->destination = $obj->destination;
            $this->bundle = $obj->bundle;
            $this->distance = $obj->distance;
            $this->TransMode = $obj->TransMode;
            $this->Transid = $obj->Transid;
            $this->Transname = $obj->Transname;
            $this->Transdocno = $obj->Transdocno;
            $this->TransdocDt = $obj->TransdocDt;
            $this->Vehno = $obj->Vehno;
            $this->Vehtype = $obj->Vehtype;
            $this->total_qty = $obj->total_qty;
            $this->total_taxable = $obj->total_taxable;
            $this->total_gst = $obj->total_gst;
            $this->ledger_id = $obj->ledger_id;
            $this->ledger_name = $obj->ledger_id ? Common::find($obj->ledger_id)->vname : '';
            $this->additional = $obj->additional;
            $this->round_off = $obj->round_off;
            $this->grand_total = $obj->grand_total;
            $this->common->active_id = $obj->active_id;

            $data = DB::table('saleitems')->select('saleitems.*',
                'products.vname as product_name',
                'colours.vname as colour_name',
                'sizes.vname as size_name',)->join('products', 'products.id', '=', 'saleitems.product_id')
                ->join('commons as colours', 'colours.id', '=', 'saleitems.colour_id')
                ->join('commons as sizes', 'sizes.id', '=', 'saleitems.size_id')->where('sale_id', '=',
                    $id)->get()->transform(function ($data) {
                    return [
                        'saleitem_id' => $data->id,
                        'po_no' => $data->po_no,
                        'dc_no' => $data->dc_no,
                        'no_of_roll' => $data->no_of_roll,
                        'product_name' => $data->product_name,
                        'product_id' => $data->product_id,
                        'colour_name' => $data->colour_name,
                        'colour_id' => $data->colour_id,
                        'size_name' => $data->size_name,
                        'size_id' => $data->size_id,
                        'qty' => $data->qty,
                        'price' => $data->price,
                        'description' => $data->description,
                        'gst_percent' => $data->gst_percent,
                        'taxable' => $data->qty * $data->price,
                        'gst_amount' => ($data->qty * $data->price) * ($data->gst_percent) / 100,
                        'subtotal' => $data->qty * $data->price + (($data->qty * $data->price) * $data->gst_percent / 100),
                    ];
                });
            $this->itemList = $data;
            $this->e_invoiceDetails=MasterGstIrn::where('sales_id',$this->common->vid)->first();
            $this->e_wayDetails=MasterGstEway::where('sales_id',$this->common->vid)->first();

            $contact_outstanding=Contact::find($this->contact_id);
            $contact_outstanding->outstanding=($contact_outstanding->contact_type_id==124?$contact_outstanding->outstanding-$this->grand_total:$contact_outstanding->outstanding+$this->grand_total);
            $contact_outstanding->save();

        } else {

            $this->invoice_no= Sale::nextNo();
            $this->uniqueno = session()->get('company_id').'~'.session()->get('acyear').'~'.$this->invoice_no;
            $this->common->active_id = true;
            $this->sales_type = '1';
            $this->gst_percent = 5;
            $this->additional = 0;
            $this->grand_total = 0;
            $this->total_taxable = 0;
            $this->round_off = 0;
            $this->total_gst = 0;
            $this->invoice_date = Carbon::now()->format('Y-m-d');
            $this->TransMode=1;
            $this->Vehtype='R';
            $this->TransdocDt=Carbon::now()->format('Y-m-d');
        }

        $this->calculateTotal();
    }

    #endregion

    #region[add items]

    public function addItems(): void
    {
        if ($this->itemIndex == "") {
            if (!(empty($this->product_name)) &&
                !(empty($this->price)) &&
                !(empty($this->qty))
            ) {
                $this->itemList[] = [
                    'po_no' => $this->po_no,
                    'dc_no' => $this->dc_no,
                    'no_of_roll' => $this->no_of_roll,
                    'product_name' => $this->product_name,
                    'product_id' => $this->product_id,
                    'colour_id' => $this->colour_id,
                    'colour_name' => $this->colour_name,
                    'size_id' => $this->size_id,
                    'size_name' => $this->size_name,
                    'qty' => $this->qty,
                    'price' => $this->price,
                    'gst_percent' => $this->gst_percent1,
                    'description' => $this->description,
                    'taxable' => $this->qty * $this->price,
                    'gst_amount' => ($this->qty * $this->price) * $this->gst_percent1 / 100,
                    'subtotal' => $this->qty * $this->price + (($this->qty * $this->price) * $this->gst_percent1 / 100),
                ];
            }
        } else {
            $this->itemList[$this->itemIndex] = [
                'po_no' => $this->po_no,
                'dc_no' => $this->dc_no,
                'no_of_roll' => $this->no_of_roll,
                'product_name' => $this->product_name,
                'product_id' => $this->product_id,
                'colour_id' => $this->colour_id,
                'colour_name' => $this->colour_name,
                'size_id' => $this->size_id,
                'size_name' => $this->size_name,
                'qty' => $this->qty,
                'price' => $this->price,
                'gst_percent' => $this->gst_percent1,
                'description' => $this->description,
                'taxable' => $this->qty * $this->price,
                'gst_amount' => ($this->qty * $this->price) * $this->gst_percent1 / 100,
                'subtotal' => $this->qty * $this->price + (($this->qty * $this->price) * $this->gst_percent1 / 100),
            ];
        }

        $this->calculateTotal();
        $this->resetsItems();
        $this->render();
    }

    public function resetsItems(): void
    {
        $this->itemIndex = '';
        $this->po_no = '';
        $this->dc_no = '';
        $this->no_of_roll = '';
        $this->product_name = '';
        $this->product_id = '';
        $this->colour_name = '';
        $this->colour_id = '';
        $this->size_name = '';
        $this->size_id = '';
        $this->qty = '';
        $this->price = '';
        $this->description = '';
        $this->gst_percent = '';
        $this->calculateTotal();
    }

    public function changeItems($index): void
    {
        $this->itemIndex = $index;

        $items = $this->itemList[$index];
        $this->po_no = $items['po_no'];
        $this->dc_no = $items['dc_no'];
        $this->no_of_roll = $items['no_of_roll'];
        $this->product_name = $items['product_name'];
        $this->product_id = $items['product_id'];
        $this->colour_name = $items['colour_name'];
        $this->colour_id = $items['colour_id'];
        $this->size_name = $items['size_name'];
        $this->size_id = $items['size_id'];
        $this->qty = $items['qty'] + 0;
        $this->price = $items['price'] + 0;
        $this->gst_percent1 = $items['gst_percent'];
        $this->description = $items['description'];
        $this->calculateTotal();
    }

    public function removeItems($index): void
    {
        unset($this->itemList[$index]);
        $this->itemList = collect($this->itemList);
        $this->calculateTotal();
    }

    #endregion

    #region[Calculate total]

    public function calculateTotal(): void
    {
        if ($this->itemList) {

            $this->total_qty = 0;
            $this->total_taxable = 0;
            $this->total_gst = 0;
            $this->grandtotalBeforeRound = 0;

            foreach ($this->itemList as $row) {
                $this->total_qty += round(floatval($row['qty']), 3);
                $this->total_taxable += round(floatval($row['taxable']), 2);
                $this->total_gst += round(floatval($row['gst_amount']), 2);
                $this->grandtotalBeforeRound += round(floatval($row['subtotal']), 2);
            }
            $this->grand_total = round($this->grandtotalBeforeRound);
            $this->round_off = $this->grandtotalBeforeRound - $this->grand_total;

            if ($this->grandtotalBeforeRound > $this->grand_total) {
                $this->round_off = round($this->round_off, 2) * -1;
            }

            $this->qty = round(floatval($this->qty), 3);
            $this->total_taxable = round(floatval($this->total_taxable), 2);
            $this->total_gst = round(floatval($this->total_gst), 2);
            $this->round_off = round(floatval($this->round_off), 2);
            $this->grand_total = round((floatval($this->grand_total)) + (floatval($this->additional)), 2);
        }
    }

    #endregion

    #region[Render]

//    public function print()
//    {
//        $this->redirect(route('sales.invoice', [$this->common->vid]));
//    }

    public function getRoute(): void
    {
        $this->contactUpdate();
        $this->redirect(route('sales'));
    }

    public function render()
    {
        $this->getContactList();
        $this->getOrderList();
        $this->getTransportList();
        $this->getLedgerList();
        $this->getColourList();
        $this->getProductList();
        $this->getSizeList();
        $this->getBilling_address();
        $this->getShipping_address();
        $this->getStyleList();
        $this->getDespatchList();
        return view('livewire.entries.sales.upsert');
    }
    #endregion
}
