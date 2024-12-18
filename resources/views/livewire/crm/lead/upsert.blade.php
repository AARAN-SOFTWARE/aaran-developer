<div>
    <x-slot name="header">Additional Information</x-slot>

    <!-- Top Controls ------------------------------------------------------------------------------------------------>

    <x-forms.m-panel>

        <div class="w-full lg:flex-row flex flex-col sm:gap-8 gap-4">
            <!-- Left area -------------------------------------------------------------------------------->
            <div class="w-full flex space-y-4 justify-evenly py-12">
                <div class="space-y-5">
                    <div>
                        <x-input.floating wire:model="title" :label="'Title'"/>
                        @error('title')
                        <div class="text-xs text-red-500">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <x-input.model-select wire:model="lead_id" :label="'Lead By'">
                        <option value="">Choose...</option>
                        @foreach(\App\Models\User::all() as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </x-input.model-select>

                    <div>
                        <x-input.rich-text :placeholder="'Description'" wire:model="body"/>
                        @error('body')
                        <div class="text-xs text-red-500">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    {{--                <x-input.model-select wire:model="status_id" :label="'Status'">--}}
                    {{--                    <option value="">Choose...</option>--}}
                    {{--                    @foreach(App\Enums\Status::cases() as $status)--}}
                    {{--                        <option value="{{$status->value}}">{{$status->getName()}}</option>--}}
                    {{--                    @endforeach--}}
                    {{--                </x-input.model-select>--}}

                    <x-dropdown.wrapper label="Software Type" type="softwareType">
                        <div class="relative">
                            <x-dropdown.input label="Software Type" id="softwareType_name"
                                              wire:model.live="softwareType_name"
                                              wire:keydown.arrow-up="decrementSoftwareType"
                                              wire:keydown.arrow-down="incrementSoftwareType"
                                              wire:keydown.enter="enterSoftwareType"/>
                            <x-dropdown.select>
                                @if($softwareTypeCollection)
                                    @forelse ($softwareTypeCollection as $i => $softwareType)
                                        <x-dropdown.option highlight="{{$highlightSoftwareType === $i}}"
                                                           wire:click.prevent="setSoftwareType('{{$softwareType->vname}}','{{$softwareType->id}}')">
                                            {{ $softwareType->vname }}
                                        </x-dropdown.option>
                                    @empty
                                        <x-dropdown.create
                                            wire:click.prevent="softwareTypeSave('{{$softwareType_name}}')"
                                            label="Software Type"/>
                                    @endforelse
                                @endif
                            </x-dropdown.select>
                        </div>
                    </x-dropdown.wrapper>
                    @error('software_type_name')
                    <span class="text-red-400">{{$message}}</span>
                    @enderror

                    <x-input.model-select wire:model="verified_by" :label="'Verified By'">
                        <option value="">Choose...</option>
                        @foreach(\App\Models\User::all() as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </x-input.model-select>
                </div>

                <div>
                <!-- Questions Section -->
                <div class="space-y-4 border rounded-lg p-4">
                    <label class="block text-lg font-semibold">Questions</label>

                    <!-- Question 1 -->
                    <div>
                        <label for="question1" class="block text-sm font-medium">1. How are you currently managing your
                            billing process?</label>
                        <input type="text" id="question1" wire:model="questions.question1" class="form-input w-full">
                        @error('questions.question1')
                        <span class="text-xs text-red-500">{{$message}}</span>
                        @enderror
                    </div>

                    <!-- Question 2 -->
                    <div>
                        <label for="question2" class="block text-sm font-medium">2. Are you using any software for
                            billing, or it is managed manually?</label>
                        <input type="text" id="question2" wire:model="questions.question2" class="form-input w-full">
                        @error('questions.question2')
                        <span class="text-xs text-red-500">{{$message}}</span>
                        @enderror
                    </div>


                    <!-- Question 3 -->
                    <div>
                        <label for="question3" class="block text-sm font-medium">3. What features do you need in your
                            billing system?[Ex. Automated Invoicing, Tax Calculations, Payment Tracking]</label>
                        <textarea id="question3" wire:model="questions.question3" rows="2"
                                  class="form-textarea w-full"></textarea>
                        @error('questions.question3')
                        <span class="text-xs text-red-500">{{$message}}</span>
                        @enderror
                    </div>

                    <!-- Question 4 -->
                    <div>
                        <label for="question4" class="block text-sm font-medium">4. How Many users will need to access
                            to the software?</label>
                        <input type="text" id="question4" wire:model="questions.question4" class="form-input w-full">
                        @error('questions.question4')
                        <span class="text-xs text-red-500">{{$message}}</span>
                        @enderror
                    </div>

                    <!-- Question 5 -->
                    <div>
                        <label for="question5" class="block text-sm font-medium">5. Do you need support for multiple
                            currencies?</label>
                        <input type="text" id="question5" wire:model="questions.question5" class="form-input w-full">
                        @error('questions.question5')
                        <span class="text-xs text-red-500">{{$message}}</span>
                        @enderror
                    </div>

                    <!-- Question 6 -->
                    <div>
                        <label for="question6" class="block text-sm font-medium">6. What is your Budget?</label>
                        <input type="text" id="question6" wire:model="questions.question6" class="form-input w-full">
                        @error('questions.question6')
                        <span class="text-xs text-red-500">{{$message}}</span>
                        @enderror
                    </div>

                    <!-- Question 7 -->
                    <div>
                        <label for="question7" class="block text-sm font-medium">7.Do you want implement immediately or
                            Timeline?</label>
                        <input type="text" id="question7" wire:model="questions.question7" class="form-input w-full">
                        @error('questions.question7')
                        <span class="text-xs text-red-500">{{$message}}</span>
                        @enderror
                    </div>

                    <!-- Add more questions as needed -->
                </div>

                <!-- Verified By -->
                </div>

            </div>
        </div>
    </x-forms.m-panel>

    <!-- Save Button area --------------------------------------------------------------------------------------------->
    <x-forms.m-panel-bottom-button active save back/>
</div>
