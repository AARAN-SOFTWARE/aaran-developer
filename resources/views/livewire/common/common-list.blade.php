<div>
    <x-slot name="header">Common</x-slot>

    <x-forms.m-panel>

        <!-- Top Controls --------------------------------------------------------------------------------------------->

        <x-forms.top-controls :show-filters="$showFilters"/>

        <div class="flex gap-3">
            <div>
                {{--                <div class="ml-8">--}}
                {{--                    <div x-data="{show: false}">--}}
                {{--                        <a href="#" x-on:click.prevent="show = !show" class="relative z-10 border border-gray-600 rounded px-4 py-2 bg-white">--}}
                {{--                            <span class="inline-block">Select Vehicle Type</span>--}}
                {{--                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="stroke-current inline-block w-4 h-4 transform transition duration-150" x-bind:class="{ 'rotate-180': show }">--}}
                {{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />--}}
                {{--                            </svg>--}}
                {{--                        </a>--}}
                {{--                        <div x-show.transition="show" class="relative z-20 mt-1 flex w-64 flex-col px-4 py-8 whitespace-nowrap border border-gray-600 rounded bg-white">--}}
                {{--                          @foreach($labelData as $data)--}}
                {{--                            <div><input type="checkbox" name="type[]" wire:model.live="filter" value="{{$data->id}}" class="inline-block mr-2" />{{$data->vname}}</div>--}}
                {{--                            @endforeach--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>

            <x-table.caption :caption="'Common'">
                {{$list->count()}}
            </x-table.caption>
        </div>

        <x-table.form>

            <!-- Table Header ----------------------------------------------------------------------------------------->

            <x-slot:table_header name="table_header" class="bg-green-600">
                <x-table.header-serial width="20%"/>
                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">Common
                    Name
                </x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Description
                </x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Description-2
                </x-table.header-text>
                <x-table.header-text>Status</x-table.header-text>
                <x-table.header-action/>
            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">
                @foreach($labelData as $data)
                    <x-table.row>
                        <x-table.cell-text :colspan="'6'" left>
                                <span class="ml-10 text-lg font-bold">
                                    {{$data->vname}}
                                </span>
                        </x-table.cell-text>

                        @foreach($list as $index=>$row)
                            @if($data->id==$row->label_id)
                                <x-table.row>
                                    <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                                    <x-table.cell-text>{{$row->vname}}</x-table.cell-text>
                                    <x-table.cell-text>{{$row->desc}}</x-table.cell-text>
                                    <x-table.cell-text>{{$row->desc_1}}</x-table.cell-text>
                                    <x-table.cell-status active="{{$row->active_id}}"/>
                                    <x-table.cell-action id="{{$row->id}}"/>
                                </x-table.row>
                            @endif
                        @endforeach

                    </x-table.row>
                @endforeach
            </x-slot:table_body>
        </x-table.form>
        <x-modal.delete/>
        <div class="pt-5">{{ $list->links() }}</div>

        <!-- Form ----------------------------------------------------------------------------------------------------->

        <x-forms.create :id="$common->vid">
            <div class="flex flex-col  gap-3">
                <x-input.model-select wire:model="label_id" :label="'Title'">
                    <option value="">Choose..</option>
                    @foreach($labelData as $value)
                        <option value="{{$value->id}}">{{$value->vname}}</option>
                    @endforeach
                </x-input.model-select>
                {{--                <x-input.model-text wire:model="common.vname" :label="'Name'"/>--}}
                <x-input.floating wire:model="common.vname" label="Name"/>
                <x-input.floating wire:model="desc" label="Description 1"/>
                <x-input.floating wire:model="desc_1" label="Description 2"/>
                {{--                <x-input.model-text wire:model="desc" :label="'desc'"/>--}}
                {{--                <x-input.model-text wire:model="desc_1" :label="'desc 1'"/>--}}
            </div>
        </x-forms.create>
    </x-forms.m-panel>
</div>
