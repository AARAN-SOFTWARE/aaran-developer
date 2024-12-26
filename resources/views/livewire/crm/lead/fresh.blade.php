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


{{--        <!--Additional Information Table-->--}}
{{--        <div class="text-blue-500">Additional Information</div>--}}
{{--        <!-- Table Header  ------------------------------------------------------------------------------------------>--}}
{{--        <x-table.form>--}}

{{--            <x-slot:table_header name="table_header" class="bg-green-100">--}}


{{--                <x-table.header-serial></x-table.header-serial>--}}
{{--                <x-table.header-text sort-icon="none">Title</x-table.header-text>--}}
{{--                <x-table.header-text sort-icon="none">Lead By</x-table.header-text>--}}
{{--                <x-table.header-text sort-icon="none">Description</x-table.header-text>--}}
{{--                <x-table.header-text sort-icon="none">Software Type</x-table.header-text>--}}
{{--                <x-table.header-text sort-icon="none">Questions</x-table.header-text>--}}
{{--                <x-table.header-text sort-icon="none">Verified By</x-table.header-text>--}}

{{--                <x-table.header-action/>--}}

{{--            </x-slot:table_header>--}}

{{--            <!-- Table Body  - Add Info------------------------------------------------------------------------------------------>--}}

{{--            <x-slot:table_body name="table_body">--}}

{{--                @foreach($leadList as $index=>$rw)--}}

{{--                    <x-table.row>--}}
{{--                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>--}}


{{--                        <x-table.cell-text>--}}
{{--                            <a href="{{route('followups', $rw->id)}}">{{$rw->title}}</a>--}}
{{--                        </x-table.cell-text>--}}


{{--                        <x-table.cell-text>--}}
{{--                            {{$rw->lead->name}}--}}
{{--                        </x-table.cell-text>--}}

{{--                        <x-table.cell-text>--}}
{{--                            <div class="line-clamp-1">--}}
{{--                                {!! $rw->body !!}--}}
{{--                            </div>--}}
{{--                        </x-table.cell-text>--}}


{{--                        <x-table.cell-text>--}}
{{--                            {{$rw->softwareType->vname}}--}}
{{--                        </x-table.cell-text>--}}

{{--                        <x-table.cell-text>--}}
{{--                            {{$rw->questions}}--}}
{{--                        </x-table.cell-text>--}}

{{--                        <x-table.cell-text>--}}
{{--                            {{$rw->verified->name}}--}}
{{--                        </x-table.cell-text>--}}


{{--                        <td>--}}
{{--                            <div class="flex items-center self-center justify-center gap-2 px-1 sm:gap-4">--}}
{{--                                <a href="{{route('leads.upsert',[$rw->id])}}" class="pt-1">--}}
{{--                                    <x-button.edit wire:click="editAddInfo({{$rw->id}})" />--}}
{{--                                </a>--}}
{{--                                <x-button.delete wire:click="getDeleteAddInfo({{$rw->id}})"/>--}}

{{--                            </div>--}}
{{--                        </td>--}}
{{--                    </x-table.row>--}}
{{--                @endforeach--}}
{{--            </x-slot:table_body>--}}
{{--        </x-table.form>--}}

{{--                delete modal of AddInfo.--}}
{{--        <x-modal.confirmation wire:model.defer="showDeleteModalAddInfo">--}}
{{--            <x-slot name="title">Delete Entry</x-slot>--}}
{{--            <x-slot name="content">--}}
{{--                <div class="py-8 text-cool-gray-700 ">Are you sure you? This action is irreversible.</div>--}}
{{--            </x-slot>--}}
{{--            <x-slot name="footer">--}}
{{--                <div class="flex justify-end gap-5 ">--}}
{{--                    <x-button.cancel-x wire:click.prevent="$set('showDeleteModalAddInfo', false)"/>--}}
{{--                    <x-button.danger-x wire:click.prevent="trashDataAddInfo($id)"/>--}}
{{--                </div>--}}
{{--            </x-slot>--}}
{{--        </x-modal.confirmation>--}}

       <!--Additional Information Card-->

        <div class="bg-blue-100 font-semibold py-1 px-2 rounded inline-block">Additional Information</div>
        <div class="space-y-4">
            @foreach($leadList as $index => $rw)
                <div class="bg-gray-50 p-4 shadow rounded-lg max-w-5xl border border-gray-300 mb-12">

                    <!-- Title -->
                    <div class="mb-2 border-b pb-2">
                        <strong class="text-lg shadow-md"> Title:</strong>
                        <a href="{{ route('followups', $rw->id) }}" class="text-gray-800">{{ $rw->title }}</a>
                    </div>


                    <!-- Lead By  -->
                    <div class="mb-2 border-b pb-2">
                        <strong class="text-lg shadow-md">Lead By:</strong>
                        <span class="text-gray-800">{{ $rw->lead->name }}</span>
                    </div>

                    <!-- Description -->
                    <div class="mb-2 border-b pb-2">
                        <strong class="text-lg shadow-md">Description:</strong>
                        <div class="text-sm text-gray-800 line-clamp-3">{!! $rw->body !!}</div>
                    </div>

                    <!-- Description -->
                    <div class="mb-2 border-b pb-2">
                        <strong class="text-lg shadow-md">Software Type:</strong>
                        <div class="text-sm text-gray-800 line-clamp-3">{{$rw->softwareType->vname}}</div>
                    </div>

                    <!-- Questions -->
                    <div class="mb-2 border-b pb-2">
                        <strong class="text-lg shadow-md">Questions:</strong>
                        <div class="text-sm text-gray-800 line-clamp-3">{{ $rw->questions }}</div>
                    </div>

                    <!-- Verified By -->
                    <div class="mb-4 border-b pb-2">
                        <strong class="text-lg shadow-md">Verified By:</strong>
                        <div class="text-sm text-gray-800">{{ $rw->verified->name }}</div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center">
                        <x-button.edit wire:click="editAddInfo({{ $rw->id }})" />
                        <x-button.delete wire:click="getDeleteAddInfo({{ $rw->id }})" />
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal -->
        <x-modal.confirmation wire:model.defer="showDeleteModalAddInfo">
            <x-slot name="title">Delete Entry</x-slot>
            <x-slot name="content">
                <div class="py-8 text-cool-gray-700">Are you sure you want to delete this entry? This action is irreversible.</div>
            </x-slot>
            <x-slot name="footer">
                <div class="flex justify-end gap-5">
                    <x-button.cancel-x wire:click.prevent="$set('showDeleteModalAddInfo', false)" />
                    <x-button.danger-x wire:click.prevent="trashDataAddInfo($id)" />
                </div>
            </x-slot>
        </x-modal.confirmation>





        {{--            <div class="space-y-4">--}}
{{--                @foreach($leadList as $index=>$rw)--}}
{{--                    <div class="bg-white p-4 shadow rounded-lg">--}}
{{--                        <div class="flex justify-between items-center mb-2">--}}
{{--                            <div class="font-semibold text-lg">Lead #{{ $index + 1 }}</div>--}}
{{--                            <div class="text-sm text-gray-500">{{ $rw->softwareType->vname }}</div>--}}
{{--                        </div>--}}

{{--                        <div class="mb-2">--}}
{{--                            <strong class="text-sm">Title:</strong>--}}
{{--                            <a href="{{ route('followups', $rw->id) }}" class="text-blue-600 hover:underline">{{ $rw->title }}</a>--}}
{{--                        </div>--}}

{{--                        <div class="mb-2">--}}
{{--                            <strong class="text-sm">Client Name:</strong>--}}
{{--                            <span class="text-gray-800">{{ $rw->lead->name }}</span>--}}
{{--                        </div>--}}

{{--                        <div class="mb-2">--}}
{{--                            <strong class="text-sm">Description:</strong>--}}
{{--                            <div class="line-clamp-2">{!! $rw->body !!}</div>--}}
{{--                        </div>--}}

{{--                        <div class="mb-2">--}}
{{--                            <strong class="text-sm">Questions:</strong>--}}
{{--                            <div class="text-gray-800">{{ $rw->questions }}</div>--}}
{{--                        </div>--}}

{{--                        <div class="mb-2">--}}
{{--                            <strong class="text-sm">Verified By:</strong>--}}
{{--                            <div class="text-gray-800">{{ $rw->verified->name }}</div>--}}
{{--                        </div>--}}

{{--                        <div class="flex justify-between items-center mt-4">--}}
{{--                            <x-button.edit wire:click="editAddInfo({{ $rw->id }})" />--}}
{{--                            <x-button.delete wire:click="getDeleteAddInfo({{ $rw->id }})" />--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}

{{--            <!-- Modal -->--}}
{{--            <x-modal.confirmation wire:model.defer="showDeleteModalAddInfo">--}}
{{--                <x-slot name="title">Delete Entry</x-slot>--}}
{{--                <x-slot name="content">--}}
{{--                    <div class="py-8 text-cool-gray-700">Are you sure you? This action is irreversible.</div>--}}
{{--                </x-slot>--}}
{{--                <x-slot name="footer">--}}
{{--                    <div class="flex justify-end gap-5">--}}
{{--                        <x-button.cancel-x wire:click.prevent="$set('showDeleteModalAddInfo', false)" />--}}
{{--                        <x-button.danger-x wire:click.prevent="trashDataAddInfo($id)" />--}}
{{--                    </div>--}}
{{--                </x-slot>--}}
{{--            </x-modal.confirmation>--}}


            <!-- Create  -------------------------------------------------------------------------------------------------->


        <!--Table For Add Attempt-->
        <div class="bg-green-200 font-semibold py-1 px-2 rounded inline-block">Attempts</div>
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
                            <div class="font-semibold text-lg">{{ $index + 1 }}</div>
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
{{--                    <div wire:key="{{ $softwareType_name }}" class="modal-content">--}}

                    <div class="px-2 pt-4 sm:px-6">
                        <div class="text-lg">
                            Additional Information Entry
                        </div>
                        <x-forms.section-border class="py-5"/>
                        <div class="p-4 flex justify-between gap-x-5">

                            <div class="space-y-5 py-2 flex flex-col justify-between">
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


        <!-----Questions Section------------------------------------------------------------------------------->

                            <div class="p-4 space-y-4 border rounded-lg">
                                <div class="block my-4">
                                    <strong>Selected Software Type: </strong>
                                    <span class="bg-blue-100 text-blue-800 font-semibold py-1 px-2 rounded">
            {{ $softwareType_name }}
        </span>
                                </div>
                                @php
                                    $questions = [
                                        'Billing Software' => [
                                            'How are you currently managing your billing process?',
                                            'Are you using any software for billing, or it is managed manually?',
                                            'What features do you need in your billing system?',
                                            'How Many users will need to access to the software?',
                                            'Do you need support for multiple currencies?',
                                            'What is your Budget?',
                                            'Do you want implement immediately or Timeline?'
                                        ],
                                        'Portfolio Software' => [
                                            'How are you currently managing your portfolio?',
                                            'Are you using any software for portfolio management, or is it managed manually?',
                                            'What features do you need in your portfolio system?',
                                            'How many items do you manage?',
                                            'Do you need integration with financial platforms?',
                                            'What is your Budget?',
                                            'Do you want implement immediately or Timeline?'
                                        ],
                                        'Business Software' => [
                                            'How are you currently managing your business operations?',
                                            'Are you using any software for business management, or is it managed manually?',
                                            'What features do you need in your business system?',
                                            'How many users will need access?',
                                            'Do you need support for multiple departments?',
                                            'What is your Budget?',
                                            'Do you want implement immediately or Timeline?'
                                        ],
                                    ];
                                @endphp

                                @if (array_key_exists($softwareType_name, $questions))
                                    <label class="block text-xl font-semibold mb-6 text-gray-800">Questions</label>
                                    @foreach ($questions[$softwareType_name] as $index => $question)
                                        <div class="mb-6">
                                            <label for="question{{ $index + 1 }}" class="block text-sm font-medium text-gray-600 mb-2">
                                                {{ $index + 1 }}. {{ $question }}
                                            </label>
                                            <input type="text" id="question{{ $index + 1 }}" wire:model="questions.question{{ $index + 1 }}"
                                                   class="w-full h-10 p-2 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-4 focus:ring-blue-400 focus:border-blue-500 hover:bg-gray-100 transition duration-200 ease-in-out placeholder-gray-400 placeholder:text-sm"
                                                   placeholder="Type your answer here...">
                                            @error("questions.question{{ $index + 1 }}")
                                            <span class="text-xs text-red-600 mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endforeach
                                @endif





                            </div>

 <!-------------------- End Questions Section-->

                        </div>


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

{{--                    </div>--}}
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

        {{--        delete modal of Atempt.    --}}
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
{{--</div>--}}
</div>
