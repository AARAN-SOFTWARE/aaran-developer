<div>
    <x-slot name="header">Labels</x-slot>

    <x-forms.m-panel>

        <!-- Top Controls --------------------------------------------------------------------------------------------->
        <x-forms.top-controls :show-filters="$showFilters"/>

        <!-- Table Caption -------------------------------------------------------------------------------------------->
        <x-table.caption :caption="'Labels'">
            {{$list->count()}}
        </x-table.caption>

        <!-- Table Data ----------------------------------------------------------------------------------------------->

        <x-table.form>
            <x-slot:table_header>
                <x-table.header-serial/>
                <x-table.header-text wire:click.prevent="sortBy('vname')"  sortIcon="{{$getListForm->sortAsc}}">
                    Name
                </x-table.header-text>
                <x-table.header-status/>
                <x-table.header-action/>
            </x-slot:table_header>

            <x-slot:table_body>
                @foreach($list as $index=>$row)
                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->vname}}</x-table.cell-text>
                        <x-table.cell-status active="{{$row->active_id}}"/>
                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach
            </x-slot:table_body>
        </x-table.form>

        <!-- Delete Modal --------------------------------------------------------------------------------------------->
        <x-modal.delete/>

        <div class="pt-5">{{ $list->links() }}</div>

        <!-- Create/ Edit Popup --------------------------------------------------------------------------------------->

        <x-forms.create :id="$common->vid">
{{--            <x-input.model-text wire:model="common.vname" :label="'City Name'"/>--}}
            <x-input.floating wire:model="common.vname" label="City Name" />
        </x-forms.create>

    </x-forms.m-panel>


</div>
