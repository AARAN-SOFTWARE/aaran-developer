<?php

namespace App\Livewire\SoftVersion;

use App\Livewire\Trait\CommonTraitNew;
use App\Models\SoftVersion;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{

    use CommonTraitNew;

    use WithFileUploads;

    #region[Properties]
    public $version;
    public $title;
    public $body;

    public $image;
    public $old_image;
    #endregion

    #region[Save]
    public function getSave()
    {
        if ($this->version != '') {
            if ($this->common->vid == "") {
                $obj = SoftVersion::create([
                    'version' => $this->version,
                    'title' => $this->title,
                    'body' => $this->body,
                    'image' => $this->saveImage()
                ]);
                $this->clearFields();
            } else {
                $obj = SoftVersion::find($this->common->vid);
                $obj->version = $this->version;
                $obj->title = $this->title;
                $obj->body = $this->body;
                $obj->image = $this->saveImage();
                $obj->save();
                $this->clearFields();
            }
        }
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $SoftVersion = SoftVersion::find($id);
            $this->common->vid = $SoftVersion->id;
            $this->version = $SoftVersion->version;
            $this->title = $SoftVersion->title;
            $this->body = $SoftVersion->body;
            $this->old_image = $SoftVersion->image;
            return $SoftVersion;
        }
        return null;
    }

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->image = '';
        $this->common->vid = '';
        $this->version = '';
        $this->title = '';
        $this->body = '';
        $this->old_image = '';
    }
    #endregion

    #region[Image]
    public function saveImage()
    {
        if ($this->image) {

            $image = $this->image;
            $filename = $this->image->getClientOriginalName();

            if (Storage::disk('public')->exists(Storage::path('public/images/' . $this->old_image))) {
                Storage::disk('public')->delete(Storage::path('public/images/' . $this->old_image));
            }

            $image->storeAs('images', $filename, 'public');

            return $filename;

        } else {
            if ($this->old_image) {
                return $this->old_image;
            } else {
                return 'no image';
            }
        }
    }

    #endregion


    public function render()
    {
        return view('livewire.soft-version.index')->with([
            'list' => SoftVersion::OrderBy('id', 'desc')->get(),
        ]);
    }
}
