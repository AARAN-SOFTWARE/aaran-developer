<div>
    <x-slot name="header">Products</x-slot>

    <x-forms.m-panel>

        <!-- Top Controls --------------------------------------------------------------------------------------------->

        <x-forms.top-controls :show-filters="$showFilters"/>

        <x-table.caption :caption="'Products'">
            {{$list->count()}}
        </x-table.caption>

        <!-- Table Header --------------------------------------------------------------------------------------------->

        <x-table.form>

            <x-slot:table_header name="table_header" class="bg-green-100">

                <x-table.header-serial width="20%"/>

                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">Product
                </x-table.header-text>

                <x-table.header-text sortIcon="none">Product&nbsp;Type</x-table.header-text>

                <x-table.header-text sortIcon="none">HSN&nbsp;Code</x-table.header-text>
                <x-table.header-text sortIcon="none">Gst&nbsp;Percent</x-table.header-text>
                <x-table.header-text sortIcon="none">Opening&nbsp;qty</x-table.header-text>

                <x-table.header-action/>

            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                        <x-table.cell-text left>{{$row->vname}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->producttype_name}}</x-table.cell-text>
                        <x-table.cell-text>
                            {{  $row->hsncode_name }}
                        </x-table.cell-text>
                        <x-table.cell-text>{{  $row->gstpercent_name }}%
                        </x-table.cell-text>
                        <x-table.cell-text>{{$row->initial_quantity+0}}</x-table.cell-text>
                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>

                @endforeach

            </x-slot:table_body>
        </x-table.form>

        <x-modal.delete/>

        <div class="pt-5">{{ $list->links() }}</div>

        <!-- Create  -------------------------------------------------------------------------------------------------->

        <x-forms.create :id="$common->vid">

            <div class="flex flex-col gap-3">

                <!-- Product ------------------------------------------------------------------------------------------>

                <x-input.floating wire:model.live="common.vname" label="Product Name"/>
                @error('common.vname')
                <span class="text-red-400">{{$message}}</span>
                @enderror

                <x-dropdown.wrapper label="Product Type" type="producttypeTyped">

                    <div class="relative">
                        <x-dropdown.input label="Product Type" id="producttype_name"
                                          wire:model.live="producttype_name"
                                          wire:keydown.arrow-up="decrementProductType"
                                          wire:keydown.arrow-down="incrementProductType"
                                          wire:keydown.enter="enterProductType"/>

                        <x-dropdown.select>
                            @if($producttypeCollection)
                                @forelse ($producttypeCollection as $i => $producttype)

                                    <x-dropdown.option highlight="{{$highlightProductType === $i  }}"
                                                       wire:click.prevent="setProductType('{{$producttype->vname}}','{{$producttype->id}}')">
                                        {{ $producttype->vname }}
                                    </x-dropdown.option>

                                @empty
                                    <x-dropdown.new wire:click.prevent="productTypeSave('{{$producttype_name}}')"
                                                    label="Product"/>
                                @endforelse
                            @endif

                        </x-dropdown.select>
                    </div>
                </x-dropdown.wrapper>


                <!-- HSN Code ----------------------------------------------------------------------------------------->

                <x-dropdown.wrapper label="HSN Code" type="hsncodeTyped">

                    <div class="relative">

                        <x-dropdown.input label="HSN Code" id="hsncode_name"
                                          wire:model.live="hsncode_name"
                                          wire:keydown.arrow-up="decrementHsncode"
                                          wire:keydown.arrow-down="incrementHsncode"
                                          wire:keydown.enter="enterHsncode"/>

                        <x-dropdown.select>
                            @if($hsncodeCollection)

                                @forelse ($hsncodeCollection as $i => $hsncode)
                                    <x-dropdown.option highlight="{{$highlightHsncode === $i  }}"
                                                       wire:click.prevent="setHsncode('{{$hsncode->vname}}','{{$hsncode->id}}')">
                                        {{ $hsncode->vname }}
                                    </x-dropdown.option>

                                @empty
                                    <x-dropdown.new wire:click.prevent="hsncodeSave('{{$hsncode_name}}')"
                                                    label="HSN Code"/>
                                @endforelse
                            @endif

                        </x-dropdown.select>
                    </div>
                </x-dropdown.wrapper>
                @error('hsncode_name')
                <span class="text-red-400">{{$message}}</span>
                @enderror

                <!-- Unit Type ---------------------------------------------------------------------------------------->

                <x-dropdown.wrapper label="Unit" type="unitTyped">
                    <div class="relative ">
                        <x-dropdown.input label="Unit" id="unit_name"
                                          wire:model.live="unit_name"
                                          wire:keydown.arrow-up="decrementUnit"
                                          wire:keydown.arrow-down="incrementUnit"
                                          wire:keydown.enter="enterUnit"/>
                        <x-dropdown.select>
                            @if($unitCollection)
                                @forelse ($unitCollection as $i => $unit)
                                    <x-dropdown.option highlight="{{$highlightUnit === $i  }}"
                                                       wire:click.prevent="setUnit('{{$unit->vname}}','{{$unit->id}}')">
                                        {{ $unit->vname }}
                                    </x-dropdown.option>
                                @empty
                                    <x-dropdown.new wire:click.prevent="unitSave('{{$unit_name}}')" label="Units"/>
                                @endforelse
                            @endif
                        </x-dropdown.select>
                    </div>
                </x-dropdown.wrapper>
                @error('unit_name')
                <span class="text-red-400">{{$message}}</span>
                @enderror

                <!-- GST Percent -------------------------------------------------------------------------------------->

                <x-dropdown.wrapper label="GST Percent" type="gstpercentTyped">
                    <div class="relative ">
                        <x-dropdown.input label="GST Percent" id="gstpercent_name"
                                          wire:model.live="gstpercent_name"
                                          wire:keydown.arrow-up="decrementGstPercent"
                                          wire:keydown.arrow-down="incrementGstPercent"
                                          wire:keydown.enter="enterGstPercent"/>
                        <x-dropdown.select>
                            @if($gstpercentCollection)
                                @forelse ($gstpercentCollection as $i => $gstpercent)
                                    <x-dropdown.option highlight="{{$highlightGstPercent === $i}}"
                                                       wire:click.prevent="setGstPercent('{{$gstpercent->vname}}','{{$gstpercent->id}}')">
                                        {{ $gstpercent->vname }}
                                    </x-dropdown.option>
                                @empty
                                    <x-dropdown.new wire:click.prevent="gstPercentSave('{{$gstpercent_name}}')"
                                                    label="GST Percent"/>
                                @endforelse
                            @endif

                        </x-dropdown.select>
                        @error('gstpercent_name')
                        <span class="text-red-400">{{$message}}</span>
                        @enderror
                    </div>
                </x-dropdown.wrapper>
                <x-input.floating wire:model="quantity" label="Opening Quantity"/>
                <x-input.floating wire:model="price" label="Opening Price"/>
            </div>

        </x-forms.create>

    </x-forms.m-panel>
</div>
