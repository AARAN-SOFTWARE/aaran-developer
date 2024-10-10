<div>
    <x-slot name="header">Purchase</x-slot>

    <!-- Top Control -------------------------------------------------------------------------------------------------->
    <x-forms.m-panel>

        <x-forms.top-controls :show-filters="$showFilters"/>

        <x-table.caption :caption="'Purchase'">
            {{$list->count()}}
        </x-table.caption>

        <!-- Table Header --------------------------------------------------------------------------------------------->
        <x-table.form>

            <x-slot:table_header name="table_header" class="bg-green-100">

                <x-table.header-text wire:click="sortBy('purchase_no')" sortIcon="{{$getListForm->sortAsc}}">
                    Order No
                </x-table.header-text>

                <x-table.header-text wire:click="sortBy('purchase_no')" sortIcon="{{$getListForm->sortAsc}}">
                    Purchase No
                </x-table.header-text>

                <x-table.header-text wire:click="sortBy('purchase_no')" sortIcon="none"> Purchase Date
                </x-table.header-text>

                <x-table.header-text wire:click="sortBy('purchase_no')" sortIcon="none"> Party Name
                </x-table.header-text>

                <x-table.header-text wire:click="sortBy('purchase_no')" sortIcon="none">Total Qty</x-table.header-text>

                <x-table.header-text wire:click="sortBy('purchase_no')" sortIcon="none">Total Taxable
                </x-table.header-text>

                <x-table.header-text wire:click="sortBy('purchase_no')" sortIcon="none">Total Gst</x-table.header-text>

                <x-table.header-text wire:click="sortBy('purchase_no')" sortIcon="none">Grand Total
                </x-table.header-text>

                <x-table.header-text wire:click="sortBy('purchase_no')" sortIcon="none">Print</x-table.header-text>

                <x-table.header-action/>

            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>

                        <x-table.cell-text>
                            <a href="{{route('purchase.upsert',[$row->id])}}"> {{$row->order->vname}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <a href="{{route('purchase.upsert',[$row->id])}}"> {{$row->purchase_no}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <a href="{{route('purchase.upsert',[$row->id])}}"> {{ date('d-m-Y', strtotime( $row->purchase_date))}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text left>
                            <a href="{{route('purchase.upsert',[$row->id])}}"> {{$row->contact->vname}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <a href="{{route('purchase.upsert',[$row->id])}}"> {{$row->total_qty+0}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text right>
                            <a href="{{route('purchase.upsert',[$row->id])}}"> {{$row->total_taxable}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text right>
                            <a href="{{route('purchase.upsert',[$row->id])}}"> {{$row->total_gst}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text right>
                            <a href="{{route('purchase.upsert',[$row->id])}}"> {{$row->grand_total}}</a>
                        </x-table.cell-text>
                        <x-table.cell-text>
                            <x-button.print-pdf routes="{{route('purchases.print', [$row->id])}}"/>
                        </x-table.cell-text>

                        <!-- Table Action ----------------------------------------------------------------------------->
                        <td class="max-w-max print:hidden">
                            <div class="flex justify-center items-center">
                                <a href="{{route('purchase.upsert',[$row->id])}}" class="pt-1 px-1.5">
                                    <x-button.edit  />
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
