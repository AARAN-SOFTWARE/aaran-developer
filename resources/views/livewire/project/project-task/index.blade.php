<div>

    <x-slot name="header">Project Task</x-slot>

    <x-forms.m-panel>

        <x-forms.top-control-without-search>

            <div class="w-full flex items-center space-x-2">

                <x-input.search-bar wire:model.live="getListForm.searches"
                                    wire:keydown.escape="$set('getListForm.searches', '')" label="Search"/>
            </div>

            <div class="w-full">
                <x-input.model-select wire:model.live="workflowId" :label="'Project'">
                    <option value="">Choose...</option>
                    @foreach($workflowCollection as $workFlow)
                        <option value="{{$workFlow->id}}">{{$workFlow->vname}}</option>
                    @endforeach
                </x-input.model-select>
            </div>
        </x-forms.top-control-without-search>

        <div class="flex w-full ">

            <x-table.caption :caption="'Project Task'">
                {{$list->count()}}
            </x-table.caption>
        </div>

        <!-- Table Header  ------------------------------------------------------------------------------------------>

        <div class="flex flex-col sm:grid grid-cols-4 w-full gap-10 capitalize">
            @foreach($list as $index=>$row)
                <x-cards.card-3 :id="$row->id"
                                :title="$row->vname"
                                :description="$row->description"
                                :price="\App\Enums\Status::tryFrom($row->status)->getName()"
                                :creator="\App\Models\User::getName($row->assignee)"
                                :slides="\App\Livewire\Project\ProjectTask\Index::getTaskImage($row->id)"
                                :read-moer="route('projectTasks.show',[$row->id])"
                />
            @endforeach
        </div>



        <x-forms.create :id="$common->vid">
            <div class="space-y-4">
                <div>
                    <x-input.floating wire:model="common.vname" :label="'Task Name'"/>

                    @error('common.vname')
                    <span class="text-red-500 text-xs">{{'The TaskName is Required.'}}</span>
                    @enderror
                </div>

                <x-dropdown.wrapper label="WorkFlow" type="workflowTyped">
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
