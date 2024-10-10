<div>
    <x-slot name="header">Export Sales</x-slot>
    <x-forms.m-panel>
        <x-tabs.tab-panel>
            <x-slot name="tabs">
                <x-tabs.tab>Mandatory</x-tabs.tab>
                <x-tabs.tab>Other Consignee</x-tabs.tab>
            </x-slot>
            <x-slot name="content">
                <x-tabs.content>
                    <section class="grid sm:grid-cols-2 grid-cols-1 sm:gap-5 py-8 sm:space-y-0 space-y-5">

                        <!-- Top Left Area ------------------------------------------------------------------------------------------------>

                        <div class="space-y-5">

                            <!-- Party Name --------------------------------------------------------------------------------------->

                            <x-dropdown.wrapper label="Party Name" type="contactTyped">
                                <div class="relative ">
                                    <x-dropdown.input label="Party Name" id="contact_name"
                                                      wire:model.live="contact_name"
                                                      wire:keydown.arrow-up="decrementContact"
                                                      wire:keydown.arrow-down="incrementContact"
                                                      wire:keydown.enter="enterContact"/>
                                    @error('contact_id')
                                    <span class="text-red-500">{{'The Party Name is Required.'}}</span>
                                    @enderror
                                    <x-dropdown.select>
                                        @if($contactCollection)
                                            @forelse ($contactCollection as $i => $contact)
                                                <x-dropdown.option highlight="{{$highlightContact === $i  }}"
                                                                   wire:click.prevent="setContact('{{$contact->vname}}','{{$contact->id}}')">
                                                    {{ $contact->vname }}
                                                </x-dropdown.option>
                                            @empty
                                                <x-dropdown.new href="{{route('contacts.upsert',['0'])}}"
                                                                label="Party"/>
                                            @endforelse
                                        @endif
                                    </x-dropdown.select>
                                </div>
                            </x-dropdown.wrapper>
                            @error('contact_name')
                            <span class="text-red-400">{{$message}}</span>@enderror

                            <!-- Order No --------------------------------------------------------------------------------------------->

                            @if(\Aaran\Aadmin\Src\SaleEntry::hasOrder())
                                <x-dropdown.wrapper label="Order NO" type="orderTyped">
                                    <div class="relative ">
                                        <x-dropdown.input label="Order NO" id="order_name"
                                                          wire:model.live="order_name"
                                                          wire:keydown.arrow-up="decrementOrder"
                                                          wire:keydown.arrow-down="incrementOrder"
                                                          wire:keydown.enter="enterOrder"/>
                                        @error('order_id')
                                        <span class="text-red-500">{{'The Order is Required.'}}</span>
                                        @enderror
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
                            @endif

                            <x-input.model-select wire:model.live="currency_type" :label="'Currency Type'">
                                <option value="">Choose...</option>
                                @foreach(\App\Enums\CurrencyType::cases() as $currency)
                                    <option value="{{$currency->value}}">{{$currency->getName()}}</option>
                                @endforeach
                            </x-input.model-select>

                            <x-input.floating wire:model.live="ex_rate" :label="'Exchange Rate'"/>

                        </div>

                        <!-- Top Right Area-------------------------------------------------------------------------------------------->

                        <div class="flex flex-col gap-5 ">

                            <x-input.floating wire:model="invoice_no" label="Invoice No"/>

                            <x-input.model-date wire:model="invoice_date" label="Invoice Date"/>

                            <x-input.floating wire:model.live="sales_type" :label="'Sales Type'"/>
                            <!-- Style ------------------------------------------------------------------------------------------------>

                            @if(\Aaran\Aadmin\Src\SaleEntry::hasStyle())

                                <x-dropdown.wrapper label="Style" type="style_name">
                                    <div class="relative ">

                                        <x-dropdown.input label="Style" id="style_name"
                                                          wire:model.live="style_name"
                                                          wire:keydown.arrow-up="decrementStyle"
                                                          wire:keydown.arrow-down="incrementStyle"
                                                          wire:keydown.enter="enterStyle"/>
                                        <x-dropdown.select>

                                            @if($styleCollection)
                                                @forelse ($styleCollection as $i => $style)
                                                    <x-dropdown.option highlight="{{$highlightStyle === $i  }}"
                                                                       wire:click.prevent="setStyle('{{$style->vname}}','{{$style->id}}')">
                                                        {{ $style->vname }}
                                                    </x-dropdown.option>
                                                @empty
                                                    @livewire('controls.model.style-model',[$style_name])
                                                @endforelse
                                            @endif
                                        </x-dropdown.select>

                                    </div>
                                </x-dropdown.wrapper>
                            @endif

                        </div>
                    </section>

                    <x-forms.section-border/>

                    <section class="text-xl font-bold text-orange-400">
                        Sales Item
                    </section>

                    <section class="flex sm:flex-row flex-col  w-full sm:gap-0.5 gap-3">

                        <!--PO/DC  -------------------------------------------------------------------------------------------------------->

                        {{--                        <x-input.floating id="qty" wire:model.live="pkgs_type" label="Pkgs Type"/>--}}
                        <div class="w-full">
                            <x-input.model-select wire:model.live="pkgs_type" :label="'Pkgs Type'">
                                <option value="">Choose...</option>
                                @foreach(\App\Enums\PackageType::cases() as $packageType)
                                    <option value="{{$packageType->value}}">{{$packageType->getName()}}</option>
                                @endforeach
                            </x-input.model-select>
                        </div>
                        <x-input.floating id="dc" wire:model.live="no_of_count" label="No of Count"/>

                        <!--Product Name ---------------------------------------------------------------------------------------------->

                        <x-dropdown.wrapper label="Product Name" type="productTyped">
                            <div class="relative ">
                                <x-dropdown.input label="Product Name" id="product_name"
                                                  wire:model.live="product_name"
                                                  wire:keydown.arrow-up="decrementProduct"
                                                  wire:keydown.arrow-down="incrementProduct"
                                                  wire:keydown.enter="enterProduct"/>
                                <x-dropdown.select>
                                    @if($productCollection)
                                        @forelse ($productCollection as $i => $product)
                                            <x-dropdown.option highlight="{{$highlightProduct === $i  }}"
                                                               wire:click.prevent="setProduct('{{$product->vname}}','{{$product->id}}','{{$product->gstpercent_id}}')">
                                                {{ $product->vname }} &nbsp;-&nbsp; GST&nbsp;:
                                                &nbsp;{{\Aaran\Entries\Models\Sale::commons($product->gstpercent_id)}}
                                                %
                                            </x-dropdown.option>
                                        @empty
                                            @livewire('controls.model.product-model',[$product_name])
                                        @endforelse
                                    @endif
                                </x-dropdown.select>
                            </div>
                        </x-dropdown.wrapper>


                        <!--Product Description --------------------------------------------------------------------------------------->

                        @if(\Aaran\Aadmin\Src\SaleEntry::hasProductDescription())
                            <x-input.floating id="qty" wire:model.live="description" label="description"/>
                        @endif

                        <!--Colour Name ----------------------------------------------------------------------------------------------->

                        @if(\Aaran\Aadmin\Src\SaleEntry::hasColour())

                            <x-dropdown.wrapper label="Colour Name" type="colourTyped">
                                <div class="relative ">
                                    <x-dropdown.input label="Colour Name" id="colour_name"
                                                      wire:model.live="colour_name"
                                                      wire:keydown.arrow-up="decrementColour"
                                                      wire:keydown.arrow-down="incrementColour"
                                                      wire:keydown.enter="enterColour"/>
                                    <x-dropdown.select>
                                        @if($colourCollection)
                                            @forelse ($colourCollection as $i => $colour)
                                                <x-dropdown.option highlight="{{$highlightColour === $i  }}"
                                                                   wire:click.prevent="setColour('{{$colour->vname}}','{{$colour->id}}')">
                                                    {{ $colour->vname }}
                                                </x-dropdown.option>
                                            @empty
                                                <x-dropdown.new wire:click.prevent="colourSave('{{$colour_name}}')"
                                                                label="Colour"/>
                                            @endforelse
                                        @endif
                                    </x-dropdown.select>
                                </div>
                            </x-dropdown.wrapper>
                        @endif

                        <!--Size ------------------------------------------------------------------------------------------------------>

                        @if(\Aaran\Aadmin\Src\SaleEntry::hasSize())
                            <x-dropdown.wrapper label="Size Name" type="sizeTyped">
                                <div class="relative ">
                                    <x-dropdown.input label="Size Name" id="size_name"
                                                      wire:model.live="size_name"
                                                      wire:keydown.arrow-up="decrementSize"
                                                      wire:keydown.arrow-down="incrementSize"
                                                      wire:keydown.enter="enterSize"/>
                                    @error('size_id')
                                    <span class="text-red-500">{{'The Size name is Required.'}}</span>
                                    @enderror
                                    <x-dropdown.select>
                                        @if($sizeCollection)
                                            @forelse ($sizeCollection as $i => $size)
                                                <x-dropdown.option highlight="{{$highlightSize === $i  }}"
                                                                   wire:click.prevent="setSize('{{$size->vname}}','{{$size->id}}')">
                                                    {{ $size->vname }}
                                                </x-dropdown.option>
                                            @empty
                                                <x-dropdown.new wire:click.prevent="sizeSave('{{$size_name}}')"
                                                                label="Size"/>
                                            @endforelse
                                        @endif
                                    </x-dropdown.select>
                                </div>
                            </x-dropdown.wrapper>
                        @endif

                        <!-- Quantity ------------------------------------------------------------------------------------------------->

                        <div class="w-full">
                            <x-input.floating id="qty" wire:model.live="qty" label="Quantity"/>
                        </div>

                        <!-- Price ---------------------------------------------------------------------------------------------------->

                        <div class="w-full">
                            <x-input.floating id="price" wire:model.live="price" label="Price"/>
                        </div>

                        <x-button.add wire:click="addItems"/>

                    </section>

                    <!-- Display Items ----------------------------------------------------------------------------------------------->

                    <section>
                        <div class="py-2 mt-5 overflow-x-auto">

                            <table class="overflow-x-auto md:w-full ">
                                <thead>
                                <tr class="h-8 text-xs bg-gray-100 border border-gray-300">

                                    <th class="w-12 px-2 text-center border border-gray-300">#</th>

                                    <th class="px-2 text-center border border-gray-300">Pkgs Type</th>

                                    <th class="px-2 text-center border border-gray-300">No of Count</th>

                                    <th class="px-2 text-center border border-gray-300">PRODUCT</th>

                                    @if(\Aaran\Aadmin\Src\SaleEntry::hasColour())
                                        <th class="px-2 text-center border border-gray-300">COLOUR</th>
                                    @endif

                                    @if(\Aaran\Aadmin\Src\SaleEntry::hasSize())
                                        <th class="px-2 text-center border border-gray-300">SIZE</th>
                                    @endif

                                    <th class="px-2 text-center border border-gray-300">QTY</th>
                                    <th class="px-2 text-center border border-gray-300">PRICE</th>
                                    <th class="px-2 text-center border border-gray-300">TAXABLE</th>
                                    {{--                                    <th class="px-2 text-center border border-gray-300">GST</th>--}}
                                    {{--                                    <th class="px-2 text-center border border-gray-300">SUBTOTAL</th>--}}
                                    <th class="w-12 px-1 text-center border border-gray-300">ACTION</th>
                                </tr>
                                </thead>

                                <!--Display Table Items ------------------------------------------------------------------------------->
                                <tbody>

                                @if ($itemList)

                                    @foreach($itemList as $index => $row)

                                        <tr class="border border-gray-400 hover:bg-amber-50">
                                            <td class="text-center border border-gray-300 bg-gray-100">
                                                <button class="w-full h-full cursor-pointer"
                                                        wire:click.prevent="changeItems({{$index}})">
                                                    {{$index+1}}
                                                </button>
                                            </td>


                                            <td class="px-2 text-left border border-gray-300 cursor-pointer"
                                                wire:click.prevent="changeItems({{$index}})">{{ \App\Enums\PackageType::tryFrom($row['pkgs_type'])->getName()}}</td>

                                            <td class="px-2 text-left border border-gray-300 cursor-pointer"
                                                wire:click.prevent="changeItems({{$index}})">{{$row['no_of_count']}}</td>

                                            <td class="px-2 text-left border border-gray-300 cursor-pointer"
                                                wire:click.prevent="changeItems({{$index}})">
                                                <div>{{$row['product_name']}}
                                                    @if($row['description'])
                                                        &nbsp;-&nbsp;
                                                    @endif
                                                    @if(\Aaran\Aadmin\Src\SaleEntry::hasProductDescription())
                                                        {{ $row['description']}}
                                                    @endif
                                                </div>

                                            </td>

                                            @if(\Aaran\Aadmin\Src\SaleEntry::hasColour())
                                                <td class="px-2 text-left border border-gray-300 cursor-pointer"
                                                    wire:click.prevent="changeItems({{$index}})">{{$row['colour_name']}}</td>
                                            @endif

                                            @if(\Aaran\Aadmin\Src\SaleEntry::hasSize())
                                                <td class="px-2 text-left border border-gray-300 cursor-pointer"
                                                    wire:click.prevent="changeItems({{$index}})">{{$row['size_name']}}</td>
                                            @endif

                                            <td class="px-2 text-center border border-gray-300 cursor-pointer"
                                                wire:click.prevent="changeItems({{$index}})">{{$row['qty']+0}}</td>
                                            <td class="px-2 text-right border border-gray-300 cursor-pointer"
                                                wire:click.prevent="changeItems({{$index}})">{{$row['price']}}</td>
                                            <td class="px-2 text-right border border-gray-300 cursor-pointer"
                                                wire:click.prevent="changeItems({{$index}})">{{$row['taxable']}}</td>

                                            {{--                                            <td class="px-2 text-right border border-gray-300 cursor-pointer"--}}
                                            {{--                                                wire:click.prevent="changeItems({{$index}})">{{$row['gst_amount']}}</td>--}}
                                            {{--                                            <td class="px-2 text-right border border-gray-300 cursor-pointer"--}}
                                            {{--                                                wire:click.prevent="changeItems({{$index}})">{{$row['subtotal']}}</td>--}}
                                            <td class="text-center border border-gray-300">
                                                <x-button.delete wire:click.prevent="removeItems({{$index}})"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>

                                <!-- Table Bottom ------------------------------------------------------------------------------------->
                                <tfoot class="mt-2">
                                <tr class="h-8 text-sm border border-gray-400 bg-cyan-50">

                                    {{--                                    @if(\Aaran\Aadmin\Src\SaleEntry::hasSize() or \Aaran\Aadmin\Src\SaleEntry::hasColour())--}}
                                    {{--                                        <td colspan="4" class="px-2 text-xs text-right border border-gray-300">&nbsp;TOTALS&nbsp;&nbsp;&nbsp;</td>--}}
                                    {{--                                    @else--}}
                                    {{--                                        <td colspan="2" class="px-2 text-xs text-right border border-gray-300">&nbsp;TOTALS&nbsp;&nbsp;&nbsp;</td>--}}
                                    {{--                                    @endif--}}
                                    <td colspan="6" class="px-2 text-xs text-right border border-gray-300">&nbsp;TOTALS&nbsp;&nbsp;&nbsp;</td>
                                    <td class="px-2 text-center border border-gray-300">{{$total_qty+0}}</td>
                                    <td class="px-2 text-center border border-gray-300">&nbsp;</td>
                                    <td class="px-2 text-right border border-gray-300">{{$total_taxable}}</td>
                                    {{--                                    <td class="px-2 text-center border border-gray-300">&nbsp;</td>--}}
                                    {{--                                    <td class="px-2 text-right border border-gray-300">{{$total_gst}}</td>--}}
                                    {{--                                    <td class="px-2 text-right border border-gray-300">{{$grandtotalBeforeRound}}</td>--}}
                                    <td class="px-2 text-center border border-gray-300">&nbsp;</td>
                                </tr>
                                </tfoot>
                            </table>

                        </div>

                    </section>

                    <x-forms.section-border/>

                    <section class="grid sm:grid-cols-3 grid-cols-1 gap-2 ">
                        <!-- Bottom Left -------------------------------------------------------------------------------------------------->
                        <section class="w-full p-4 space-y-4">
                            <x-input.model-select wire:model.live="pre_carriage" :label="'Pre-Carriage by'">
                                <option value="">Choose...</option>
                                @foreach(\App\Enums\PreCarriage::cases() as $preCarriage)
                                    <option value="{{$preCarriage->value}}">{{$preCarriage->getName()}}</option>
                                @endforeach
                            </x-input.model-select>
                            <x-input.floating wire:model.live="vessel_flight_no" :label="'Vessel/Flight No'"/>
                            <x-input.floating wire:model.live="port_of_discharge" :label="'Port of Discharge'"/>
                            <x-input.floating wire:model.live="additional" :label="'Additional'"/>
                        </section>

                        <section class="w-full mx-2 p-4 space-y-4">
                            <x-input.floating wire:model.live="place_of_Receipt" :label="'Place of Receipt by'"/>
                            <x-input.floating wire:model.live="port_of_loading" :label="'Port of Loading'"/>
                            <x-input.floating wire:model.live="final_destination" :label="'Final Destination'"/>
                        </section>

                        <!-- Bottom Right  -------------------------------------------------------------------------------------------->

                        <section class="hidden sm:flex w-full p-4">
                            <div class="w-full flex justify-between items-center self-start">
                                <div class="w-2/4 space-y-6 ">
                                    <div>Total</div>
                                    <div>IGST INR</div>
                                    <div>Round off</div>
                                    <div class="font-semibold">Total INR</div>
                                </div>
                                <div class="w-1/4 text-center space-y-6 ">
                                    <div>:</div>
                                    <div>:</div>
                                    <div>:</div>
                                    <div>:</div>
                                </div>
                                <div class="w-1/4 text-end space-y-6 ">
                                    <div>{{$total_taxable}}</div>
                                    <div>{{$total_gst }}</div>
                                    <div>{{$round_off}}</div>
                                    <div>{{$grand_total}}</div>
                                </div>
                            </div>

                        </section>

                    </section>

                </x-tabs.content>
                <x-tabs.content>
                    <div class="flex gap-3">
                        <x-dropdown.wrapper label="Party Name" type="consigneeTyped">
                            <div class="relative ">
                                <x-dropdown.input label="Party Name" id="consignee_name"
                                                  wire:model.live="consignee_name"
                                                  wire:keydown.arrow-up="decrementConsignee"
                                                  wire:keydown.arrow-down="incrementConsignee"
                                                  wire:keydown.enter="enterConsignee"/>
                                @error('consignee_id')
                                <span class="text-red-500">{{'The Party Name is Required.'}}</span>
                                @enderror
                                <x-dropdown.select>
                                    @if($consigneeCollection)
                                        @forelse ($consigneeCollection as $i => $consignee)
                                            <x-dropdown.option highlight="{{$highlightConsignee === $i}}"
                                                               wire:click.prevent="setConsignee('{{$consignee->vname}}','{{$consignee->id}}')">
                                                {{ $consignee->vname }}
                                            </x-dropdown.option>
                                        @empty
                                            <x-dropdown.new href="{{route('contacts.upsert',['0'])}}"
                                                            label="Party"/>
                                        @endforelse
                                    @endif
                                </x-dropdown.select>
                            </div>
                        </x-dropdown.wrapper>
                        <x-button.add wire:click="addConsignee"/>
                    </div>
                    <x-forms.section-border/>

                    <section>
                        <div class="py-2 mt-5 overflow-x-auto">

                            <table class="overflow-x-auto md:w-full ">
                                <thead>
                                <tr class="h-8 text-xs bg-gray-100 border border-gray-300">

                                    <th class="w-12 px-2 text-center border border-gray-300">#</th>

                                    <th class="px-2 text-center border border-gray-300">Pkgs Type</th>

                                    <th class="w-12 px-1 text-center border border-gray-300">ACTION</th>
                                </tr>
                                </thead>

                                <!--Display Table Items ------------------------------------------------------------------------------->
                                <tbody>

                                @if ($consigneeList)

                                    @foreach($consigneeList as $index => $row)

                                        <tr class="border border-gray-400 hover:bg-amber-50">
                                            <td class="text-center border border-gray-300 bg-gray-100">
                                                <button class="w-full h-full cursor-pointer"
                                                        wire:click.prevent="changeConsignee({{$index}})">
                                                    {{$index+1}}
                                                </button>
                                            </td>


                                            <td class="px-2 text-left border border-gray-300 cursor-pointer"
                                                wire:click.prevent="changeConsignee({{$index}})">{{$row['contact_name']}}</td>


                                            <td class="text-center border border-gray-300">
                                                <x-button.delete wire:click.prevent="removeConsignee({{$index}})"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>

                        </div>

                    </section>

                </x-tabs.content>
            </x-slot>
        </x-tabs.tab-panel>
    </x-forms.m-panel>
    @if( $common->vid != "")
        <x-forms.m-panel-bottom-button routes="{{ route('exportsales', [$this->common->vid])}}" save back print/>
    @else
        <x-forms.m-panel-bottom-button save back/>
    @endif
</div>
