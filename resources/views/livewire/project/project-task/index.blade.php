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
                        <x-table.cell-text><a href="{{  route('projectTasks.activity',[$row->id])}}"> {{$index+1}}</a>
                        </x-table.cell-text>
                        <x-table.cell-text><a
                                href="{{  route('projectTasks.activity',[$row->id])}}"> {{$row->Workflow->vname}}</a>
                        </x-table.cell-text>
                        <x-table.cell-text><a
                                href="{{  route('projectTasks.activity',[$row->id])}}"> {{$row->vname}}</a>
                        </x-table.cell-text>
                        <x-table.cell-text><a
                                href="{{  route('projectTasks.activity',[$row->id])}}"> {{\Aaran\Projects\Models\ProjectTask::assignee($row->assignee)}}</a>
                        </x-table.cell-text>
                        <x-table.cell-text><a
                                href="{{  route('projectTasks.activity',[$row->id])}}"> {{ \App\Enums\Status::tryFrom($row->status)->getName() }}</a>
                        </x-table.cell-text>
                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach

            </x-slot:table_body>

            <x-modal.delete/>
        </x-table.form>

        <x-forms.create :id="$common->vid">
            <div class="space-y-4">
                <div>
                    <x-input.floating wire:model="common.vname" :label="'Task Name'"/>

                    @error('common.vname')
                    <span class="text-red-500 text-xs">{{'The TaskName is Required.'}}</span>
                    @enderror
                </div>

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

                <x-input.rich-text :placeholder="''" wire:model="description"/>

                <x-input.model-select wire:model="assignee" :label="'Assign To'">
                    <option value="">Choose...</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </x-input.model-select>
                @error('assignee')
                <span class="text-red-500 text-xs">{{'Select Assignee.'}}</span>
                @enderror

                <x-input.model-select wire:model="status" :label="'Status'">
                    <option value="">Choose...</option>
                    @foreach(App\Enums\Status::cases() as $status)
                        <option value="{{$status->value}}">{{$status->getName()}}</option>
                    @endforeach
                </x-input.model-select>

                <!-- Image  ----------------------------------------------------------------------------------------------->

                <div class="flex flex-col py-2">
                    <label for="bg_image"
                           class="w-full text-zinc-500 tracking-wide pb-4 px-2">Image</label>
                    <div class="flex flex-wrap gap-2">
                        <div class="flex-shrink-0">
                            <div>
                                @if($images)
                                    <div class="flex gap-5">
                                        @foreach($images as $image)
                                            <div
                                                class=" flex-shrink-0 border-2 border-dashed border-gray-300 p-1 rounded-lg overflow-hidden">
                                                <img
                                                    class="w-[156px] h-[89px] rounded-lg hover:brightness-110 hover:scale-105 duration-300 transition-all ease-out"
                                                    src="{{ $image->temporaryUrl() }}"
                                                    alt="{{$image?:''}}"/>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if(isset($old_images))
                                    <div class="flex gap-5">
                                        @foreach($old_images as $old_image)
                                            <div
                                                class=" flex-shrink-0 border-2 border-dashed border-gray-300 p-1 rounded-lg overflow-hidden">
                                                <img
                                                    class="w-[156px] h-[89px] rounded-lg hover:brightness-110 hover:scale-105 duration-300 transition-all ease-out"
                                                    src="{{URL(\Illuminate\Support\Facades\Storage::url('images/'.$old_image->image))}}"
                                                    alt="">
                                                <div class="flex justify-center items-center">
                                                    <x-button.delete wire:click="DeleteImage({{$old_image->id}})"/>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
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
                                    <input type="file" id='bg_image' wire:model="images" class="hidden" multiple/>
                                    <p class="text-xs font-light text-gray-400 mt-2">PNG and JPG are
                                        Allowed.</p>
                                </label>
                            </div>

                            <div wire:loading wire:target="image" class="z-10 absolute top-6 left-12">
                                <div class="w-14 h-14 rounded-full animate-spin
                                                        border-y-4 border-dashed border-green-500 border-t-transparent"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </x-forms.create>

    </x-forms.m-panel>

</div>
