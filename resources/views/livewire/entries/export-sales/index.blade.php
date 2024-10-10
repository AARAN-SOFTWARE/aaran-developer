<div>
    <x-slot name="header">Export Sales</x-slot>
    <x-forms.m-panel>

        <x-forms.top-controls :show-filters="$showFilters"/>

        <x-table.caption :caption="'Sales'">
            {{$list->count()}}
        </x-table.caption>
        <x-table.form>
            <x-slot:table_header name="table_header" class="bg-green-600">
                <x-table.header-text wire:click="sortBy('invoice_no')" sortIcon="{{$getListForm->sortAsc}}">
                    Invoice No
                </x-table.header-text>
                <x-table.header-text wire:click="sortBy('invoice_no')" sortIcon="{{$getListForm->sortAsc}}">
                    Invoice Date
                </x-table.header-text>
                <x-table.header-text wire:click="sortBy('invoice_no')" sortIcon="none"> Party Name</x-table.header-text>
                <x-table.header-text wire:click="sortBy('invoice_no')" sortIcon="none">Total Qty</x-table.header-text>
                <x-table.header-text wire:click="sortBy('invoice_no')" sortIcon="none">Total Taxable
                </x-table.header-text>
                <x-table.header-text wire:click="sortBy('invoice_no')" sortIcon="none">Total Gst</x-table.header-text>
                <x-table.header-text wire:click="sortBy('invoice_no')" sortIcon="none">Grand Total</x-table.header-text>
                <x-table.header-text sortIcon="none">Packing List</x-table.header-text>
                <x-table.header-text wire:click="sortBy('invoice_no')" sortIcon="none">Print</x-table.header-text>
                <x-table.header-action/>
            </x-slot:table_header>

            <x-slot:table_body name="table_body">
                @foreach($list as $index=>$row)
                    <x-table.row>
                        <x-table.cell-text>
                            <a href="{{route('exportsales.upsert',[$row->id])}}"> {{$row->invoice_no}}</a>
                        </x-table.cell-text>
                        <x-table.cell-text>
                            <a href="{{route('exportsales.upsert',[$row->id])}}"> {{ date('d-m-Y', strtotime( $row->invoice_date))}}</a>
                        </x-table.cell-text>
                        <x-table.cell-text left>
                            <a href="{{route('exportsales.upsert',[$row->id])}}"> {{$row->contact->vname}}</a>
                        </x-table.cell-text>
                        <x-table.cell-text>
                            <a href="{{route('exportsales.upsert',[$row->id])}}"> {{$row->total_qty+0}}</a>
                        </x-table.cell-text>
                        <x-table.cell-text right>
                            <a href="{{route('exportsales.upsert',[$row->id])}}"> {{$row->total_taxable}}</a>
                        </x-table.cell-text>
                        <x-table.cell-text right>
                            <a href="{{route('exportsales.upsert',[$row->id])}}"> {{$row->total_gst}}</a>
                        </x-table.cell-text>
                        <x-table.cell-text right>
                            <a href="{{route('exportsales.upsert',[$row->id])}}"> {{$row->grand_total}}</a>
                        </x-table.cell-text>
                        <x-table.cell-text>
                            <a href="{{route('exportsales.packingList',[$row->id])}}" class="relative group text-gray-500 flex justify-center items-center
                                transition-colors duration-200 dark:hover:text-green-500
                                dark:text-gray-300 hover:text-green-600 focus:outline-none animate group">
                                <svg
                                    class="w-5 h-5 block fill-gray-600 group-hover:fill-green-500"
                                    style="width: 1em;
                                    height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;"
                                    viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M893.60616817 445.64371543L813.23772031 365.65436357a50.04073213 50.04073213 0 0 0-37.90964531-15.16385829
                                        49.66163526 49.66163526 0 0 0-37.90964531 15.16385829l-307.44722373
                                        309.72180235-147.08942315-147.4685209a57.24356484 57.24356484 0 0 0-37.90964531-15.16385742
                                        57.62266084 57.62266084 0 0 0-37.90964531 15.16385742L129.72681494 607.89699687a51.17802099
                                        51.17802099 0 0 0 0 73.16561514l263.47203545 265.36751719a50.04073213 50.04073213 0 0 0 37.90964531
                                        15.54295518 51.55711787 51.55711787 0 0 0 37.90964532-15.54295518l424.58802714-426.48350977a49.66163526
                                        49.66163526 0 0 0 14.78476143-37.90964531 51.17802099 51.17802099 0 0 0-14.78476143-36.39325869zM429.97120596
                                        908.89958076l-265.36751719-265.36751719 80.36844873-79.23115898 183.48268271 183.48268359L776.84446075
                                        403.56400888l78.8520621 80.36844786zM243.07665488 115.45070469h272.9494459a25.3994625 25.3994625 0 0 0
                                        25.77855938-25.77855938 25.3994625 25.3994625 0 0 0-25.77855938-27.29494424H243.07665488a25.3994625
                                        25.3994625 0 0 0-25.7785585 25.7785585 25.3994625 25.3994625 0 0 0 25.7785585 27.29494512z m0
                                        147.46852002h490.17171358a25.77855849 25.77855849 0 1 0 0-51.55711787H243.07665488a25.77855849 25.77855849
                                        0 1 0 0 51.55711787z m0 147.46852002h272.9494459a25.3994625 25.3994625 0 0 0 25.77855938-25.7785585 25.77855849
                                        25.77855849 0 0 0-25.77855938-26.15765537H243.07665488a25.77855849 25.77855849 0 0 0-25.7785585 26.15765537
                                        25.3994625 25.3994625 0 0 0 25.7785585 25.7785585zM155.12627744 116.58799356A27.29494424 27.29494424 0 1 0
                                        128.2104292 89.67214531a27.29494424 27.29494424 0 0 0 26.91584824 26.91584825z m0 147.46852089a27.29494424
                                        27.29494424 0 1 0-26.91584824-27.29494511 27.29494424 27.29494424 0 0 0 26.91584824 27.29494511z m0
                                        147.46852003a27.29494424 27.29494424 0 1 0-27.29494424-27.29494513 27.29494424 27.29494424 0 0 0 27.29494424
                                        27.29494512z"/>
                                </svg>
                            </a>
                        </x-table.cell-text>
                        <x-table.cell-text>
                            <x-button.print-pdf routes="{{route('exportsales.print', [$row->id])}}"/>
                        </x-table.cell-text>
                        <td class="max-w-max print:hidden">
                            <div class="flex justify-center items-center">
                                <a href="{{route('exportsales.upsert',[$row->id])}}" class="pt-1 px-1.5">
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

        <div class="pt-5">{{ $list->links() }}</div>

    </x-forms.m-panel>
</div>
