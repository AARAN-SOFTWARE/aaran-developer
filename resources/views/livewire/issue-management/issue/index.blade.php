<div>
    <x-slot name="header">Issues</x-slot>

    <x-forms.m-panel>

        <!--Top Controls ---------------------------------------------------------------------------------------------->

        <x-forms.top-controls :show-filters="$showFilters"/>

        {{--        <div class="w-9/12 mx-auto flex-col flex gap-y-10 py-16">--}}
        {{--            @foreach($list as $index=>$row)--}}

        {{--                <x-cards.cardNew :id="$row->id"--}}
        {{--                                :title="$row->vname"--}}
        {{--                                :description="$row->body"--}}
        {{--                                :status="\App\Enums\Status::tryFrom($row->status)->getName()"--}}
        {{--                                :priority="\App\Enums\Priority::tryFrom($row->priority)->getName()"--}}
        {{--                                 :colorStatus="\App\Enums\Status::tryFrom($row->status)->getStyle()"--}}
        {{--                                 :colorPrior="\App\Enums\Priority::tryFrom($row->priority)->getStyle()"--}}
        {{--                                :allocated="\App\Models\User::getName($row->allocated)"--}}
        {{--                                :createdBy="\App\Models\User::getName($row->user_id)"--}}
        {{--                                :slides="\App\Livewire\TaskManger\AllTask\Index::getTaskImage($row->id)"--}}
        {{--                                :read-moer="route('task.upsert',[$row->id])"--}}
        {{--                                 :createdAt="$row->created_at->diffForHumans()"--}}
        {{--                                 :updatedAt="$row->updated_at->diffForHumans()"--}}
        {{--                />--}}

        {{--            @endforeach--}}
        {{--        </div>--}}


        <x-table.form>

            <!-- Table Header ----------------------------------------------------------------------------------------->

            <x-slot:table_header name="table_header" class="bg-green-600">
                <x-table.header-serial width="20%"/>

                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}" left>
                    Issue
                </x-table.header-text>

                <x-table.header-text sortIcon="none">
                    Description
                </x-table.header-text>

                <x-table.header-text sortIcon="none">
                    Module
                </x-table.header-text>

                <x-table.header-text sortIcon="none">
                    Assignee To
                </x-table.header-text>

                <x-table.header-text sortIcon="none">
                    Due date
                </x-table.header-text>

                <x-table.header-text sortIcon="none">
                    Status
                </x-table.header-text>

                <x-table.header-text sortIcon="none">
                    Reporter
                </x-table.header-text>


                <x-table.header-action/>
            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)
                    <x-table.row>

                        <x-table.cell-text class="{{App\Enums\Priority::tryFrom($row->priority_id)->getStyle()}}" center>
                            {{$row->id}}
                        </x-table.cell-text>

                        <x-table.cell-text left><span class="capitalize">{{$row->vname}}</span></x-table.cell-text>

                        <x-table.cell-text left><span class="capitalize">{!! $row->body !!}</span></x-table.cell-text>

                        <x-table.cell-text center><span class="capitalize">{{$row->module->vname}}</span>
                        </x-table.cell-text>

                        <x-table.cell-text center><span class="capitalize">{{$row->assignee->name}}</span>
                        </x-table.cell-text>



                        <x-table.cell-text left><span class="capitalize">{{$row->due_date}}</span></x-table.cell-text>

                        <x-table.cell-text class="{{App\Enums\Status::tryFrom($row->status_id)->getStyle()}}" center>
                            {{App\Enums\Status::tryFrom($row->status_id)->getName()}}
                        </x-table.cell-text>

                        <x-table.cell-text center><span class="capitalize">{{$row->reporter->name}}</span>
                        </x-table.cell-text>

                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach

            </x-slot:table_body>

        </x-table.form>


    </x-forms.m-panel>

    <x-modal.delete/>

    <!--Create Record ------------------------------------------------------------------------------------------------->

    <x-forms.create :id="$common->vid" :max-width="'6xl'">

        <!--Left Side ------------------------------------------------------------------------------------------------->
        <div class="flex flex-row space-x-5 w-full">
            <div class="flex flex-col space-y-5 w-full">

                <x-input.floating wire:model="common.vname" :label="'Title'"/>

                <x-input.rich-text wire:model="body" :placeholder="'Write the issues'"/>

            </div>

            <!--Right Side -------------------------------------------------------------------------------------------->

            <div class="flex flex-col space-y-5 w-full">

                <x-input.model-select wire:model="module_id" :label="'Modules'">
                    <option value="">Choose...</option>
                    @foreach(\Aaran\Common\Models\Common::where('label_id','=','24')->get() as $modules)
                        <option value="{{$modules->id}}">{{$modules->vname}}</option>
                    @endforeach
                </x-input.model-select>

                <x-input.model-select wire:model="assignee_id" :label="'Allocated'">
                    <option value="">Choose...</option>
                    @foreach(\App\Models\User::all() as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </x-input.model-select>

                <x-input.model-select wire:model="priority_id" :label="'Priority'">
                    <option value="">Choose...</option>
                    @foreach(App\Enums\Priority::cases() as $priority)
                        <option value="{{$priority->value}}">{{$priority->getName()}}</option>
                    @endforeach
                </x-input.model-select>

                <x-input.model-select wire:model="status_id" :label="'Status'">
                    <option value="">Choose...</option>
                    @foreach(App\Enums\Status::cases() as $status)
                        <option value="{{$status->value}}">{{$status->getName()}}</option>
                    @endforeach
                </x-input.model-select>

                <x-input.floating wire:model="due_date" :label="'Due Date'"/>

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
