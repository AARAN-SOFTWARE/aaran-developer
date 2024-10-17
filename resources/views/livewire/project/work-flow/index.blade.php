<div>

    <x-slot name="header">Work Flow</x-slot>

    <x-forms.m-panel>
        <x-forms.top-control-without-search>
            <div class="w-full flex items-center space-x-2">

                <x-input.search-bar wire:model.live="getListForm.searches"
                                    wire:keydown.escape="$set('getListForm.searches', '')" label="Search"/>
            </div>
            <div class="w-full">
                <x-input.model-select wire:model.live="projectId" :label="'Project'">
                    <option value="">Choose...</option>
                    @foreach($projectCollection as $project)
                        <option value="{{$project->id}}">{{$project->vname}}</option>
                    @endforeach
                </x-input.model-select>
            </div>
        </x-forms.top-control-without-search>

        <div class="flex w-full ">

            <x-table.caption :caption="'Work Flow'">
                {{$list->count()}}
            </x-table.caption>
        </div>

        <!-- Table Header  ------------------------------------------------------------------------------------------>

        <x-table.form>

            <x-slot:table_header name="table_header" class="bg-green-100">

                <x-table.header-serial></x-table.header-serial>
                <x-table.header-text sort-icon="none">Title</x-table.header-text>
                <x-table.header-text sort-icon="none">Estimated</x-table.header-text>
                <x-table.header-text sort-icon="none">Duration</x-table.header-text>
                <x-table.header-text sort-icon="none">Status</x-table.header-text>
                <x-table.header-text sort-icon="none">Notes</x-table.header-text>
                <x-table.header-action/>

            </x-slot:table_header>

            <!-- Table Body  ------------------------------------------------------------------------------------------>
            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->vname}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->estimated}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->duration}}</x-table.cell-text>
                        <x-table.cell-text>{{ \App\Enums\Status::tryFrom($row->status)->getName() }}</x-table.cell-text>
                        <x-table.cell-text>{{$row->notes}}</x-table.cell-text>
                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach

            </x-slot:table_body>

            <x-modal.delete/>
        </x-table.form>

        <x-forms.create :id="$common->vid">
            <div class="space-y-4">
                <x-input.floating wire:model="common.vname" :label="'Project Title'"/>
                @error('common.vname')
                <span class="text-red-500 text-xs">{{'The Project Title is Required.'}}</span>
                @enderror

                <x-dropdown.wrapper label="Project Name" type="projectTyped">
                    <div class="relative">

                        <x-dropdown.input label="Project Name*" id="project_name"
                                          wire:model.live="project_name"
                                          wire:keydown.arrow-up="decrementProject"
                                          wire:keydown.arrow-down="incrementProject"
                                          wire:keydown.enter="enterProject"/>
                        <x-dropdown.select>

                            @if($projectCollection)
                                @forelse ($projectCollection as $i => $project)
                                    <x-dropdown.option highlight="{{ $highlightProject === $i }}"
                                                       wire:click.prevent="setProject('{{$project->vname}}','{{$project->id}}')">
                                        {{ $project->vname }}
                                    </x-dropdown.option>
                                @empty
                                    <x-dropdown.new href="{{ route('projects') }}" label="Project"/>
                                @endforelse
                            @endif

                        </x-dropdown.select>
                    </div>
                </x-dropdown.wrapper>



                <x-input.floating wire:model="estimated" type="date" :label="'Estimate'"/>

                <x-input.floating wire:model="duration" :label="'Duration'"/>

                <x-input.model-select wire:model="status" :label="'Status'">
                    <option value="">Choose...</option>
                    @foreach(App\Enums\Status::cases() as $status)
                        <option value="{{$status->value}}">{{$status->getName()}}</option>
                    @endforeach
                </x-input.model-select>

                <x-input.floating wire:model="notes" :label="'Notes'"/>

            </div>
        </x-forms.create>

    </x-forms.m-panel>

</div>
