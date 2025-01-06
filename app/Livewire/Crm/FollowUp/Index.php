<?php

namespace App\Livewire\Crm\FollowUp;

use Aaran\Common\Models\Common;
use Aaran\Crm\Models\Enquiry;
use Aaran\Crm\Models\FollowUp;
use Aaran\Crm\Models\Lead;
use Livewire\Component;
use App\Livewire\Trait\CommonTraitNew;

//use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;


class Index extends Component
{
    use CommonTraitNew;

    public string $body = '';
    public $lead_id;
    public $feature;
    public $team_members;
    public $status;
    public $verified_by;


    public $lead_data;
    public $id_for_lead;

    public $start_date;
    public $end_date;



    public function mount($id)
    {
        $this->id_for_lead = $id;
        $this->lead_data = Lead::find($this->id_for_lead);

    }

    #region[Rules]
    public function rules(): array
    {
        return [
            'common.vname' => 'required',
            'body' => 'required|min:5',
        ];
    }
    #endregion

    #region[Messages]
    public function messages()
    {
        return [
            'common.vname.required' => ' :attribute is required.',
            'body.required' => ' :attribute is required.',
        ];
    }
    #endregion


    #region[getSave]
    public function getSave(): void
    {
        $this->validate($this->rules());

//        // Check if the referenced lead exists
//         if (!Lead::find($this->id_for_lead))
//         {
//             $this->dispatch('notify', ['type' => 'error', 'content' => 'Referenced lead does not exist.']); return;
//         }

        if ($this->common->vname != '') {

            if ($this->common->vid == '') {

                $obj = new FollowUp();

                $extraFields = [
                    'id_for_lead' => $this->id_for_lead,
                    'lead_id' => $this->lead_id,
                    'feature' => $this->feature,
                    'team_members' => $this->team_members,
                    'status' => $this->status,
                    'body' => $this->body,  //report
                    'start_date' => $this->start_date ?: null,
                    'end_date' => $this->end_date ?: null,
                    'verified_by' => $this->verified_by,
                    'active_id' => 1

                ];

                $this->common->save($obj, $extraFields);
                $this->clearFields();
                $message = "Saved";

            } else {

                $obj = FollowUp::find($this->common->vid);

                $extraFields = [
                    'id_for_lead' => $this->id_for_lead,
                    'lead_id' => $this->lead_id,
                    'feature' => $this->feature,
                    'team_members' => $this->team_members,
                    'status' => $this->status,
                    'body' => $this->body,
                    'start_date' => $this->start_date ?: null,
                    'end_date' => $this->end_date ?: null,
                    'verified_by' => $this->verified_by,


                ];
                $this->common->edit($obj, $extraFields);
                $this->clearFields();
                $message = "Updated";
            }
            $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
        }
//        $this-> redirect(route('enquiries'));
    }
    #endregion

    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $Common = FollowUp::find($id);
            $this->common->vid = $Common->id;
            $this->common->vname = $Common->vname;
            $this->id_for_lead = $Common->lead_id;
            $this->lead_id = $Common->lead_id;
            $this->feature = $Common->feature;
            $this->team_members = $Common->team_members;
            $this->status = $Common->status;
            $this->body = $Common->body;
            $this->start_date = $Common->start_date;
            $this->end_date = $Common->end_date;
            $this->verified_by = $Common->verified_by;
            return $Common;
        }
        return null;
    }
    #endregion

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->lead_id = '';
        $this->feature = '';
        $this->team_members = '';
        $this->body = '';
        $this->status = '';
        $this->start_date = '';
        $this->end_date = '';
    }
    #endregion


    public function render()
    {
        return view('livewire.crm.follow-up.index')
//            ->with([
//            'followups' => $this->getListForm->getList(FollowUp::class, function ($query) {
//                return $query->orderBy('id', 'asc');
//            }),
//        ]);
        ->with([
           'followups' => FollowUp::where('id_for_lead', $this->id_for_lead)->get(),
                ]);
    }


}
