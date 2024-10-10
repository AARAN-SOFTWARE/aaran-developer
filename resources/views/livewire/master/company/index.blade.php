<div>
    <x-slot name="header">Company</x-slot>

    <x-forms.m-panel>

        <!-- Top Controls --------------------------------------------------------------------------------------------->

        <x-forms.top-controls :show-filters="$showFilters"/>

        <!-- Top Controls --------------------------------------------------------------------------------------------->

        <x-table.caption :caption="'Company'">
            {{$list->count()}}
        </x-table.caption>

        <!-- Table Header --------------------------------------------------------------------------------------------->

        <x-table.form>
            <x-slot:table_header name="table_header" class="bg-green-600">

                <x-table.header-serial width="20%"/>

                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Company&nbsp;Name
                </x-table.header-text>

                <x-table.header-text sortIcon="none">GST</x-table.header-text>

                <x-table.header-text sortIcon="none">Mobile</x-table.header-text>

                <x-table.header-text sortIcon="none">Address</x-table.header-text>


                <x-table.header-action/>
            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)
                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                        <x-table.cell-text left>{{$row->vname}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->gstin}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->mobile}}</x-table.cell-text>
                        <x-table.cell-text left>{{$row->address_1}}</x-table.cell-text>
                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach

            </x-slot:table_body>

        </x-table.form>

        <x-modal.delete/>

        <div class="pt-5">{{ $list->links() }}</div>

        <!-- Create --------------------------------------------------------------------------------------------------->

        <x-forms.create :id="$common->vid" :max-width="'6xl'">
            <div class="h-[38rem]">

                <!-- Tab Header --------------------------------------------------------------------------------------->

                <x-tabs.tab-panel>

                    <x-slot name="tabs">
                        <x-tabs.tab>Mandatory</x-tabs.tab>
                        <x-tabs.tab>Address</x-tabs.tab>
                        <x-tabs.tab>Logo</x-tabs.tab>
                        <x-tabs.tab>Bank</x-tabs.tab>
                        <x-tabs.tab>Detailing</x-tabs.tab>
                    </x-slot>

                    <x-slot name="content">

                        <!-- Tab 1 ------------------------------------------------------------------------------------>

                        <x-tabs.content>
                            <div class="flex flex-col gap-3" >
                                <x-input.floating wire:model.live="common.vname" label="Name"/>
                                @error('common.vname')
                                <span class="text-red-400">{{$message}}</span>
                                @enderror
                                <x-input.floating wire:model="display_name" label="Display-name"/>
                                <x-input.floating wire:model="mobile" label="Mobile"/>
                                <x-input.floating wire:model="landline" label="Landline"/>
                                <x-input.floating wire:model.live="gstin" label="GSTin"/>
                                @error('gstin')
                                <span class="text-red-400">{{$message}}</span>
                                @enderror
                                <x-input.floating wire:model="pan" label="Pan"/>
                                <x-input.floating wire:model="email" label="Email"/>
                                <x-input.floating wire:model="website" label="Website"/>
                            </div>
                        </x-tabs.content>

                        <!-- Tab 2 ------------------------------------------------------------------------------------>

                        <x-tabs.content>
                            <div class="flex flex-col gap-3">
                                <x-input.floating wire:model.live="address_1" label="Address" />
                                @error('address_1')
                                <span class="text-red-400">{{$message}}</span>
                                @enderror
                                <x-input.floating wire:model.live="address_2" label="Area-Road" />
                                @error('address_2')
                                <span class="text-red-400">{{$message}}</span>
                                @enderror

                                <!-- City ----------------------------------------------------------------------------->

                                <x-dropdown.wrapper label="City" type="cityTyped">
                                    <div class="relative ">
                                        <x-dropdown.input label="City" id="city_name"
                                                          wire:model.live="city_name"
                                                          wire:keydown.arrow-up="decrementCity"
                                                          wire:keydown.arrow-down="incrementCity"
                                                          wire:keydown.enter="enterCity"/>
                                        <x-dropdown.select>
                                            @if($cityCollection)
                                                @forelse ($cityCollection as $i => $city)
                                                    <x-dropdown.option highlight="{{$highlightCity === $i  }}"
                                                                       wire:click.prevent="setCity('{{$city->vname}}','{{$city->id}}')">
                                                        {{ $city->vname }}
                                                    </x-dropdown.option>
                                                @empty
                                                    <x-dropdown.create  wire:click.prevent="citySave('{{$city_name}}')" label="City" />
                                                @endforelse
                                            @endif
                                        </x-dropdown.select>
                                    </div>
                                </x-dropdown.wrapper>
                                @error('city_name')
                                <span class="text-red-400">{{$message}}</span>
                                @enderror

                                <!-- State ---------------------------------------------------------------------------->

                                <x-dropdown.wrapper label="State" type="stateTyped">
                                    <div class="relative ">
                                        <x-dropdown.input label="State" id="state_name"
                                                          wire:model.live="state_name"
                                                          wire:keydown.arrow-up="decrementState"
                                                          wire:keydown.arrow-down="incrementState"
                                                          wire:keydown.enter="enterState"/>
                                        <x-dropdown.select>
                                            @if($stateCollection)
                                                @forelse ($stateCollection as $i => $states)
                                                    <x-dropdown.option highlight="{{$highlightState === $i  }}"
                                                                       wire:click.prevent="setState('{{$states->vname}}','{{$states->id}}')">
                                                        {{ $states->vname }}
                                                    </x-dropdown.option>
                                                @empty
                                                    <x-dropdown.create wire:click.prevent="stateSave('{{ $state_name }}')" label="State" />
                                                @endforelse
                                            @endif
                                        </x-dropdown.select>
                                    </div>
                                </x-dropdown.wrapper>

                                @error('state_name')
                                <span class="text-red-400">{{$message}}</span>
                                @enderror
                                <!-- Pin-code ------------------------------------------------------------------------->

                                <x-dropdown.wrapper label="Pincode" type="pincodeTyped">
                                    <div class="relative ">
                                        <x-dropdown.input label="Pincode" id="pincode_name"
                                                          wire:model.live="pincode_name"
                                                          wire:keydown.arrow-up="decrementPincode"
                                                          wire:keydown.arrow-down="incrementPincode"
                                                          wire:keydown.enter="enterPincode"/>
                                        <x-dropdown.select>
                                            @if($pincodeCollection)
                                                @forelse ($pincodeCollection as $i => $pincode)
                                                    <x-dropdown.option highlight="{{$highlightPincode === $i  }}"
                                                                       wire:click.prevent="setPincode('{{$pincode->vname}}','{{$pincode->id}}')">
                                                        {{ $pincode->vname }}
                                                    </x-dropdown.option>
                                                @empty
                                                    <x-dropdown.create wire:click.prevent="pincodeSave('{{$pincode_name}}')" label="Pincode" />
                                                @endforelse
                                            @endif
                                        </x-dropdown.select>
                                    </div>
                                </x-dropdown.wrapper>
                                @error('pincode_name')
                                <span class="text-red-400">{{$message}}</span>
                                @enderror
                            </div>
                        </x-tabs.content>

                        <!-- Tab 3 ------------------------------------------------------------------------------------>

                        <x-tabs.content>
                            <div class="flex flex-col py-2">
                                <label for="bg_image"
                                       class="w-full text-zinc-500 tracking-wide pb-4 px-2">Company Logo</label>

                                <div class="flex flex-wrap sm:gap-6 gap-2">
                                    <div class="flex-shrink-0">
                                        <div>
                                            @if($logo)
                                                <div
                                                    class=" flex-shrink-0 bg-blue-100 p-1 rounded-lg overflow-hidden">
                                                    <img
                                                        class="w-[156px] h-[89px] rounded-lg hover:brightness-110 hover:scale-105 duration-300 transition-all ease-out"
                                                        src="{{ $logo->temporaryUrl() }}"
                                                        alt="{{$logo?:''}}"/>
                                                </div>
                                            @endif

                                            @if(!$logo && isset($logo))
                                                <img class="h-24 w-full"
                                                     src="{{URL(\Illuminate\Support\Facades\Storage::url('images/'.$old_logo))}}"
                                                     alt="">
                                            @else
                                                <x-icons.icon :icon="'logo'" class="w-auto h-auto block "/>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="relative">
                                        <div>
                                            <label for="bg_image"
                                                   class="text-gray-500 font-semibold text-base rounded flex flex-col items-center
                                   justify-center cursor-pointer border-2 border-gray-300 border-dashed p-2
                                   mx-auto font-[sans-serif]">
                                                <x-icons.icon icon="cloud-upload" class="w-8 h-auto block text-gray-400"/>
                                                Upload Photo
                                                <input type="file" id='bg_image' wire:model="logo" class="hidden"/>
                                                <p class="text-xs font-light text-gray-400 mt-2">PNG and JPG are
                                                    Allowed.</p>
                                            </label>
                                        </div>

                                        <div wire:loading wire:target="logo" class="z-10 absolute top-6 left-12">
                                            <div class="w-14 h-14 rounded-full animate-spin
                                                        border-y-4 border-dashed border-green-500 border-t-transparent"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </x-tabs.content>

                        <!-- Tab 4 ------------------------------------------------------------------------------------>

                        <x-tabs.content>
                            <div class="flex flex-col gap-3">

                                <!-- Bank Details --------------------------------------------------------------------->

                                <x-input.floating wire:model="acc_no" label="Account No" />
                                <x-input.floating wire:model="ifsc_code" label="IFSC Code" />
                                <x-input.floating wire:model="bank" label="Bank" />
                                <x-input.floating wire:model="branch" label="Branch" />
                            </div>
                        </x-tabs.content>

                        <!-- Tab 5 ------------------------------------------------------------------------------------>

                        <x-tabs.content>

                            <div class="flex flex-col gap-3">
                                <x-input.floating wire:model="msme_no" label="MSME No" />

                                <x-dropdown.wrapper label="MSME Type" type="MsmeTypeTyped">
                                    <div class="relative ">
                                        <x-dropdown.input label="MSME Type" id="msme_type_name"
                                                          wire:model.live="msme_type_name"
                                                          wire:keydown.arrow-up="decrementMsmeType"
                                                          wire:keydown.arrow-down="incrementMsmeType"
                                                          wire:keydown.enter="enterMsmeType"/>
                                        <x-dropdown.select>
                                            @if($msmeTypeCollection)
                                                @forelse ($msmeTypeCollection as $i => $msmeType)
                                                    <x-dropdown.option highlight="{{$highlightMsmeType === $i  }}"
                                                                       wire:click.prevent="setMsmeType('{{$msmeType->vname}}','{{$msmeType->id}}')">
                                                        {{ $msmeType->vname }}
                                                    </x-dropdown.option>
                                                @empty
                                                    <x-dropdown.create wire:click.prevent="msmeTypeSave('{{$msme_type_name}}')"
                                                                       label="Msme Type"/>
                                                @endforelse
                                            @endif
                                        </x-dropdown.select>
                                    </div>
                                </x-dropdown.wrapper>

{{--                                <x-input.floating wire:model="msme_type" label="MSME Type" />--}}
                            </div>
                        </x-tabs.content>

                    </x-slot>

                </x-tabs.tab-panel>
            </div>
        </x-forms.create>

    </x-forms.m-panel>
</div>
