<div>
    <x-slot name="header">Project Activity</x-slot>
    <x-forms.m-panel>
        <x-forms.top-controls :show-filters="$showFilters"/>
        <div class="flex w-full">

            <x-table.caption :caption="'Project'">
                {{$list->count()}}
            </x-table.caption>
        </div>

        <!-- Table Header  ------------------------------------------------------------------------------------------>

        <x-table.form>

            <x-slot:table_header name="table_header" class="bg-green-100">

                <x-table.header-serial></x-table.header-serial>
                <x-table.header-text sort-icon="none">Title</x-table.header-text>
                <x-table.header-text sort-icon="none">Description</x-table.header-text>
                <x-table.header-action/>

            </x-slot:table_header>

            <!-- Table Body  ------------------------------------------------------------------------------------------>
            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->vname}}</x-table.cell-text>
                        <x-table.cell-text>{!! $row->description!!}</x-table.cell-text>
                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach

            </x-slot:table_body>

            <x-modal.delete/>
        </x-table.form>

        <x-forms.create :id="$common->vid">
            <div class="space-y-4">

                <x-input.floating wire:model="common.vname" :label="'Project Title'"/>
                @error('common.vname')
                <span class="text-red-500 text-xs">{{'Need Project Title.'}}</span>
                @enderror

                <x-input.rich-text :placeholder="''" wire:model="description"/>

            </div>
        </x-forms.create>
    </x-forms.m-panel>
</div>
