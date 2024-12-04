<div>
    <x-slot name="header">
        @if($filter==2)
            My Task
        @elseif($filter==3)
            Open Task
        @elseif($filter==4)
            Admin
        @else
            Task
        @endif
    </x-slot>

    <x-forms.m-panel>

        <!--Top Controls ---------------------------------------------------------------------------------------------->

        <div class="flex sm:flex-row sm:justify-between sm:items-center flex-col gap-6 py-4 print:hidden">
            <div class="w-2/4 flex items-center space-x-2">

                <x-input.search-bar wire:model.live="getListForm.searches"
                                    wire:keydown.escape="$set('getListForm.searches', '')" label="Search"/>
                <x-input.toggle-filter :show-filters="$showFilters"/>
            </div>

            <div class="w-80 ">
                <x-input.model-select wire:model.live="jobFilter" :label="'Job'">
                    <option value="">Select Job</option>
                    @foreach($jobCollection as $job)
                        <option value="{{ $job->id }}">{{ $job->vname }}</option>
                    @endforeach
                </x-input.model-select>
            </div>

            <div class="flex sm:justify-center justify-between">
                <x-forms.per-page/>
                <div class="self-end">
                    <x-button.new-x wire:click="create"/>
                </div>
            </div>
        </div>

        <div class="w-9/12 mx-auto flex-col flex gap-y-10 py-16">

            @foreach($list as $index=>$row)

                <div class=" flex overflow-hidden border rounded-md font-lex">
                    <div class="w-2/4 h-60 p-3">
                        <div x-data=" {
            slides: [
                @foreach (\App\Livewire\TaskManger\Task\Index::getTaskImage($row->id) as $slide)
                    {
                        imgSrc: '{{ $slide['imgSrc'] }}',
                        imgAlt: '{{ $slide['imgSrc'] }}',
                    },
                @endforeach
            ],
            currentSlideIndex: 1,
            previous() {
                this.currentSlideIndex = this.currentSlideIndex > 1 ? this.currentSlideIndex - 1 : this.slides.length;
            },
            next() {
                this.currentSlideIndex = this.currentSlideIndex < this.slides.length ? this.currentSlideIndex + 1 : 1;
            },
        }" class="relative w-full rounded-md">

                            <!-- Previous button ---------------------------------------------------------------------->

                            <button type="button"
                                    class="absolute left-1 top-28 z-20 flex rounded-full  items-center justify-center
                    bg-white/40 hover:bg-white/90"
                                    aria-label="previous slide" x-on:click="previous()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                                     fill="none"
                                     stroke-width="3" class="size-4 pr-0.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 19.5 8.25 12l7.5-7.5"/>
                                </svg>
                            </button>

                            <!-- Next button -------------------------------------------------------------------------->

                            <button type="button"
                                    class="absolute right-1 top-28 z-20 flex rounded-full items-center justify-center
                    bg-white/40 hover:bg-white/90"
                                    aria-label="previous slide" x-on:click="next()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                                     fill="none"
                                     stroke-width="3" class="size-4 pl-0.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                                </svg>
                            </button>

                            <!-- Slides ------------------------------------------------------------------------------->

                            <div class="relative h-full w-full rounded-md">
                                <template x-for="(slide, index) in slides">
                                    <div x-cloak x-show="currentSlideIndex == index + 1" class=" inset-0 w-full h-full "
                                         x-transition.opacity.duration.300ms>
                                        <img class="absolute w-full h-[214px] inset-0 text-slate-700 rounded-l-md "
                                             x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt"/>
                                    </div>
                                </template>
                            </div>

                        </div>
                    </div>

                    <!-- Top Panel ------------------------------------------------------------------------------------>

                    <div class="bg-gray-100 w-full h-60 rounded-r-md gap-y-5">
                        <div class="flex justify-between items-center pt-3">
                            <div class="w-11/12 line-clamp-1 text-lg uppercase  font-semibold indent-7 ">{{$row->id}}
                                . {!!  $row->vname !!}</div>
                            <div class="w-1/12 flex justify-end">
                                <x-dropdown.icon>
                                    <div class="bg-white w-20 h-auto flex-col flex gap-y-1 justify-center items-center">
                                        <button wire:click="edit({{$row->id}})"
                                                class="w-full text-xs inline-flex items-center gap-x-2 text-gray-700 hover:bg-blue-100 p-1 hover:text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-blue-600">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                            </svg>
                                            <span>Edit</span>
                                        </button>

                                        <button wire:click="getDelete({{$row->id}})"
                                                class="w-full text-xs inline-flex items-center gap-x-2 text-gray-700 hover:bg-red-100 p-1 hover:text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-red-600">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                            </svg>
                                            <span>Delete</span>
                                        </button>
                                    </div>
                                </x-dropdown.icon>
                            </div>
                        </div>

                        <div class="flex justify-between items-center border-l px-5 pb-3">
                            <div class="inline-flex items-center gap-x-3">
                                <div class="flex items-center gap-x-2 font-semibold">
                                    <div
                                        class="rounded-full bg-white overflow-hidden w-6 h-6 flex justify-center items-center border border-blue-400">
                                        <span> <img src="{{$row->reporter->profile_photo_url}}" alt=""></span>
                                    </div>
                                    <div class="text-xs">{{$row->reporter->name}}</div>
                                </div>
                                <div class="text-xs text-gray-600 px-4">{{$row->created_at->diffForHumans()}} ...
                                </div>
                            </div>


                            <div
                                class="rounded-full text-sm inline-flex items-center gap-x-2 fill-white px-3 py-1
                                {{App\Enums\Priority::tryFrom($row->priority_id)->getStyle()}}">
                                <svg fill="" width="" height="" viewBox="0 0 1920 1920"
                                     xmlns="http://www.w3.org/2000/svg"
                                     class="w-3.5 h-3.5">
                                    <path fill-rule="evenodd"
                                          d="M1687.84 451.764H219.606V282.353c0-31.624 24.847-56.471 56.471-56.471h169.412v56.471c0 31.623 24.847 56.47 56.47 56.47 31.624 0 56.471-24.847 56.471-56.47v-56.471h790.59v56.471c0 31.623 24.85 56.47 56.47 56.47 31.62 0 56.47-24.847 56.47-56.47v-56.471h169.41c31.62 0 56.47 24.847 56.47 56.471v169.411Zm-303 618.036c-4.86-15.6-18.67-26.11-34.38-26.11h-272.01l-84.027-270.853v-.052c-4.919-15.608-18.723-26.118-34.434-26.118-15.661 0-29.515 10.51-34.384 26.17l-84.078 270.853h-272.01c-15.711 0-29.515 10.51-34.384 26.11-4.869 15.61.352 32.64 13.102 42.36l220.107 167.43-84.077 270.9c-4.869 15.66.502 32.69 13.251 42.3 6.325 4.79 13.754 7.2 21.183 7.2s14.858-2.41 21.233-7.25l220.057-167.37L1180 1592.74c12.7 9.67 29.81 9.67 42.51.05 12.75-9.61 18.07-26.64 13.2-42.35l-84.07-270.85 220.15-167.43c12.7-9.72 17.97-26.75 13.05-42.36m246.53-956.859h-169.41v-56.47c0-31.624-24.85-56.471-56.47-56.471-31.62 0-56.47 24.847-56.47 56.47v56.471H558.431v-56.47C558.431 24.847 533.584 0 501.961 0c-31.624 0-56.471 24.847-56.471 56.47v56.471H276.079c-93.742 0-169.412 75.671-169.412 169.412V1920H1800.78V282.353c0-93.741-75.67-169.412-169.41-169.412Z"/>
                                </svg>
                                <span class="font-semibold">
                                    {{App\Enums\Priority::tryFrom($row->priority_id)->getName()}}
                                </span>
                            </div>
                        </div>

                        <!-- Description ------------------------------------------------------------------------------>

                        <div class="bg-white border-t border-l h-40 p-3 space-y-2 flex-col flex justify-between">

                            <div
                                class="w-9/12 self-start h-[60px] overflow-hidden text-xs  text-gray-700 font-semibold
                                line-clamp-3 leading-relaxed flex-col justify-start items-center">
                                {!! $row->body !!}
                            </div>

                            <div class="space-y-2">
                                <div class=" flex justify-between items-center ">
                                    <div class="inline-flex items-center gap-x-2 text-red-600 font-semibold ">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             class="size-3 fill-gray-700">
                                            <path fill-rule="evenodd"
                                                  d="M10 2.5c-1.31 0-2.526.386-3.546 1.051a.75.75 0 0 1-.82-1.256A8 8 0 0 1 18 9a22.47 22.47 0 0 1-1.228 7.351.75.75 0 1 1-1.417-.49A20.97 20.97 0 0 0 16.5 9 6.5 6.5 0 0 0 10 2.5ZM4.333 4.416a.75.75 0 0 1 .218 1.038A6.466 6.466 0 0 0 3.5 9a7.966 7.966 0 0 1-1.293 4.362.75.75 0 0 1-1.257-.819A6.466 6.466 0 0 0 2 9c0-1.61.476-3.11 1.295-4.365a.75.75 0 0 1 1.038-.219ZM10 6.12a3 3 0 0 0-3.001 3.041 11.455 11.455 0 0 1-2.697 7.24.75.75 0 0 1-1.148-.965A9.957 9.957 0 0 0 5.5 9c0-.028.002-.055.004-.082a4.5 4.5 0 0 1 8.996.084V9.15l-.005.297a.75.75 0 1 1-1.5-.034c.003-.11.004-.219.005-.328a3 3 0 0 0-3-2.965Zm0 2.13a.75.75 0 0 1 .75.75c0 3.51-1.187 6.745-3.181 9.323a.75.75 0 1 1-1.186-.918A13.687 13.687 0 0 0 9.25 9a.75.75 0 0 1 .75-.75Zm3.529 3.698a.75.75 0 0 1 .584.885 18.883 18.883 0 0 1-2.257 5.84.75.75 0 1 1-1.29-.764 17.386 17.386 0 0 0 2.078-5.377.75.75 0 0 1 .885-.584Z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-sm">{{$row->allocated->name}}</span>

                                        <div
                                            class="text-gray-600 text-xs px-2">
                                            <span class="text-blue-500">Edited :</span>
                                            {{  $row->updated_at->diffForHumans() }}</div>
                                    </div>
                                    <div class="text-xs space-x-3 capitalize">
                                        <span>{{  \Aaran\Taskmanager\Models\Task::common($row->job_id) }}</span>
                                        <span>|</span>
                                        <span>{{  \Aaran\Taskmanager\Models\Task::common($row->module_id) }}</span>
                                    </div>
                                </div>

                                <div class=" left-4 w-full flex justify-between items-center self-end  ">
                                    <a href="{{route('tasks.upsert',[$row->id])}}" type="button"
                                       class="bg-blue-600 p-1 text-white rounded-md px-3 py-1 text-xs hover:bg-blue-500 transition-all duration-300 ease-in-out inline-flex items-center gap-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             class="size-3">
                                            <path
                                                d="M3.105 2.288a.75.75 0 0 0-.826.95l1.414 4.926A1.5 1.5 0 0 0 5.135 9.25h6.115a.75.75 0 0 1 0 1.5H5.135a1.5 1.5 0 0 0-1.442 1.086l-1.414 4.926a.75.75 0 0 0 .826.95 28.897 28.897 0 0 0 15.293-7.155.75.75 0 0 0 0-1.114A28.897 28.897 0 0 0 3.105 2.288Z"/>
                                        </svg>

                                        <span>Read More ...</span></a>
                                    <div
                                        class="text-xs px-3 py-1 rounded-full text-center {{\App\Enums\Status::tryFrom($row->status_id)->getStyle()}}">
                                        {{\App\Enums\Status::tryFrom($row->status_id)->getName()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

    </x-forms.m-panel>

    <x-modal.delete/>

    <!--Create Record ------------------------------------------------------------------------------------------------->

    <x-forms.create :id="$common->vid" :max-width="'6xl'">

        <!--Left Side ------------------------------------------------------------------------------------------------->
        <div class="flex flex-row space-x-5 w-full">
            <div class="flex flex-col space-y-5 w-full">

                <div>
                    <x-input.floating wire:model="common.vname" :label="'Title'"/>
                    @error('common.vname')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <x-dropdown.wrapper label="Job" type="jobTyped">
                    <div class="relative">
                        <x-dropdown.input label="Job" id="job_name"
                                          wire:model.live="job_name"
                                          wire:keydown.arrow-up="decrementJob"
                                          wire:keydown.arrow-down="incrementJob"
                                          wire:keydown.enter="enterJob"/>
                        <x-dropdown.select>
                            @if($jobCollection)
                                @forelse ($jobCollection as $i => $job)
                                    <x-dropdown.option highlight="{{$highlightJob === $i}}"
                                                       wire:click.prevent="setJob('{{$job->vname}}','{{$job->id}}')">
                                        {{ $job->vname }}
                                    </x-dropdown.option>
                                @empty
                                    <x-dropdown.create wire:click.prevent="jobSave('{{$job_name}}')"
                                                       label="Job"/>
                                @endforelse
                            @endif
                        </x-dropdown.select>
                    </div>
                </x-dropdown.wrapper>
                @error('job_id')
                <div class="text-xs text-red-500 ">
                    {{$message}}
                </div>
                @enderror

                <div>
                    <x-input.rich-text wire:model="body" :placeholder="'Write the error'"/>
                    @error('body')
                    <div class="text-xs text-red-500 mt-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

            </div>

            <!--Right Side -------------------------------------------------------------------------------------------->

            <div class="flex flex-col space-y-5 w-full">

                <x-dropdown.wrapper label="Module" type="moduleTyped">
                    <div class="relative">
                        <x-dropdown.input label="Module" id="module_name"
                                          wire:model.live="module_name"
                                          wire:keydown.arrow-up="decrementModule"
                                          wire:keydown.arrow-down="incrementModule"
                                          wire:keydown.enter="enterModule"/>
                        <x-dropdown.select>
                            @if($moduleCollection)
                                @forelse ($moduleCollection as $i => $module)
                                    <x-dropdown.option highlight="{{$highlightModule === $i}}"
                                                       wire:click.prevent="setModule('{{$module->vname}}','{{$module->id}}')">
                                        {{ $module->vname }}
                                    </x-dropdown.option>
                                @empty
                                    <x-dropdown.create wire:click.prevent="moduleSave('{{$module_name}}')"
                                                       label="Module"/>
                                @endforelse
                            @endif
                        </x-dropdown.select>
                    </div>
                </x-dropdown.wrapper>
                @error('module_id')
                <div class="text-xs text-red-500">
                    {{$message}}
                </div>
                @enderror

                <div>
                    <x-input.model-select wire:model="allocated_id" :label="'Allocated'">
                        <option value="">Choose...</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </x-input.model-select>
                    @error('allocated_id')
                    <div class="text-xs text-red-500 my-2">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <x-input.model-select wire:model="priority_id" :label="'Priority'">
                    <option value="">Choose...</option>
                    @foreach(App\Enums\Priority::cases() as $priority)
                        <option value="{{$priority->value}}">{{$priority->getName()}}</option>
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
