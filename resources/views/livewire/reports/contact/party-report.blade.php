<div>
    <x-slot name="header">Party Report</x-slot>

    <x-forms.m-panel>
        @php
            $party=\Aaran\Master\Models\Contact::find($byParty);
        @endphp
        <div class="flex justify-between w-full gap-3">
            <div class="text-xl font-bold tracking-wider w-full">Party Name
                : {{$party->vname}}</div>
            <div class="w-full">
                <x-input.model-date wire:model.live="start_date" :label="'From Date'"/>
            </div>
            <div class="w-full">
                <x-input.model-date wire:model.live="end_date" :label="'To Date'"/>
            </div>
            <div class="w-full">&nbsp;</div>

        </div>

        <x-table.form>
            <x-slot:table_header name="table_header">
                <x-table.header-serial width="20%"/>
                <x-table.header-text :sort-icon="'none'" center>Type</x-table.header-text>
                <x-table.header-text :sort-icon="'none'" left>Particulars</x-table.header-text>
                <x-table.header-text :sort-icon="'none'">Invoice Amount</x-table.header-text>
                <x-table.header-text :sort-icon="'none'">Receipt Amount</x-table.header-text>
                <x-table.header-text :sort-icon="'none'">Balance</x-table.header-text>
            </x-slot:table_header>


            <x-slot:table_body name="table_body">

                @php
                    $totalSales = 0+$opening_balance;
                    $totalReceipt = 0;
                @endphp
                <x-table.row>
                    @if($byParty !=null)

                        <x-table.cell-text colspan="3">
                            <div class="text-right font-bold">
                                Opening Balance
                            </div>
                        </x-table.cell-text>

                        <x-table.cell-text colspan="1">
                            <div class="text-right font-bold">
                                {{ $opening_balance}}
                            </div>
                        </x-table.cell-text>
                        <x-table.cell-text colspan="1">
                        </x-table.cell-text>
                        <x-table.cell-text colspan="1">
                            {{$opening_balance}}
                        </x-table.cell-text>
                    @endif
                </x-table.row>

                @forelse ($list as $index =>  $row)

                    @php
                    if ($row->mode=='Sales Invoice'){
                        if ($party->contact_type_id==124){
                        $totalSales += floatval($row->grand_total);}else{$totalSales -= floatval($row->grand_total);}
                        }else{
                        if ($party->contact_type_id==123){
                        $totalSales += floatval($row->grand_total);}else{ $totalSales -= floatval($row->grand_total);}
                        }
                        $totalReceipt += floatval($row->transaction_amount);
                    @endphp

                    <x-table.row>
                        <x-table.cell-text center>
                            {{ $index + 1 }}
                        </x-table.cell-text>

                        <x-table.cell-text center>
                            {{ $row->mode }}
                        </x-table.cell-text>

                        <x-table.cell-text left>
                            {{$row->mode=='Purchase Invoice'||$row->mode=='Sales Invoice' ?$row->vno.' / ':''}}{{date('d-m-Y', strtotime($row->vdate))}}
                        </x-table.cell-text>

                        <x-table.cell-text right>
                            {{ $row->grand_total }}
                        </x-table.cell-text>

                        <x-table.cell-text right>
                            {{ $row->transaction_amount }}
                        </x-table.cell-text>

                        <x-table.cell-text>
                            {{  $balance  = $totalSales-$totalReceipt}}
                        </x-table.cell-text>

                    </x-table.row>

                @empty
                @endforelse


                <x-table.row>
                    <x-table.cell-text colspan="3" class=" text-md text-right text-gray-400">&nbsp;TOTALS&nbsp;&nbsp;&nbsp;
                    </x-table.cell-text>
                    <x-table.cell-text
                        class=" text-right  text-md  text-zinc-500 ">{{$totalSales+$opening_balance}}</x-table.cell-text>
                    <x-table.cell-text
                        class=" text-right  text-md  text-zinc-500 ">{{ $totalReceipt}}</x-table.cell-text>
                    <x-table.cell-text></x-table.cell-text>
                </x-table.row>

                <x-table.row>
                    <x-table.cell-text colspan="3" class=" text-md text-right text-gray-400 ">&nbsp;Balance&nbsp;&nbsp;&nbsp;
                    </x-table.cell-text>
                    <x-table.cell-text
                        class=" text-right  text-md  text-blue-500 ">{{ $totalSales-$totalReceipt}}</x-table.cell-text>
                    <x-table.cell-text class=" text-right  text-md  text-blue-500 "></x-table.cell-text>
                    <x-table.cell-text></x-table.cell-text>
                </x-table.row>
            </x-slot:table_body>
        </x-table.form>
    </x-forms.m-panel>
</div>
