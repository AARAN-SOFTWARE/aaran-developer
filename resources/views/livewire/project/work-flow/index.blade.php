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



            <!-- Table Body  ------------------------------------------------------------------------------------------>
            <div class="flex flex-col sm:grid grid-cols-4 w-full gap-10">

                @foreach($list as $index=>$row)

                    <article
                        class="flex rounded-xl max-w-sm flex-col overflow-hidden border border-slate-300 bg-slate-100 text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                        <!--Card Content ---------------------------------------------------------------------------------->

                        <div class="flex flex-col gap-4 p-6">
                            <div class="flex justify-between">
                                <div class="flex items-center gap-1 font-medium">
                            <span class="text-xl">
                                </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         class="size-6">
                                        <path fill-rule="evenodd"
                                              d="M14.615 1.595a.75.75 0 0 1 .359.852L12.982 9.75h7.268a.75.75 0 0 1 .548 1.262l-10.5 11.25a.75.75 0 0 1-1.272-.71l1.992-7.302H3.75a.75.75 0 0 1-.548-1.262l10.5-11.25a.75.75 0 0 1 .913-.143Z"
                                              clip-rule="evenodd"/>
                                    </svg>

                                    <span>
                                    {{ \App\Enums\Status::tryFrom($row->status)->getName() }}
                                | {{$row->label->vname}} -> {{$row->model->vname}}
                            </span>
                                </div>

                                <!--Edit & Delete ------------------------------------------------------------------------->

                                <div class="flex justify-center items-center gap-4 self-center">
                                    <x-button.edit wire:click="edit({{$row->id}})"/>
                                    <x-button.delete wire:click="getDelete({{$row->id}})"/>
                                </div>
                            </div>

                            <!--Title & Body ------------------------------------------------------------------------------>

                            <a href="{{route('projectTasks')}}" class="text-balance text-xl lg:text-2xl font-bold text-black dark:text-white"
                                aria-describedby="tripDescription">{{$row->vname}}</a>

                            <a href="{{route('projectTasks')}}" id="tripDescription" class="text-pretty text-sm mb-2">
                                {{$row->duration}}
                            </a>
                            <a href="{{route('projectTasks')}}" id="tripDescription" class="text-pretty text-sm mb-2">
                                Estimated :  {{date('d-m-Y',strtotime($row->estimated))}}
                            </a>
                            <a href="{{route('projectTasks')}}" id="tripDescription" class="text-pretty text-sm mb-2">
                                {{$row->notes}}
                            </a>
                        </div>
                    </article>
                @endforeach

            </div>

            <x-modal.delete/>

        <x-forms.create :id="$common->vid">
            <div class="space-y-4">
                <x-input.floating wire:model="common.vname" :label="'Project Title'"/>
                @error('common.vname')
                <span class="text-red-500 text-xs">{{'The Project Title is Required.'}}</span>
                @enderror


                <!-- Label ----------------------------------------------------------------------------->

                <x-dropdown.wrapper label="Folder" type="labelTyped">
                    <div class="relative ">
                        <x-dropdown.input label="Label" id="label_name"
                                          wire:model.live="label_name"
                                          wire:keydown.arrow-up="decrementLabel"
                                          wire:keydown.arrow-down="incrementLabel"
                                          wire:keydown.enter="enterLabel"/>
                        <x-dropdown.select>
                            @if($labelCollection)
                                @forelse ($labelCollection as $i => $label)
                                    <x-dropdown.option highlight="{{$highlightLabel === $i}}"
                                                       wire:click.prevent="setLabel('{{$label->vname}}','{{$label->id}}')">
                                        {{ $label->vname }}
                                    </x-dropdown.option>
                                @empty
                                    <x-dropdown.create wire:click.prevent="labelSave('{{$label_name}}')" label="Label" />
                                @endforelse
                            @endif
                        </x-dropdown.select>
                    </div>
                </x-dropdown.wrapper>

                <!-- Model ----------------------------------------------------------------------------->

                <x-dropdown.wrapper label="Model Name" type="modelTyped">
                    <div class="relative ">
                        <x-dropdown.input label="Model" id="model_name"
                                          wire:model.live="model_name"
                                          wire:keydown.arrow-up="decrementModel"
                                          wire:keydown.arrow-down="incrementModel"
                                          wire:keydown.enter="enterModel"/>
                        <x-dropdown.select>
                            @if($modelCollection)
                                @forelse ($modelCollection as $i => $model)
                                    <x-dropdown.option highlight="{{$highlightModel === $i}}"
                                                       wire:click.prevent="setModel('{{$model->vname}}','{{$model->id}}')">
                                        {{ $model->vname }}
                                    </x-dropdown.option>
                                @empty
                                    <x-dropdown.create wire:click.prevent="modelSave('{{$model_name}}')" label="Model" />
                                @endforelse
                            @endif
                        </x-dropdown.select>
                    </div>
                </x-dropdown.wrapper>


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
