<?php

namespace App\Livewire\Web\Forms\Home;

use Aaran\Web\Models\Home;
use Aaran\Web\Models\HomeImage;
use App\Livewire\Trait\CommonTraitNew;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use CommonTraitNew;
    use WithFileUploads;

    public $desc;
    public $cover_title;
    public $cover_desc;
    public $test_title;
    public $test_desc;
    public $serve_title;
    public $feats_title;
    public $feats_desc;

    public mixed $image;
    public $isUploaded = false;
    public array $photos = [];


    #region[Get-Save]
    public function getSave(): void
    {
        if ($this->common->vname != '') {
            if ($this->common->vid == '') {
                $Home = new Home();
                $extraFields = [
                    'desc' => $this->desc,
                    'cover_title' => $this->cover_title,
                    'cover_desc' => $this->cover_desc,
                    'test_title' => $this->test_title,
                    'test_desc' => $this->test_desc,
                    'serve_title' => $this->serve_title,
                    'feats_title' => $this->feats_title,
                    'feats_desc' => $this->feats_desc,
                ];
                $this->common->save($Home, $extraFields);
                $message = "Saved";
            } else {
                $Home = Home::find($this->common->vid);
                $extraFields = [
                    'desc' => $this->desc,
                    'cover_title' => $this->cover_title,
                    'cover_desc' => $this->cover_desc,
                    'test_title' => $this->test_title,
                    'test_desc' => $this->test_desc,
                    'serve_title' => $this->serve_title,
                    'feats_title' => $this->feats_title,
                    'feats_desc' => $this->feats_desc,
                ];
                $this->common->edit($Home, $extraFields);
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
            $Home = Home::find($id);
            $this->common->vid = $Home->id;
            $this->common->vname = $Home->vname;
            $this->common->active_id = $Home->active_id;
            $this->desc = $Home->desc;
            $this->cover_title = $Home->cover_title;
            $this->cover_desc = $Home->cover_desc;
            $this->test_title = $Home->test_title;
            $this->test_desc = $Home->test_desc;
            $this->serve_title = $Home->serve_title;
            $this->feats_title = $Home->feats_title;
            $this->feats_desc = $Home->feats_desc;
            return $Home;
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
        $this->desc = '';
        $this->cover_title = '';
        $this->cover_desc = '';
        $this->test_title = '';
        $this->test_desc = '';
        $this->serve_title = '';
        $this->feats_title = '';
        $this->feats_desc = '';
    }
    #endregion

    public function save_item($id, $images)
    {
        foreach ($images as $image) {
            HomeImage::create([
                'home_id' => $id,
                'vname' => $image->vname,
                'desc' => $image->desc,
                'image' => $this->save_image($image),
            ]);
        }
    }

    public function save_image($image)
    {
        if ($image == '') {
            return $image = 'empty';
        } else {
            $image_name = $image->getClientOriginalName();
            return $image->storeAs('photos', $image_name, 'public');
        }
    }
    #endregion
    public function render()
    {
        return view('livewire.web.forms.home.index')->layout('layouts.web');
    }
}
