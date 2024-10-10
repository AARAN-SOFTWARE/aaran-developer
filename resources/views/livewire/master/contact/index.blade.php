<div>
    <x-slot name="header">Contacts</x-slot>

    <!-- Top Controls --------------------------------------------------------------------------------------------->

    <x-forms.m-panel>

        <x-forms.top-controls :show-filters="$showFilters"/>

        <!-- Top Controls --------------------------------------------------------------------------------------------->

        <x-table.caption :caption="'Contacts'">
            {{$list->count()}}
        </x-table.caption>

        <!-- Table Header --------------------------------------------------------------------------------------------->

        <x-table.form>

            <x-slot:table_header name="table_header" class="bg-green-600">
                <x-table.header-serial width="20%"/>

                <x-table.header-text wire:click="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Name
                </x-table.header-text>

                <x-table.header-text sortIcon="none">Mobile</x-table.header-text>

                <x-table.header-text sortIcon="none">Contact Type</x-table.header-text>

                <x-table.header-text sortIcon="none">Contact Person</x-table.header-text>
                <x-table.header-text sortIcon="none">GST No</x-table.header-text>
                <x-table.header-text sortIcon="none">Outstanding</x-table.header-text>

                <x-table.header-action/>

            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>

                        <x-table.cell-text><a href="{{route('contactReport',[$row->id])}}"> {{$index+1}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text left><a href="{{route('contacts.upsert',[$row->id])}}"> {{$row->vname}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text><a href="{{route('contacts.upsert',[$row->id])}}"> {{$row->mobile}}</a>
                        </x-table.cell-text>



                        <x-table.cell-text>
                            <a href="{{route('contacts.upsert',[$row->id])}}" class="{{$row->contact_type == 'Debtor'?:'text-orange-400'}}">
                                {{$row->contact_type}}
                            </a>
                        </x-table.cell-text>

                        <x-table.cell-text><a
                                href="{{route('contacts.upsert',[$row->id])}}"> {{$row->contact_person}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text><a
                                href="{{route('contacts.upsert',[$row->id])}}"> {{$row->gstin}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text><a
                                href="{{route('contacts.upsert',[$row->id])}}"> {{$row->opening_balance+$row->outstanding}}</a>
                        </x-table.cell-text>

                        <td class="max-w-max print:hidden">
                            <div class="flex justify-center items-center sm:gap-4 gap-2 px-1 self-center">
                                <a href="{{route('contacts.upsert',[$row->id])}}" class="pt-1">
                                    <x-button.edit/>
                                </a>
                                <x-button.delete wire:click="getDelete({{$row->id}})"/>
                            </div>
                        </td>
                    </x-table.row>

                @endforeach

            </x-slot:table_body>

        </x-table.form>

        <x-modal.delete/>

{{--        <div class="pt-5">{{ $list->links() }}</div>--}}

    </x-forms.m-panel>
</div>
