<div>
    <x-slot name="header">Project Activity</x-slot>
    <x-forms.top-controls :show-filters="$showFilters"/>
    <div class="flex w-full">

        <x-table.caption :caption="'Project'">
            {{$list->count()}}
        </x-table.caption>
    </div>

        <!-- Card Body  ------------------------------------------------------------------------------------------>
        <div class="flex flex-col sm:grid grid-cols-4 w-full gap-10 mt-3">

            @foreach($list as $index=>$row)

                <article
                    class="flex rounded-xl max-w-sm flex-col overflow-hidden border border-slate-300 bg-slate-100 text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                    <!--Card Content ---------------------------------------------------------------------------------->

                    <div class="flex flex-col gap-4 p-6">
                        <div class="flex justify-between">
                            <div class="flex items-center gap-1 font-medium">
                                <span>
                                    {{$row->vname}}
                                </span>
                            </div>

                            <!--Edit & Delete ------------------------------------------------------------------------->

                            <div class="flex justify-center items-center gap-4 self-center">
                                <x-button.edit wire:click="edit({{$row->id}})"/>
                                <x-button.delete wire:click="getDelete({{$row->id}})"/>
                            </div>
                        </div>

                        <!--Title & Body ------------------------------------------------------------------------------>


                        <p id="tripDescription" class="text-pretty text-sm mb-2">
                            {!! $row->description !!}
                        </p>
                        <p id="tripDescription" class="text-pretty text-sm mb-2">
                           Duration : {{date('d-m-Y',strtotime($row->total_duration))}}
                        </p>
                        <p id="tripDescription" class="text-pretty text-sm mb-2">
                            Start Date: {{date('d-m-Y-H-i-s',(strtotime($row->start_date)))}}
                        </p>
                        <p id="tripDescription" class="text-pretty text-sm mb-2">
                            End Date: {{date('d-m-Y-H-i-s',(strtotime($row->end_date)))}}
                        </p>
                    </div>
                </article>
            @endforeach

        </div>


        <x-modal.delete/>

    <x-forms.create :id="$common->vid">
        <div class="space-y-4">

            <x-input.floating wire:model="common.vname" :label="'Project Title'"/>
            @error('common.vname')
            <span class="text-red-500 text-xs">{{'Need Project Title.'}}</span>
            @enderror

            <x-input.rich-text :placeholder="''" wire:model="description"/>

            <x-input.floating wire:model.live="start_date" :label="'Start Date'" type="datetime-local"/>

            <x-input.floating wire:model.live="end_date" :label="'End Date'" type="datetime-local"/>

            <x-input.floating wire:model.live="total_duration" :label="'Total Duration'"/>

            <x-input.model-select wire:model.live="status" :label="'Status'">
                <option value="">Choose...</option>
                @foreach(App\Enums\Status::cases() as $status)
                    <option value="{{$status->value}}">{{$status->getName()}}</option>
                @endforeach
            </x-input.model-select>

        </div>
    </x-forms.create>
</div>
