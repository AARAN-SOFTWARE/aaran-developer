<?php

namespace App\Livewire\Web\Slide;

use Aaran\Web\Models\HomeSlide;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use CommonTraitNew;
    use WithFileUploads;

    #region[properties]
    public $description;
    public $link;
    public $bg_image;
    public $cont_image;
    public $old_bg_image;
    public $old_cont_image;
    #endregion

    #region[Get-Save]
    public function getSave(): void
    {
        $this->validate(['common.vname' => 'required|min:3|max:150']);
        $this->validate(['description' => 'min:3|max:255']);
        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $Slides = new HomeSlide();
                $extraFields = [
                    'description' => $this->description,
                    'link' => $this->link,
                    'bg_image' => $this->saveBg_Image(),
                    'cont_image' => $this->saveImage(),
                    'user_id' => auth()->id(),
                ];
                $this->common->save($Slides, $extraFields);
                $message = "Saved";
            } else {
                $Slides = HomeSlide::find($this->common->vid);
                $extraFields = [
                    'description' => $this->description,
                    'link' => $this->link,
                    'bg_image' => $this->saveBg_Image(),
                    'cont_image' => $this->saveImage(),
                    'user_id' => auth()->id(),
                ];
                $this->common->edit($Slides, $extraFields);
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
    }
    #endregion

    #region[Get-Obj]
    public function getObj($id)
    {
        if ($id) {
            $HomeSlides = HomeSlide::find($id);
            $this->common->vid = $HomeSlides->id;
            $this->common->vname = $HomeSlides->vname;
            $this->common->active_id = $HomeSlides->active_id;
            $this->description = $HomeSlides->description;
            $this->link = $HomeSlides->link;
            $this->old_bg_image = $HomeSlides->bg_image;
            $this->old_cont_image = $HomeSlides->cont_image;
            return $HomeSlides;
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
        $this->description = '';
        $this->link = '';
        $this->bg_image = '';
        $this->old_bg_image = '';
        $this->cont_image = '';
        $this->old_cont_image = '';
    }
    #endregion

    #region[BgImage]
    public function saveBg_Image()
    {
        if ($this->bg_image) {
            $image = $this->bg_image;
            $filname = $this->bg_image->getClientOriginalName();

            if (Storage::disk('public')->exists(Storage::path('public/images' . $this->old_bg_image))) {
                Storage::disk('public')->delete(Storage::path('public/images' . $this->old_bg_image));
            }

            $image->StoreAs('images', $filname,'public');

            return $filname;

        } else {
            if ($this->old_bg_image) {
                return $this->old_bg_image;
            } else {
                return 'no_image';
            }
        }
    }
    #endregion

    #region[ContImage]
    public function saveImage()
    {
        if ($this->cont_image) {
            $image = $this->cont_image;
            $filname = $this->cont_image->getClientOriginalName();

            if (Storage::disk('public')->exists(Storage::path('public/images' . $this->old_cont_image))) {
                Storage::disk('public')->delete(Storage::path('public/images' . $this->old_cont_image));
            }
            $image->StoreAs('images', $filname,'public');

            return $filname;

        } else {
            if ($this->old_cont_image) {
                return $this->old_cont_image;
            } else {
                return 'no_image';
            }
        }
    }
    #endregion

    #region[Render]
    public function getRoute()
    {
        return route('products');
    }

    public function render()
    {
        return view('livewire.web.slide.index')->with([
            'list' => $this->getListForm->getList(HomeSlide::class, function ($query) {
                return $query->where('id', '>', '');
            }),
        ]);
    }
    #endregion
}
