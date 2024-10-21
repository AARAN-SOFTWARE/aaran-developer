<div>
    <x-slot name="header">Project Activity</x-slot>

    <x-forms.top-controls :show-filters="$showFilters"/>

    <div class="flex w-full">

        <x-table.caption :caption="'Activity'">
            {{$list->count()}}
        </x-table.caption>
    </div>

    <!-- Card Body  ------------------------------------------------------------------------------------------>
    <div class="flex flex-col w-full h-auto gap-10 mt-3">

        @foreach($list as $index=>$row)

            <article
                class="flex flex-col w-full rounded-xl overflow-hidden border border-slate-300 bg-slate-100 text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">

                <!--Card Content ---------------------------------------------------------------------------------->

                <div class="flex flex-col gap-4 p-6">

                    <div class="flex justify-between">

                        <div class="flex items-center gap-1 text-xl text-teal-800 capitalize">
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


                    <div id="tripDescription" class="text-pretty text-sm mb-2">
                        {!! $row->description !!}
                    </div>

                    <div id="tripDescription" class="text-pretty text-sm mb-2">
                        <span class="text-teal-600"> Duration :</span>
                        <span>{{date('d-m-Y',strtotime($row->total_duration))}}</span>
                    </div>

                    <div id="tripDescription" class="text-pretty text-sm mb-2">
                        <span class="text-red-700">Start Date :</span>
                        <span>{{date('d-m-Y-H-i-s',(strtotime($row->start_date)))}}</span>
                    </div>

                    <div id="tripDescription" class="text-pretty text-sm mb-2">
                        <span class="text-red-700"> End Date :</span>
                        <span>{{date('d-m-Y-H-i-s',(strtotime($row->end_date)))}}</span>
                    </div>
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
