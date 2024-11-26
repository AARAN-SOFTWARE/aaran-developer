<div>
    <x-slot name="header">Leads</x-slot>

    <x-forms.m-panel>

        <x-forms.top-controls :show-filters="$showFilters"/>

        <div class="hidden lg:flex justify-end mb-6">
            <a href="{{ route('enquiries') }}"
               class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500 gap-1 mr-2">
                <x-icons.icon-fill :iconfill="'chevron-d-left'" class="w-5 h-5"></x-icons.icon-fill>
                Back
            </a>
        </div>

        <!-- Table Header  ------------------------------------------------------------------------------------------>

        <x-table.form>

            <x-slot:table_header name="table_header" class="bg-green-100">

                <x-table.header-serial></x-table.header-serial>
                <x-table.header-text sort-icon="none">Title</x-table.header-text>
                <x-table.header-text sort-icon="none">Description</x-table.header-text>
                <x-table.header-text sort-icon="none">Assigned To</x-table.header-text>
                <x-table.header-text sort-icon="none">Software Type</x-table.header-text>
                <x-table.header-text sort-icon="none">Status</x-table.header-text>
                <x-table.header-action/>

            </x-slot:table_header>

            <!-- Table Body  ------------------------------------------------------------------------------------------>

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>

                        <x-table.cell-text>
                            <a href="{{route('followups', $row->id)}}">{{$row->vname}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <div class="line-clamp-1">
                                {!! $row->body !!}
                            </div>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            {{$row->assignee->name}}
                        </x-table.cell-text>

                        <x-table.cell-text>
                            {{$row->softwareType->vname}}
                        </x-table.cell-text>

                        <x-table.cell-text class="{{App\Enums\Status::tryFrom($row->status_id)->getStyle()}}" center>
                            {{App\Enums\Status::tryFrom($row->status_id)->getName()}}
                        </x-table.cell-text>


                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach

            </x-slot:table_body>

        </x-table.form>
        <x-modal.delete/>

        <!-- Create  -------------------------------------------------------------------------------------------------->

        <x-forms.create :id="$common->vid">

            <div class="space-y-4">

                <div>
                    <x-input.floating wire:model="common.vname" :label="'Leads'"/>
                    @error('common.vname')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div>
                    <x-input.rich-text :placeholder="'body'" wire:model="body"/>
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
                                    <x-dropdown.create wire:click.prevent="softwareTypeSave('{{$softwareType_name}}')"
                                                       label="Software Type"/>
                                @endforelse
                            @endif
                        </x-dropdown.select>
                    </div>
                </x-dropdown.wrapper>
                @error('software_type_name')
                <span class="text-red-400">{{$message}}</span>
                @enderror

                <x-input.model-select wire:model="assignee_id" :label="'Allocated'">
                    <option value="">Choose...</option>
                    @foreach(\App\Models\User::all() as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </x-input.model-select>

            </div>
        </x-forms.create>

    </x-forms.m-panel>
</div>
