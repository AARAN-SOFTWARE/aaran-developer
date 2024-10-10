<?php

namespace App\Livewire\Master\Style;

use Aaran\Master\Models\Style;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use CommonTraitNew;
    use WithFileUploads;

    #region[properties]
    public $desc;
    public $image;
    public $old_image;
    #endregion

    #region[getSave]
    public function getSave(): void
    {
        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $style = new Style();
                $extraFields = [
                    'desc' => $this->desc,
                    'company_id' => session()->get('company_id'),
                    'image' => $this->save_image(),
                ];
                $this->common->save($style, $extraFields);
                $message = "Saved";
            } else {
                $style = Style::find($this->common->vid);
                $extraFields = [
                    'desc' => $this->desc,
                    'company_id' => session()->get('company_id'),
                    'image' => $this->save_image(),
                ];
                $this->common->edit($style, $extraFields);
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message.' Successfully']);
        }
    }
    #endregion

    #region[image]
    public function save_image()
    {
        if ($this->image) {

            $image = $this->image;
            $filename = $this->image->getClientOriginalName();

            if (Storage::disk('public')->exists(Storage::path('public/images/' . $this->old_image))) {
                Storage::disk('public')->delete(Storage::path('public/images/' . $this->old_image));
            }

            $image->storeAs('public/images', $filename);

            return $filename;

        } else {
            if ($this->old_image) {
                return $this->old_image;
            } else {
                return 'no_image';
            }
        }
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $style = Style::find($id);
            $this->common->vid = $style->id;
            $this->common->vname = $style->vname;
            $this->common->active_id = $style->active_id;
            $this->desc = $style->desc;
            $this->old_image = $style->image;
            return $style;
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
        $this->desc = '';
        $this->image='';
        $this->old_image='';
    }
    #endregion

    #region[getRoute]
    public function getRoute()
    {
        return route('styles');
    }
    #endregion

    #region[render]
    public function render()
    {
        return view('livewire.master.style.index')->with([
            'list' => $this->getListForm->getList(Style::class,function ($query){
                return $query->where('company_id',session()->get('company_id'));
            }),
        ]);
    }
    #endregion
}
