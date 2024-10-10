<?php

namespace App\Livewire\Master\Product;

use Aaran\Common\Models\Common;
use Aaran\Master\Models\Product;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    use CommonTraitNew;

    #region[Properties]
    public $quantity;
    public $price;

    #endregion

    public function rules(): array
    {
        return [
            'common.vname' => 'required|unique:products,vname',
            'hsncode_name' => 'required',
            'unit_name' => 'required',
            'gstpercent_name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'common.vname.required' => ' :attribute are missing.',
            'common.vname.unique' => ' :attribute is already created.',
            'hsncode_name.required' => ' :attribute is required.',
            'unit_name.required' => ' :attribute is required.',
            'gstpercent_name.required' => ' :attribute is required.',
        ];
    }

    public function validationAttributes()
    {
        return [
            'common.vname' => 'Name',
            'hsncode_name' => 'Hsncode',
            'unit_name' => 'Unit',
            'gstpercent_name' => 'Gst percent',
        ];
    }

    #region[Get-Save]
    public function getSave(): void
    {
        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $this->validate($this->rules());
                $this->common->vname = preg_replace('/[^A-Za-z0-9\-]/', '', $this->common->vname);
                $Product = new Product();
                $extraFields = [
                    'producttype_id' => $this->producttype_id ?: '92',
                    'hsncode_id' => $this->hsncode_id ?: '62',
                    'unit_id' => $this->unit_id ?: '97',
                    'gstpercent_id' => $this->gstpercent_id ?: '99',
                    'initial_quantity' => $this->quantity ?: '0',
                    'initial_price' => $this->price ?: '0',
                    'user_id' => auth()->id(),
                    'company_id' => session()->get('company_id'),
                ];
                $this->common->save($Product, $extraFields);
                $message = "Saved";
            } else {
                $Product = Product::find($this->common->vid);
                $extraFields = [
                    'producttype_id' => $this->producttype_id,
                    'hsncode_id' => $this->hsncode_id,
                    'unit_id' => $this->unit_id,
                    'gstpercent_id' => $this->gstpercent_id,
                    'initial_quantity' => $this->quantity,
                    'initial_price' => $this->price,
                    'user_id' => auth()->id(),
                    'company_id' => session()->get('company_id'),
                ];
                $this->common->edit($Product, $extraFields);
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
    }
    #endregion

    #region[hsncode]
    #[validate]
    public $hsncode_name = '';
    public $hsncode_id = '';
    public Collection $hsncodeCollection;
    public $highlightHsncode = 0;
    public $hsncodeTyped = false;

    public function decrementHsncode(): void
    {
        if ($this->highlightHsncode === 0) {
            $this->highlightHsncode = count($this->hsncodeCollection) - 1;
            return;
        }
        $this->highlightHsncode--;
    }

    public function incrementHsncode(): void
    {
        if ($this->highlightHsncode === count($this->hsncodeCollection) - 1) {
            $this->highlightHsncode = 0;
            return;
        }
        $this->highlightHsncode++;
    }

    public function setHsncode($name, $id): void
    {
        $this->hsncode_name = $name;
        $this->hsncode_id = $id;
        $this->getHsncodeList();
    }

    public function enterHsncode(): void
    {
        $obj = $this->hsncodeCollection[$this->highlightHsncode] ?? null;

        $this->hsncode_name = '';
        $this->hsncodeCollection = Collection::empty();
        $this->highlightHsncode = 0;

        $this->hsncode_name = $obj['vname'] ?? '';
        $this->hsncode_id = $obj['id'] ?? '';
    }

    public function refreshHsncode($v): void
    {
        $this->hsncode_id = $v['id'];
        $this->hsncode_name = $v['name'];
        $this->hsncodeTyped = false;
    }

    public function hsncodeSave($name)
    {
        $obj = Common::create([
            'label_id' => 6,
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshHsncode($v);
    }

    public function getHsncodeList(): void
    {
        $this->hsncodeCollection = $this->hsncode_name ?
            Common::search(trim($this->hsncode_name))->where('label_id', '=', '6')->get() :
            Common::where('label_id', '=', '6')->get();
    }
#endregion

    #region[producttype]
    public $producttype_id = '';
    public $producttype_name = '';
    public Collection $producttypeCollection;
    public $highlightProductType = 0;
    public $producttypeTyped = false;

    public function decrementProductType(): void
    {
        if ($this->highlightProductType === 0) {
            $this->highlightProductType = count($this->producttypeCollection) - 1;
            return;
        }
        $this->highlightProductType--;
    }

    public function incrementProductType(): void
    {
        if ($this->highlightProductType === count($this->producttypeCollection) - 1) {
            $this->highlightProductType = 0;
            return;
        }
        $this->highlightProductType++;
    }

    public function setProductType($name, $id): void
    {
        $this->producttype_name = $name;
        $this->producttype_id = $id;
        $this->getProductTypeList();
    }

    public function enterProductType(): void
    {
        $obj = $this->producttypeCollection[$this->highlightProductType] ?? null;

        $this->producttype_name = '';
        $this->producttypeCollection = Collection::empty();
        $this->highlightProductType = 0;

        $this->producttype_name = $obj['vname'] ?? '';
        $this->producttype_id = $obj['id'] ?? '';
    }

    public function refreshProductType($v): void
    {
        $this->producttype_id = $v['id'];
        $this->producttype_name = $v['name'];
        $this->producttypeTyped = false;
    }

    public function productTypeSave($name)
    {
        $obj = Common::create([
            'label_id' => '15',
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshProductType($v);
    }

    public function getProductTypeList(): void
    {
        $this->producttypeCollection = $this->producttype_name ?
            Common::search(trim($this->producttype_name))->where('label_id', '=', '15')->get() :
            Common::where('label_id', '=', '15')->get();
    }
#endregion

    #region[unit]
    #[validate]
    public $unit_name = '';
    public $unit_id = '';
    public Collection $unitCollection;
    public $highlightUnit = 0;
    public $unitTyped = false;

    public function decrementUnit(): void
    {
        if ($this->highlightUnit === 0) {
            $this->highlightUnit = count($this->unitCollection) - 1;
            return;
        }
        $this->highlightUnit--;
    }

    public function incrementUnit(): void
    {
        if ($this->highlightUnit === count($this->unitCollection) - 1) {
            $this->highlightUnit = 0;
            return;
        }
        $this->highlightUnit++;
    }

    public function setUnit($name, $id): void
    {
        $this->unit_name = $name;
        $this->unit_id = $id;
        $this->getUnitList();
    }

    public function enterUnit(): void
    {
        $obj = $this->unitCollection[$this->highlightUnit] ?? null;

        $this->unit_name = '';
        $this->unitCollection = Collection::empty();
        $this->highlightUnit = 0;

        $this->unit_name = $obj['vname'] ?? '';
        $this->unit_id = $obj['id'] ?? '';
    }

    public function refreshUnit($v): void
    {
        $this->unit_id = $v['id'];
        $this->unit_name = $v['name'];
        $this->unitTyped = false;
    }

    public function unitSave($name)
    {
        $obj = Common::create([
            'label_id' => '16',
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshUnit($v);
    }

    public function getUnitList(): void
    {
        $this->unitCollection = $this->unit_name ?
            Common::search(trim($this->unit_name))->where('label_id', '=', '16')->get() :
            Common::where('label_id', '=', '16')->get();
    }
#endregion

    #region[gstpercent]
    #[validate]
    public $gstpercent_name = '';
    public $gstpercent_id = '';
    public Collection $gstpercentCollection;
    public $highlightGstPercent = 0;
    public $gstpercentTyped = false;

    public function decrementGstPercent(): void
    {
        if ($this->highlightGstPercent === 0) {
            $this->highlightGstPercent = count($this->gstpercentCollection) - 1;
            return;
        }
        $this->highlightGstPercent--;
    }

    public function incrementGstPercent(): void
    {
        if ($this->highlightGstPercent === count($this->gstpercentCollection) - 1) {
            $this->highlightGstPercent = 0;
            return;
        }
        $this->highlightGstPercent++;
    }

    public function setGstPercent($name, $id): void
    {
        $this->gstpercent_name = $name;
        $this->gstpercent_id = $id;
        $this->getGstPercentList();
    }

    public function enterGstPercent(): void
    {
        $obj = $this->gstpercentCollection[$this->highlightGstPercent] ?? null;

        $this->gstpercent_name = '';
        $this->gstpercentCollection = Collection::empty();
        $this->highlightGstPercent = 0;

        $this->gstpercent_name = $obj['vname'] ?? '';
        $this->gstpercent_id = $obj['id'] ?? '';
    }

    public function refreshGstPercent($v): void
    {
        $this->gstpercent_id = $v['id'];
        $this->gstpercent_name = $v['name'];
        $this->gstpercentTyped = false;
    }

    public function gstPercentSave($name)
    {
        $obj = Common::create([
            'label_id' => '17',
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshGstPercent($v);
    }

    public function getGstPercentList(): void
    {
        $this->gstpercentCollection = $this->gstpercent_name ?
            Common::search(trim($this->gstpercent_name))->where('label_id', '=', '17')->get() :
            Common::where('label_id', '=', '17')->get();
    }
#endregion

    #region[Get-Obj]
    public function getObj($id)
    {
        if ($id) {
            $Product = Product::find($id);
            $this->common->vid = $Product->id;
            $this->common->vname = $Product->vname;
            $this->common->active_id = $Product->active_id;
            $this->hsncode_id = $Product->hsncode_id;
            $this->hsncode_name = $Product->hsncode_id ? Common::find($Product->hsncode_id)->vname : '';
            $this->producttype_id = $Product->producttype_id;
            $this->producttype_name = $Product->producttype_id ? Common::find($Product->producttype_id)->vname : '';
            $this->unit_id = $Product->unit_id;
            $this->unit_name = $Product->unit_id ? Common::find($Product->unit_id)->vname : '';
            $this->gstpercent_id = $Product->gstpercent_id;
            $this->gstpercent_name = $Product->gstpercent_id ? Common::find($Product->gstpercent_id)->vname : '';
            $this->quantity = $Product->initial_quantity;
            $this->price = $Product->initial_price;
            return $Product;
        }
        return null;
    }
    #endregion

    #region[Clear-Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->common->active_id = '1';
        $this->hsncode_id = '';
        $this->hsncode_name = '';
        $this->gstpercent_name = '';
        $this->gstpercent_id = '';
        $this->unit_name = '';
        $this->unit_id = '';
        $this->producttype_id = '';
        $this->producttype_name = '';
        $this->quantity = '';
        $this->price = '';
    }
    #endregion

    #region[Render]
    public function getRoute()
    {
        return route('products');
    }

    public function getList()
    {
        return Product::select(
            'products.*',
            'producttype.vname as producttype_name',
            'unit.vname as unit_name',
            'hsncode.vname as hsncode_name',
            'gstpercent.vname as gstpercent_name',
        )
            ->where('products.company_id', session()->get('company_id'))
            ->where('products.active_id', $this->getListForm->activeRecord)
            ->join('commons as producttype', 'producttype.id', '=', 'products.producttype_id')
            ->join('commons as unit', 'unit.id', '=', 'products.unit_id')
            ->join('commons as hsncode', 'hsncode.id', '=', 'products.hsncode_id')
            ->join('commons as gstpercent', 'gstpercent.id', '=', 'products.gstpercent_id')
            ->orderBy('products.id', $this->getListForm->sortAsc ? 'asc' : 'desc')
            ->paginate($this->getListForm->perPage);
    }

    public function render()
    {
        $this->getHsncodeList();
        $this->getProductTypeList();
        $this->getUnitList();
        $this->getGstPercentList();

        return view('livewire.master.product.index')->with([
            'list' => $this->getList()
        ]);
    }
    #endregion
}
