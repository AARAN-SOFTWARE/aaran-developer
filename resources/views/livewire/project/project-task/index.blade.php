<div>

    <x-slot name="header">Project Task</x-slot>

    <x-forms.m-panel>
        <x-forms.top-controls :show-filters="$showFilters"/>

        <div class="flex w-full ">

            <x-table.caption :caption="'Project Task'">
                {{$list->count()}}
            </x-table.caption>
        </div>

        <!-- Table Header  ------------------------------------------------------------------------------------------>

        <x-table.form>

            <x-slot:table_header name="table_header" class="bg-green-100">

                <x-table.header-serial></x-table.header-serial>
                <x-table.header-text sort-icon="none">Work Flow</x-table.header-text>
                <x-table.header-text sort-icon="none">Title</x-table.header-text>
                <x-table.header-text sort-icon="none">Assignee</x-table.header-text>
                <x-table.header-text sort-icon="none">Status</x-table.header-text>
                <x-table.header-action/>

            </x-slot:table_header>

            <!-- Table Body  ------------------------------------------------------------------------------------------>
            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->Workflow->vname}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->vname}}</x-table.cell-text>
                        <x-table.cell-text>{{\Aaran\Projects\Models\ProjectTask::assignee($row->assignee)}}</x-table.cell-text>
                        <x-table.cell-text>{{ \App\Enums\Status::tryFrom($row->status)->getName() }}</x-table.cell-text>
                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach

            </x-slot:table_body>

            <x-modal.delete/>
        </x-table.form>

        <x-forms.create :id="$common->vid">
            <div class="space-y-4">

                <x-dropdown.wrapper label="WorkFlow Name" type="workflowTyped">
                    <div class="relative">

                        <x-dropdown.input label="WorkFlow Name*" id="workflow_name"
                                          wire:model.live="workflow_name"
                                          wire:keydown.arrow-up="decrementWorkflow"
                                          wire:keydown.arrow-down="incrementWorkflow"
                                          wire:keydown.enter="enterWorkflow"/>
                        <x-dropdown.select>

                            @if($workflowCollection)
                                @forelse ($workflowCollection as $i => $workflow)
                                    <x-dropdown.option highlight="{{ $highlightWorkflow === $i }}"
                                                       wire:click.prevent="setWorkflow('{{$workflow->vname}}','{{$workflow->id}}')">
                                        {{ $workflow->vname }}
                                    </x-dropdown.option>
                                @empty
                                    <x-dropdown.new href="{{ route('workFlows') }}" label="WorkFlow"/>
                                @endforelse
                            @endif

                        </x-dropdown.select>
                    </div>
                </x-dropdown.wrapper>

                <div>
                    <x-input.floating wire:model="common.vname" :label="'Task Name'"/>

                    @error('common.vname')
                    <span class="text-red-500 text-xs">{{'The TaskName is Required.'}}</span>
                    @enderror
                </div>

                <x-input.floating wire:model="description" :label="'Body'"/>

                <x-input.model-select wire:model="status" :label="'Status'">
                    <option value="">Choose...</option>
                    @foreach(App\Enums\Status::cases() as $status)
                        <option value="{{$status->value}}">{{$status->getName()}}</option>
                    @endforeach
                </x-input.model-select>

                <x-input.model-select wire:model="assignee" :label="'Assign To'">
                    <option value="">Choose...</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </x-input.model-select>
                        @error('assignee')
                        <span class="text-red-500 text-xs">{{'Select Assignee.'}}</span>
                        @enderror

            </div>
        </x-forms.create>

    </x-forms.m-panel>

</div>
