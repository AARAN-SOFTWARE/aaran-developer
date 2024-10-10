<div>
    <x-slot name="header">{{$mode_name}}</x-slot>

    <x-forms.m-panel>

        <!-- Top Controls  -------------------------------------------------------------------------------------------->

        <x-forms.top-controls :show-filters="$showFilters"/>

        <div class="flex w-full">

            <x-table.caption :caption="$mode_name">
                {{$list->count()}}
            </x-table.caption>

            <div class="flex justify-end w-full">
                    <x-button.print-x href="{{ route('transactions.print',[$mode_id == 111 ? 1 : 2 ]) }}" />
            </div>
        </div>

        <x-table.form>

            <!-- Table Header  ---------------------------------------------------------------------------------------->

            <x-slot:table_header name="table_header" class="bg-green-100">

                <x-table.header-serial></x-table.header-serial>

                <x-table.header-text wire:click.prevent="sortBy ('contact_id')" sort-icon="{{$getListForm->sortAsc}}">
                    Contact
                </x-table.header-text>

                <x-table.header-text wire:click.prevent="sortBy('contact_id')"
                                     sort-icon="none">Type
                </x-table.header-text>

{{--                <x-table.header-text sort-icon="none">Mode of Payments</x-table.header-text>--}}

                <x-table.header-text sort-icon="none">Amount</x-table.header-text>

                <x-table.header-action/>

            </x-slot:table_header>

            <!-- Table Body  ------------------------------------------------------------------------------------------>

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>

                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>

                        <x-table.cell-text left>{{$row->contact->vname}}</x-table.cell-text>

                        <x-table.cell-text>{{\Aaran\Transaction\Models\Transaction::common($row->receipttype_id)}}</x-table.cell-text>

{{--                        <x-table.cell-text>{{Aaran\Common\Models\Common::find($row->trans_type_id)->vname}}</x-table.cell-text>--}}

                        <x-table.cell-text right>{{$row->vname+0}}</x-table.cell-text>

                        <x-table.cell-action id="{{$row->id}}"/>

                    </x-table.row>
                @endforeach

            </x-slot:table_body>

        </x-table.form>

        <x-modal.delete/>

        <div class="pt-5">{{ $list->links() }}</div>

        <!-- Create  -------------------------------------------------------------------------------------------------->

        <x-forms.create :id="$common->vid" :max-width="'6xl'" wire:click="contactUpdate">

            <!-- Receipt & Payment  ----------------------------------------------------------------------------------->

            <div class="flex gap-3 w-full mb-3">
                <x-radio.btn value="108" wire:model.live="trans_type_id">Cash Book
                </x-radio.btn>
                <x-radio.btn value="109" wire:model.live="trans_type_id">Bank Book
                </x-radio.btn>
            </div>

            <div class="flex gap-x-5 gap-y-3">

                <!-- Left Area  --------------------------------------------------------------------------------------->

                <div class="w-1/2 space-y-3">

                    <!-- Party Name ----------------------------------------------------------------------------------->

                    <x-dropdown.wrapper label="Contact Name" type="contactTyped">
                        <div class="relative ">

                            <x-dropdown.input label="Contact Name*" id="contact_name"
                                              wire:model.live="contact_name"
                                              wire:keydown.arrow-up="decrementContact"
                                              wire:keydown.arrow-down="incrementContact"
                                              wire:keydown.enter="enterContact"/>
                            <x-dropdown.select>

                                @if($contactCollection)
                                    @forelse ($contactCollection as $i => $contact)
                                        <x-dropdown.option highlight="{{ $highlightContact === $i }}"
                                                           wire:click.prevent="setContact('{{$contact->vname}}','{{$contact->id}}')">
                                            {{ $contact->vname }}
                                        </x-dropdown.option>
                                    @empty
                                        <x-dropdown.new href="{{route('contacts.upsert',['0'])}}" label="Contact"/>
                                    @endforelse
                                @endif
                            </x-dropdown.select>

                        </div>
                    </x-dropdown.wrapper>

                    <x-input.floating wire:model="common.vname" :label="'Amount*'"/>

                    <x-input.model-date wire:model="vdate" :label="'Date'"/>

                </div>

                <!-- Right Area  -------------------------------------------------------------------------------------->

                <div class="w-1/2 space-y-3">

                    <x-tabs.tab-panel>

                        <x-slot name="tabs">
                            <x-tabs.tab>Instrument</x-tabs.tab>
                            <x-tabs.tab>Against</x-tabs.tab>
                            <x-tabs.tab>Purpose</x-tabs.tab>
                            <x-tabs.tab>Admin</x-tabs.tab>
                        </x-slot>

                        <x-slot name="content">

                            <!-- Tab 1  ------------------------------------------------------------------------------->

                            <x-tabs.content>

                                <div class="flex flex-col gap-3">

                                    <!-- receipt type ----------------------------------------------------------------->

                                    @if($trans_type_id == 109)

                                        <x-dropdown.wrapper label="Type" type="receipt_typeTyped">

                                            <div class="relative ">

                                                <x-dropdown.input label="Type" id="receipt_type_name"
                                                                  wire:model.live="receipt_type_name"
                                                                  wire:keydown.arrow-up="decrementReceiptType"
                                                                  wire:keydown.arrow-down="incrementReceiptType"
                                                                  wire:keydown.enter="enterReceiptType"/>

                                                <x-dropdown.select>
                                                    @if($receipt_typeCollection)
                                                        @forelse ($receipt_typeCollection as $i => $receipt_type)
                                                            <x-dropdown.option
                                                                highlight="{{$highlightReceiptType === $i  }}"
                                                                wire:click.prevent="setReceiptType('{{$receipt_type->vname}}','{{$receipt_type->id}}')">
                                                                {{ $receipt_type->vname }}
                                                            </x-dropdown.option>
                                                        @empty
                                                            <x-dropdown.new
                                                                wire:click.prevent="receiptTypeSave('{{$receipt_type_name}}')"
                                                                label="Receipt"/>
                                                        @endforelse
                                                    @endif
                                                </x-dropdown.select>

                                            </div>

                                        </x-dropdown.wrapper>
                                    @endif

                                    <!-- bank ------------------------------------------------------------------------->

                                    @if($receipt_type_name =='Cheque')

                                        <x-dropdown.wrapper label="Bank" type="bankTyped">
                                            <div class="relative ">

                                                <x-dropdown.input label="Bank" id="bank_name"
                                                                  wire:model.live="bank_name"
                                                                  wire:keydown.arrow-up="decrementBank"
                                                                  wire:keydown.arrow-down="incrementBank"
                                                                  wire:keydown.enter="enterBank"/>

                                                <x-dropdown.select>

                                                    @if($bankCollection)
                                                        @forelse ($bankCollection as $i => $bank)
                                                            <x-dropdown.option highlight="{{$highlightBank === $i  }}"
                                                                               wire:click.prevent="setBank('{{$bank->vname}}','{{$bank->id}}')">
                                                                {{ $bank->vname }}
                                                            </x-dropdown.option>
                                                        @empty
                                                            <x-dropdown.new
                                                                wire:click.prevent="bankSave('{{$bank_name}}')"
                                                                label="Bank Details"/>
                                                        @endforelse
                                                    @endif

                                                </x-dropdown.select>
                                            </div>

                                        </x-dropdown.wrapper>

                                        <x-input.model-date :label="'Chq.Date'"/>
                                        <x-input.floating wire:model="chq_no" :label="'Chq_no'"/>
                                        <x-input.model-date wire:model="deposit_on" :label="'Deposit On'"/>
                                        <x-input.model-date wire:model="realised_on" :label="'Realised On'"/>
                                    @endif

                                    <x-input.floating wire:model="remarks" :label="'Remarks'"/>

                                </div>

                            </x-tabs.content>

                            <!-- Tab 2  ------------------------------------------------------------------------------->

                            <x-tabs.content>

                                <div class="flex flex-col gap-3">

                                    <!-- Order No --------------------------------------------------------------------->

                                    <x-dropdown.wrapper label="Order NO" type="orderTyped">

                                        <div class="relative">
                                            <x-dropdown.input label="Order NO" id="order_name"
                                                              wire:model.live="order_name"
                                                              wire:keydown.arrow-up="decrementOrder"
                                                              wire:keydown.arrow-down="incrementOrder"
                                                              wire:keydown.enter="enterOrder"/>

                                            <x-dropdown.select>
                                                @if($orderCollection)

                                                    @forelse ($orderCollection as $i => $order)

                                                        <x-dropdown.option highlight="{{$highlightOrder === $i  }}"
                                                                           wire:click.prevent="setOrder('{{$order->vname}}','{{$order->id}}')">
                                                            {{ $order->vname }}
                                                        </x-dropdown.option>
                                                    @empty
                                                        @livewire('controls.model.order-model',[$order_name])
                                                    @endforelse
                                                @endif
                                            </x-dropdown.select>
                                        </div>

                                    </x-dropdown.wrapper>

                                    <x-input.floating wire:model="ref_no" :label="'Against'"/>

                                    <x-input.floating wire:model="ref_amount" :label="'Ref Amount'"/>

                                </div>

                            </x-tabs.content>

                            <!-- Tab 3  ------------------------------------------------------------------------------->

                            <x-tabs.content>

                                <div class="flex flex-col gap-3">

                                    <x-input.floating wire:model="paid_to" :label="'Paid To'"/>

                                    <x-input.floating wire:model="purpose" :label="'Purpose'"/>

                                </div>

                            </x-tabs.content>

                            <!-- Tab 4  ------------------------------------------------------------------------------->

                            <x-tabs.content>

                                <div class="flex flex-col gap-3">

                                    <x-input.floating wire:model="verified_by" :label="'Verified_by'"/>

                                    <x-input.model-date wire:model="verified_on" :label="'Verified_On'"/>

                                </div>

                            </x-tabs.content>

                        </x-slot>
                    </x-tabs.tab-panel>

                </div>
            </div>
        </x-forms.create>

    </x-forms.m-panel>
</div>
