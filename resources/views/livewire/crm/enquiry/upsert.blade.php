<div>
    <x-slot name="header">Enquiry Entry</x-slot>

    <x-forms.m-panel>
        <!--Create Form ----------------------------------------------------------------------------------------------->

            <div class="flex flex-col  gap-3">

                <!-- Party Name --------------------------------------------------------------------------------------->

                <x-dropdown.wrapper label="Party Name" type="contactTyped">
                    <div class="relative ">
                        <x-dropdown.input label="Name" id="contact_name"
                                          wire:model.live.debounce="contact_name"
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
                                    @livewire('controls.model.contact-model',[$contact_name])
                                @endforelse
                            @endif
                        </x-dropdown.select>
                    </div>
                </x-dropdown.wrapper>
                @error('contact_name')
                <span class="text-red-400">{{$message}}</span>@enderror



                <div>
                    <x-input.floating wire:model="common.vname" :label="'Title'"/>
                    @error('common.vname')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>

{{--                -----------------------------------------------------------------------}}
                <div>
                    <x-input.floating wire:model="mobile" :label="'Mobile'"/>
                    @error('mobile')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div>
                    <x-input.floating wire:model="whatsapp" :label="'Whatsapp Number'"/>
                    @error('whatsapp')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div>
                    <x-input.floating wire:model="email" :label="'Mail'"/>
                    @error('email')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>
{{--                ---------------------------------------------------------------------------------------------------}}

                <div>
                    <x-input.rich-text wire:model="body" :placeholder="'Write Your Enquiries'"/>
                    @error('body')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <x-input.model-select wire:model="status_id" :label="'Status'">
                    <option value="">Choose...</option>
                    @foreach(App\Enums\Status::cases() as $status)
                        <option value="{{$status->value}}">{{$status->getName()}}</option>
                    @endforeach
                </x-input.model-select>

            </div>


    </x-forms.m-panel>

    <!-- Save Button area --------------------------------------------------------------------------------------------->
    <x-forms.m-panel-bottom-button wire:model="getRoute" active save back/>
</div>
