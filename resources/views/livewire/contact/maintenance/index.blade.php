<div>
    <x-slot name="header">Maintenance</x-slot>

    <x-forms.m-panel>

        <x-forms.top-controls :show-filters="$showFilters"/>

        <!-- Table Header  ------------------------------------------------------------------------------------------>

        <x-table.form>

            <x-slot:table_header name="table_header" class="bg-green-100">

                <x-table.header-serial></x-table.header-serial>
                <x-table.header-text sort-icon="none">Current Version</x-table.header-text>
                <x-table.header-text sort-icon="none">Latest Version</x-table.header-text>
                <x-table.header-text sort-icon="none">Date</x-table.header-text>
                <x-table.header-text sort-icon="none">Notes</x-table.header-text>
                <x-table.header-action/>

            </x-slot:table_header>

            <!-- Table Body  ------------------------------------------------------------------------------------------>

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>

                        <x-table.cell-text>{{$row->vname}}</x-table.cell-text>

                        <x-table.cell-text>{{$row->latest_version}}</x-table.cell-text>

                        <x-table.cell-text>{{$row->notes}}</x-table.cell-text>

                        <x-table.cell-text>{{ date('d-m-Y',strtotime($row->vdate)) }}</x-table.cell-text>

                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach

            </x-slot:table_body>

            <x-modal.delete/>
        </x-table.form>

        <!-- Create  -------------------------------------------------------------------------------------------------->

        <x-forms.create :id="$common->vid">

            <div class="space-y-4">

                <x-input.floating wire:model="common.vname" :label="'Current Version'"/>

                <x-input.floating wire:model="latest_version" :label="'Latest Version'"/>

                <x-input.floating wire:model="notes" :label="'Notes'"/>

                <x-input.floating wire:model="vdate" type="date" :label="'Date'"/>

            </div>
        </x-forms.create>
    </x-forms.m-panel>
</div>
