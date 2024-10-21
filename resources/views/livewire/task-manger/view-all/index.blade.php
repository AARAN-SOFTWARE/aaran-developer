<div>
    <x-slot name="header">Task</x-slot>

    <x-forms.m-panel>

        <!--Top Controls ---------------------------------------------------------------------------------------------->

        <x-forms.top-controls :show-filters="$showFilters"/>

        <div class="flex flex-col sm:grid grid-cols-4 w-full gap-10">
            @foreach($list as $index=>$row)
                <x-cards.card-3 :id="$row->id"
                                :title="$row->vname"
                                :description="$row->body"
                                :status="\App\Enums\Status::tryFrom($row->status)->getName()"
                                :priority="\App\Enums\Priority::tryFrom($row->priority)->getName()"
                                :allocated="\App\Models\User::getName($row->allocated)"
                                :createdBy="\App\Models\User::getName($row->user_id)"
                                :slides="\App\Livewire\TaskManger\ViewAll\Index::getTaskImage($row->id)"
                                :read-moer="route('task.upsert',[$row->id])"
                />
            @endforeach
        </div>
    </x-forms.m-panel>

    <x-modal.delete/>

    <!--Create Record ------------------------------------------------------------------------------------------------->

    <x-forms.create :id="$common->vid" :max-width="'6xl'">

        <!--Left Side ------------------------------------------------------------------------------------------------->
        <div class="flex flex-row space-x-5 w-full">
            <div class="flex flex-col space-y-5 w-full">

                <x-input.floating wire:model="common.vname" :label="'Title'"/>

                <x-input.rich-text wire:model="body" :placeholder="'Write the error'"/>

            </div>

            <!--Right Side -------------------------------------------------------------------------------------------->

            <div class="flex flex-col space-y-5 w-full">

                <x-input.model-select wire:model="allocated" :label="'Allocated'">
                    <option value="">Choose...</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </x-input.model-select>

                <x-input.model-select wire:model="priority" :label="'Priority'">
                    <option value="">Choose...</option>
                    @foreach(App\Enums\Priority::cases() as $priority)
                        <option value="{{$priority->value}}">{{$priority->getName()}}</option>
                    @endforeach
                </x-input.model-select>

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

                            <div wire:loading wire:target="images" class="z-10 absolute top-6 left-12">
                                <div class="w-14 h-14 rounded-full animate-spin
                                                        border-y-4 border-dashed border-green-500 border-t-transparent"></div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </x-forms.create>

</div>
