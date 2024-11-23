<div>
    <x-slot name="header">Payment</x-slot>

    <x-forms.m-panel>
        <x-forms.top-controls :show-filters="$showFilters"/>

        <x-table.form>

            <!-- Table Header ----------------------------------------------------------------------------------------->

            <x-slot:table_header name="table_header" class="bg-green-600">
                <x-table.header-serial width="20%"/>

                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}" left
                                     width="25%">
                Contact Name
                </x-table.header-text>

                <x-table.header-text sortIcon="none" width="25%">
                    Plan
                </x-table.header-text>

                <x-table.header-text sortIcon="none" width="8%">
                    Software
                </x-table.header-text>

                <x-table.header-text sortIcon="none" width="8%">
                    Status
                </x-table.header-text>

                <x-table.header-action/>
            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>

                        <x-slot:table_body name="table_body">

                            @foreach($list as $index=>$row)

                                <x-table.row>
                                    <x-table.cell-text>{{$index+1}}</x-table.cell-text>

                                    <x-table.cell-text>{{$row->vname}}</x-table.cell-text>

                                    <x-table.cell-text>{{$row->latest_version}}</x-table.cell-text>

                                    <x-table.cell-text>{{ date('d-m-Y',strtotime($row->vdate)) }}</x-table.cell-text>

                                    <x-table.cell-text>{!! $row->notes !!}</x-table.cell-text>

                                    <x-table.cell-action id="{{$row->id}}"/>
                                </x-table.row>
                            @endforeach

                        </x-slot:table_body>
                    </x-table.row>
                @endforeach

            </x-slot:table_body>

        </x-table.form>
    </x-forms.m-panel>

</div>
