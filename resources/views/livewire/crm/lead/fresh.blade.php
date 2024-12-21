<div>
    <x-slot name="header">Leads</x-slot>

    <!-- Card ---------------->

    <div
        class="flex flex-col max-w-xl p-5 mx-auto space-y-5 text-sm border rounded-lg shadow h-50 bg-zinc-50 justify-evenly font-lex">
        <div class="flex justify-between text-2xl">
            <div class="w-full">Contact Name</div>
            <div wire:model="contactName" class="w-full">{{$enquiry_data->contact_person}}</div>
        </div>

        <div class="flex justify-between">
            <div class="w-full">Mobile</div>
            <div wire:model="mobile" class="w-full text-gray-500 ">{{$enquiry_data->vname}}</div>
        </div>
    </div>

    <!-- Button 1 -> Additional Information-->

    <div class="flex justify-between mt-4 sm:justify-center">
        <div class="self-end">
            <button wire:click="createAddInfo"
                    class="tab-button px-6 py-[7px]   relative rounded group overflow-hidden font-medium bg-blue-500 inline-block text-center">
                <span
                    class="absolute top-0 left-0 flex w-0 h-full mr-0 transition-all duration-500 ease-out transform translate-x-0 bg-blue-600 group-hover:w-full opacity-90 "></span>
                <span class="relative text-sm text-white group-hover:hidden sm:text-lg">
               Add Additional Information
            </span>
                <span
                    class="relative hidden group-hover:block group-hover:text-white sm:px-[7px] px-[3px] sm:py-[2px] py-[0]">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="size-6">
                    <path fill-rule="evenodd"
                          d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                          clip-rule="evenodd"/>
                    </svg>
            </span>
            </button>
        </div>
    </div>


    <!-- Button 2 -> Attempt-->
    <div class="flex flex-col gap-6 py-4 sm:flex-row sm:justify-between sm:items-center print:hidden">
        <div class="flex justify-between sm:justify-center">
            {{--            <x-forms.per-page/>--}}
            <div class="self-end">
                <button wire:click="createAttempt"
                        class="tab-button px-6 py-[7px]   relative rounded group overflow-hidden font-medium bg-green-500 inline-block text-center">
                <span
                    class="absolute top-0 left-0 flex w-0 h-full mr-0 transition-all duration-500 ease-out transform translate-x-0 bg-green-600 group-hover:w-full opacity-90 "></span>
                    <span class="relative text-sm text-white group-hover:hidden sm:text-lg">
               Add Attempt
            </span>
                    <span
                        class="relative hidden group-hover:block group-hover:text-white sm:px-[7px] px-[3px] sm:py-[2px] py-[0]">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="size-6">
                    <path fill-rule="evenodd"
                          d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                          clip-rule="evenodd"/>
                    </svg>
            </span>
                </button>
            </div>
        </div>
    </div>

    <!-- Back Button-->
    <div class="justify-end hidden mb-2 lg:flex">
        <a href="{{ route('enquiries') }}"
           class="relative inline-flex items-center gap-1 mr-2 text-lg transition-colors duration-300 hover:text-blue-500">
            <x-icons.icon-fill :iconfill="'chevron-d-left'" class="w-5 h-5"></x-icons.icon-fill>
            Back
        </a>
    </div>
    <x-forms.m-panel>


        <!--Additional Information Table-->
        <div class="text-blue-500">Additional Information</div>
        <!-- Table Header  ------------------------------------------------------------------------------------------>
        <x-table.form>

            <x-slot:table_header name="table_header" class="bg-green-100">


                <x-table.header-serial></x-table.header-serial>
                <x-table.header-text sort-icon="none">Title</x-table.header-text>
                <x-table.header-text sort-icon="none">Lead By</x-table.header-text>
                <x-table.header-text sort-icon="none">Description</x-table.header-text>
                <x-table.header-text sort-icon="none">Software Type</x-table.header-text>
                <x-table.header-text sort-icon="none">Questions</x-table.header-text>
                <x-table.header-text sort-icon="none">Verified By</x-table.header-text>

                <x-table.header-action/>

            </x-slot:table_header>

            <!-- Table Body  - Add Info------------------------------------------------------------------------------------------>

            <x-slot:table_body name="table_body">

                @foreach($leadList as $index=>$rw)

                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>


                        <x-table.cell-text>
                            <a href="{{route('followups', $rw->id)}}">{{$rw->title}}</a>
                        </x-table.cell-text>


                        <x-table.cell-text>
                            {{$rw->lead->name}}
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <div class="line-clamp-1">
                                {!! $rw->body !!}
                            </div>
                        </x-table.cell-text>


                        <x-table.cell-text>
                            {{$rw->softwareType->vname}}
                        </x-table.cell-text>

                        <x-table.cell-text>
                            {{$rw->questions}}
                        </x-table.cell-text>

                        <x-table.cell-text>
                            {{$rw->verified->name}}
                        </x-table.cell-text>


                        <td>
                            <div class="flex items-center self-center justify-center gap-2 px-1 sm:gap-4">
{{--                                <a href="{{route('leads.upsert',[$rw->id])}}" class="pt-1">--}}
                                    <x-button.edit wire:click="editAddInfo({{$rw->id}})" />
{{--                                </a>--}}
                                <x-button.delete wire:click="getDeleteAddInfo({{$rw->id}})"/>

                            </div>
                        </td>
                    </x-table.row>
                @endforeach
            </x-slot:table_body>
        </x-table.form>

        {{--        delete modal of AddInfo.    --}}
        <x-modal.confirmation wire:model.defer="showDeleteModalAddInfo">
            <x-slot name="title">Delete Entry</x-slot>
            <x-slot name="content">
                <div class="py-8 text-cool-gray-700 ">Are you sure you? This action is irreversible.</div>
            </x-slot>
            <x-slot name="footer">
                <div class="flex justify-end gap-5 ">
                    <x-button.cancel-x wire:click.prevent="$set('showDeleteModalAddInfo', false)"/>
                    <x-button.danger-x wire:click.prevent="trashDataAddInfo($id)"/>
                </div>
            </x-slot>
        </x-modal.confirmation>

        <!-- Create  -------------------------------------------------------------------------------------------------->


        <!--Table For Add Attempt-->
        <div class="text-blue-500">Attempts</div>
        <x-table.form>

            <x-slot:table_header name="table_header" class="bg-green-100">

                <x-table.header-text sort-icon="none">Attempt No</x-table.header-text>
                <x-table.header-text sort-icon="none">Lead By</x-table.header-text>
                <x-table.header-text sort-icon="none">Description</x-table.header-text>
                <x-table.header-text sort-icon="none">Status</x-table.header-text>
                <x-table.header-text sort-icon="none">Verified By</x-table.header-text>
                <x-table.header-action/>

            </x-slot:table_header>

            <!-- Table Body  ------------------------------------------------------------------------------------------>

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>


                        <x-table.cell-text>
                            {{$row->attempt_no}}
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <div class="line-clamp-1">
                                {!! $row->lead->name !!}
                            </div>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            {!! $row->body !!}
                        </x-table.cell-text>

                        <x-table.cell-text class="{{App\Enums\Status::tryFrom($row->status_id)->getStyle()}}" center>
                            {{App\Enums\Status::tryFrom($row->status_id)->getName()}}
                        </x-table.cell-text>

                        <x-table.cell-text>
                            {{$row->verified->name}}
                        </x-table.cell-text>


                        <td>
                            <div class="flex items-center self-center justify-center gap-2 px-1 sm:gap-4">

                                <x-button.edit wire:click="editAttempt({{$row->id}})"/>

                                <x-button.delete wire:click="getDeleteAttempt({{$row->id}})"/>

                            </div>
                        </td>
                    </x-table.row>
                @endforeach

            </x-slot:table_body>

        </x-table.form>

        <!--Add Info Modal-------------------------------------------------------------------------------------------------->
        <form wire:submit.prevent="saveAddInfo">
            <div class="w-full h-auto">
                <x-jet.modal :maxWidth="'6xl'" wire:model.defer="showAddInfoEditModal">

                    <div class="px-2 pt-4 sm:px-6">
                        <div class="text-lg">
                            Additional Information Entry
                        </div>
                        <x-forms.section-border class="py-2"/>
                        <div class="p-16 flex justify-between gap-x-5">

                            <div class="space-y-5 py-5 flex flex-col justify-between">
                                <div>
                                    <x-input.floating wire:model="a_title" :label="'Title'"/>
                                    @error('a_title')
                                    <div class="text-xs text-red-500">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div>
                                    <x-input.model-select wire:model="a_lead_id" :label="'Lead By'">
                                        <option value="">Choose...</option>
                                        @foreach(\App\Models\User::all() as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </x-input.model-select>
                                </div>

                                <div class="mt-3">
                                    <x-input.rich-text :placeholder="'Description'" wire:model="a_body"/>
                                    @error('a_body')
                                    <div class="text-xs text-red-500">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

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
                                <div class="">
                                    <x-input.model-select wire:model="a_verified_by" :label="'Verified By'">
                                        <option value="">Choose...</option>
                                        @foreach(\App\Models\User::all() as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </x-input.model-select>
                                </div>
                            </div>

                            <!-- Questions Section -->
                            <div class="space-y-5 py-5">
                                <div class="p-4 space-y-4 border rounded-lg">
                                    <label class="block text-lg font-semibold">Questions</label>

                                    <!-- Question 1 -->
                                    <div>
                                        <label for="question1" class="block text-sm font-medium">1. How are you
                                            currently
                                            managing your
                                            billing process?</label>
                                        <input type="text" id="question1" wire:model="questions.question1"
                                               class="w-full form-input">
                                        @error('questions.question1')
                                        <span class="text-xs text-red-500">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <!-- Question 2 -->
                                    <div>
                                        <label for="question2" class="block text-sm font-medium">2. Are you using any
                                            software for
                                            billing, or it is managed manually?</label>
                                        <input type="text" id="question2" wire:model="questions.question2"
                                               class="w-full form-input">
                                        @error('questions.question2')
                                        <span class="text-xs text-red-500">{{$message}}</span>
                                        @enderror
                                    </div>


                                    <!-- Question 3 -->
                                    <div>
                                        <label for="question3" class="block text-sm font-medium">3. What features do you
                                            need in your
                                            billing system?[Ex. Automated Invoicing, Tax Calculations, Payment
                                            Tracking]</label>
                                        <textarea id="question3" wire:model="questions.question3" rows="2"
                                                  class="w-full form-textarea"></textarea>
                                        @error('questions.question3')
                                        <span class="text-xs text-red-500">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <!-- Question 4 -->
                                    <div>
                                        <label for="question4" class="block text-sm font-medium">4. How Many users will
                                            need
                                            to access
                                            to the software?</label>
                                        <input type="text" id="question4" wire:model="questions.question4"
                                               class="w-full form-input">
                                        @error('questions.question4')
                                        <span class="text-xs text-red-500">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <!-- Question 5 -->
                                    <div>
                                        <label for="question5" class="block text-sm font-medium">5. Do you need support
                                            for
                                            multiple
                                            currencies?</label>
                                        <input type="text" id="question5" wire:model="questions.question5"
                                               class="w-full form-input">
                                        @error('questions.question5')
                                        <span class="text-xs text-red-500">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <!-- Question 6 -->
                                    <div>
                                        <label for="question6" class="block text-sm font-medium">6. What is your
                                            Budget?</label>
                                        <input type="text" id="question6" wire:model="questions.question6"
                                               class="w-full form-input">
                                        @error('questions.question6')
                                        <span class="text-xs text-red-500">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <!-- Question 7 -->
                                    <div>
                                        <label for="question7" class="block text-sm font-medium">7.Do you want implement
                                            immediately or
                                            Timeline?</label>
                                        <input type="text" id="question7" wire:model="questions.question7"
                                               class="w-full form-input">
                                        @error('questions.question7')
                                        <span class="text-xs text-red-500">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <!-- Add more questions as needed -->
                                </div>
                            </div>

                            <!-- verified by -->

                        </div>


                        <div class="px-3 py-3 text-right bg-gray-100 sm:px-6">
                            <div class="flex justify-between w-full gap-3">
                                <div class="py-2">
                                    <label for="common.active_id"
                                           class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" id="active_id" class="sr-only peer"
                                               wire:model="a_active_id">
                                        <div
                                            class="w-10 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2
                                        peer-focus:ring-blue-300
                                         peer-checked:after:translate-x-full peer-checked:after:border-white
                                         after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300
                                         after:border after:rounded-full after:h-4 after:w-4 after:transition-all
                                         peer-checked:bg-blue-600"></div>
                                        <span class="ml-3 text-xs font-medium text-gray-900 sm:text-sm">Active</span>
                                    </label>
                                </div>
                                <div class="flex gap-3">

                                    <x-button.cancel-x wire:click.prevent="$set('showAddInfoEditModal', false)"/>
                                    <x-button.save-x wire:click.prevent="saveAddInfo"/>
                                </div>
                            </div>
                        </div>
                    </div>

                </x-jet.modal>
            </div>
        </form>

        <!--Add Attempt Modal-------------------------------------------------------------------------------------------------->
        <form wire:submit.prevent="saveAttempt">
            <div class="w-full h-auto">
                <x-jet.modal wire:model.defer="showAttemptEditModal">

                    <div class="px-2 pt-4 sm:px-6">
                        <div class="text-lg">
                            Attempt Entry
                        </div>
                        <x-forms.section-border class="py-2"/>
                        <div>

                            <div class="mb-2">
                                <x-input.floating wire:model="attempt_no" :label="'Attempt No'"/>
                                @error('attempt_no')
                                <div class="text-xs text-red-500">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <x-input.model-select wire:model="lead_id" :label="'Lead By'">
                                    <option value="">Choose...</option>
                                    @foreach(\App\Models\User::all() as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </x-input.model-select>
                            </div>

                            <div class="mt-3">
                                <x-input.rich-text :placeholder="'Description'" wire:model="body"/>
                                @error('body')
                                <div class="text-xs text-red-500">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <x-input.model-select wire:model="status_id" :label="'Status'">
                                    <option value="">Choose...</option>
                                    @foreach(App\Enums\Status::cases() as $status)
                                        <option value="{{$status->value}}">{{$status->getName()}}</option>
                                    @endforeach
                                </x-input.model-select>
                            </div>

                            <div class="mt-3">
                                <x-input.model-select wire:model="verified_by" :label="'Verified By'">
                                    <option value="">Choose...</option>
                                    @foreach(\App\Models\User::all() as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </x-input.model-select>
                            </div>


                            <div class="mb-1">&nbsp;</div>
                        </div>

                        <div class="px-3 py-3 text-right bg-gray-100 sm:px-6">
                            <div class="flex justify-between w-full gap-3">
                                <div class="py-2">
                                    <label for="common.active_id"
                                           class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" id="active_id" class="sr-only peer"
                                               wire:model="active_id">
                                        <div
                                            class="w-10 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2
                                        peer-focus:ring-blue-300
                                         peer-checked:after:translate-x-full peer-checked:after:border-white
                                         after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300
                                         after:border after:rounded-full after:h-4 after:w-4 after:transition-all
                                         peer-checked:bg-blue-600"></div>
                                        <span class="ml-3 text-xs font-medium text-gray-900 sm:text-sm">Active</span>
                                    </label>
                                </div>
                                <div class="flex gap-3">

                                    <x-button.cancel-x wire:click.prevent="$set('showAttemptEditModal', false)"/>
                                    <x-button.save-x wire:click.prevent="saveAttempt"/>
                                </div>
                            </div>
                        </div>
                    </div>

                </x-jet.modal>
            </div>
        </form>
        <!--End Region for Add Attempt Modal-->
        {{--        delete modaal of Atempt.    --}}
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Delete Entry</x-slot>
            <x-slot name="content">
                <div class="py-8 text-cool-gray-700 ">Are you sure you? This action is irreversible.</div>
            </x-slot>
            <x-slot name="footer">
                <div class="flex justify-end gap-5 ">

                    <x-button.cancel-x wire:click.prevent="$set('showDeleteModal', false)"/>
                    <x-button.danger-x wire:click.prevent="trashDataAttempt($id)"/>
                </div>
            </x-slot>
        </x-modal.confirmation>


    </x-forms.m-panel>
</div>
