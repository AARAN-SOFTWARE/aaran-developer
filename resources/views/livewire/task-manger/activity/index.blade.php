<div>
    <x-slot name="header">Activity</x-slot>

    <x-forms.m-panel>
        <!-- Top Controls  -------------------------------------------------------------------------------------------->

        <x-forms.top-controls :show-filters="$showFilters"/>

        <div class="flex w-full">

            <x-table.caption :caption="'Activity'">
                {{$list->count()}}
            </x-table.caption>
        </div>

        <x-table.form>

            <!-- Table Header  ---------------------------------------------------------------------------------------->

            <x-slot:table_header name="table_header" class="bg-green-100">

                <x-table.header-serial></x-table.header-serial>

                <x-table.header-text wire:click.prevent="sortBy ('task_id')" sort-icon="{{$getListForm->sortAsc}}">
                    Task_Id
                </x-table.header-text>

                <x-table.header-text sort-icon="none">Name</x-table.header-text>

                <x-table.header-text sort-icon="none">Estimated</x-table.header-text>

                <x-table.header-text sort-icon="none">Duration</x-table.header-text>

                <x-table.header-text sort-icon="none">Start_on</x-table.header-text>

                <x-table.header-text sort-icon="none">End_on</x-table.header-text>

                <x-table.header-text sort-icon="none">Remarks</x-table.header-text>

                <x-table.header-action/>
            </x-slot:table_header>

            <!-- Table Body  ------------------------------------------------------------------------------------------>

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>

                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>

                        <x-table.cell-text>{{$row->task->vname}}</x-table.cell-text>

                        <x-table.cell-text left>{{$row->vname}}</x-table.cell-text>

                        <x-table.cell-text left>{{$row->estimated}}</x-table.cell-text>

                        <x-table.cell-text left>{{$row->duration}}</x-table.cell-text>

                        <x-table.cell-text left>{{$row->start_on}}</x-table.cell-text>

                        <x-table.cell-text left>{{$row->end_on}}</x-table.cell-text>

                        <x-table.cell-text left>{{$row->remarks}}</x-table.cell-text>

                        <x-table.cell-action id="{{$row->id}}"/>

                    </x-table.row>

                @endforeach

            </x-slot:table_body>

            <x-modal.delete/>

        </x-table.form>

        <x-forms.create :id="$common->vid" :max-width="'6xl'">

            {{--            <x-input.model-select wire:model="task_id" :label="'Task'">--}}
            {{--                <option value=" ">Choose...</option>--}}
            {{--                @foreach($tasks as $task)--}}
            {{--                    <option value="{{$tasks->id}}"> {{$task_name}} </option>--}}
            {{--                @endforeach--}}
            {{--            </x-input.model-select>--}}

            <div class="flex flex-row space-x-5 w-full">

                <div class="flex flex-col space-y-5 w-full">

                    <x-input.model-date wire:model="cdate" :label="'Date'"/>

                    <x-dropdown.wrapper label="Task Name" type="taskTyped">
                        <div class="relative ">

                            <x-dropdown.input label="Task Name*" id="task_name"
                                              wire:model.live="task_name"
                                              wire:keydown.arrow-up="decrementTask"
                                              wire:keydown.arrow-down="incrementTask"
                                              wire:keydown.enter="enterTask"/>
                            <x-dropdown.select>

                                @if($taskCollection)
                                    @forelse ($taskCollection as $i => $task)
                                        <x-dropdown.option highlight="{{ $highlightTask === $i }}"
                                                           wire:click.prevent="setTask('{{$task->vname}}','{{$task->id}}')">
                                            {{ $task->vname }}
                                        </x-dropdown.option>
                                    @empty
                                        <x-dropdown.new href="{{route('task')}}" label="Task"/>
                                    @endforelse
                                @endif

                            </x-dropdown.select>
                        </div>
                    </x-dropdown.wrapper>


                    <x-input.floating wire:model="common.vname" :label="'Title'"/>

                    <x-input.floating wire:model="estimated" :label="'Estimate'"/>


                </div>

                <div class="flex flex-col space-y-5 w-full">

                    <x-input.floating wire:model="duration" :label="'Duration'"/>

                    <x-input.floating wire:model="start_on" :label="'Start_On'" type="date"/>

                    <x-input.floating wire:model="end_on" :label="'End_On'" type="date"/>

                    <x-input.floating wire:model="remarks" :label="'Remarks'"/>


                </div>

            </div>

        </x-forms.create>

    </x-forms.m-panel>
</div>
