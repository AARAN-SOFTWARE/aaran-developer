<div>
    <x-slot name="header">Task</x-slot>
    {{--    {{dd($taskData)}}--}}

    <!-- Top Control ------------------------------------------------------------------------------------------------>

    <x-forms.m-panel>
        <div class="max-w-7xl mx-auto p-10 space-y-8">

            <div class="inline-flex">
                <div class="text-5xl">{{$taskData->id}}.</div>

                <div class="text-5xl font-bold tracking-wider">{{$taskData->vname}}</div>

            </div>

            <div class="hidden lg:flex justify-between mb-6">
                <a href="{{route('publicTask')}}"
                   class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                    <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                        <g fill="none" fill-rule="evenodd">
                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5"
                                  d="M21 1v20.16H.84V1z">
                            </path>
                            <path class="fill-current"
                                  d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                            </path>
                        </g>
                    </svg>
                    Back to Task
                </a>
            </div>

            <div class="w-full">
                @if($taskImage)

                    <div class="h-[40rem] md:h-[40rem] overflow-hidden">
                        <div x-data="{
            slides: [
                @foreach($taskImage as $row)
                                {
                                    imgSrc: '{{URL(\Illuminate\Support\Facades\Storage::url('images/'.$row['image']))}}',
                                    imgAlt: '{{URL(\Illuminate\Support\Facades\Storage::url('images/'.$row['image']))}}',
                                },

                 @endforeach
                                ],
                                currentSlideIndex: 1,
                                previous() {
                                    if (this.currentSlideIndex > 1) {
                                        this.currentSlideIndex = this.currentSlideIndex - 1
                                    } else {
                                        // If it's the first slide, go to the last slide
                                        this.currentSlideIndex = this.slides.length
                                    }
                                },
                                next() {
                                    if (this.currentSlideIndex < this.slides.length) {
                                        this.currentSlideIndex = this.currentSlideIndex + 1
                                    } else {
                                        // If it's the last slide, go to the first slide
                                        this.currentSlideIndex = 1
                                    }
                                },
                            }" class="relative w-full overflow-hidden">

                            <!-- previous button -->
                            <button type="button"
                                    class="absolute left-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-slate-700 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:outline-offset-0 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:bg-slate-900/60 dark:focus-visible:outline-blue-600"
                                    aria-label="previous slide" x-on:click="previous()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                                     fill="none" stroke-width="3" class="size-5 md:size-6 pr-0.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 19.5 8.25 12l7.5-7.5"/>
                                </svg>
                            </button>

                            <!-- next button -->
                            <button type="button"
                                    class="absolute right-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-slate-700 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:outline-offset-0 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:bg-slate-900/60 dark:focus-visible:outline-blue-600"
                                    aria-label="next slide" x-on:click="next()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                                     fill="none" stroke-width="3" class="size-5 md:size-6 pl-0.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                                </svg>
                            </button>

                            <!-- slides -->
                            <div class="relative h-[40rem] md:h-[40rem] w-full">
                                <template x-for="(slide, index) in slides">
                                    <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0"
                                         x-transition.opacity.duration.300ms>
                                        <img
                                            class="absolute w-full h-full inset-0 object-cover text-slate-700 dark:text-slate-300"
                                            x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt"/>
                                    </div>
                                </template>
                            </div>

                        </div>
                    </div>

                @else
                    <img
                        src="https://grcviewpoint.com/wp-content/uploads/2022/11/Time-to-Correct-A-Long-standing-Curriculum-Coding-Error-Say-Experts-GRCviewpoint.jpg"
                        class="w-full h-[45rem] object-cover rounded-lg"
                        alt="view of a coastal Mediterranean village on a hillside, with small boats in the water."/>
                @endif
            </div>

            <div>
                <div class="flex  items-center gap-1 font-medium">
                    <div>Created By : {{$taskData->user->name}} | {{$taskData->created_at->diffForHumans()}}</div>
                    <div>| Allocated To : {{\Aaran\Taskmanager\Models\Task::allocate($taskData->allocated)}}</div>
                    <div>| Priority To :</div>
                    <div
                        class="bg-yellow-200/50 text-yellow-600 px-2 rounded-full py-0.5">{{ \App\Enums\Priority::tryFrom($taskData->priority)->getName() }}</div>
                    <div>| Status :</div>
                    <div
                        class="bg-sky-200/50 text-sky-600 px-2 rounded-full py-0.5">{{ \App\Enums\Status::tryFrom($taskData->status)->getName() }}</div>
                </div>
            </div>

            <div class="text-xl text-justify p-4">{!! $taskData->body !!}</div>
            <div class="border-b-2 border-gray-400">&nbsp;</div>

            <!-- Activity ----------------------------------------------------------------------------------------->


                        <div class="w-full h-96 overflow-scroll p-5 space-y-2">
                            @foreach($list as $index=>$row)
                                <div class="bg-gray-50 border border-gray-200 p-5 space-y-2 rounded-lg">
                                    <div class="flex justify-between">
                                        <div class="text-indigo-500">By : {{$row->user->name}}
                                            | {{$row->created_at->diffForHumans()}}  </div>
                                        <div class="flex justify-center items-center gap-4 self-center">
                                            <x-button.edit wire:click="edit({{$row->id}})"/>
                                            <x-button.delete wire:click="getDelete({{$row->id}})"/>
                                        </div>
                                    </div>
                                    <div class="text-justify text-slate-700"> {!! $row->vname !!} </div>
                                </div>
                            @endforeach
                        </div>

            {{--            <!--Comments ---------------------------------------------------------------------------------------------->--}}

            <div class="space-y-5 h-[40rem]">
                <x-tabs.tab-panel >
                    <x-slot name="tabs">
                        <x-tabs.tab>Activity</x-tabs.tab>
                        <x-tabs.tab>Duration</x-tabs.tab>
                        <x-tabs.tab>Remarks</x-tabs.tab>
                    </x-slot>

                    <x-slot name="content">
                        <x-tabs.content>
                            <x-input.model-date wire:model="cdate" :label="'Date'"/>

                            <x-input.rich-text wire:model="common.vname" :placeholder="'Write your comments'"/>
                        </x-tabs.content>

                        <x-tabs.content>
                            <x-input.floating wire:model="estimated" :label="'Estimate'"/>

                            <x-input.floating wire:model="duration" :label="'Duration'"/>

                            <x-input.floating wire:model="start_on" :label="'Start_On'" type="date"/>

                            <x-input.floating wire:model="end_on" :label="'End_On'" type="date"/>
                        </x-tabs.content>

                        <x-tabs.content>
                            <x-input.floating wire:model="verified_on" :label="'Verified No'" type="date"/>

                            <x-input.floating wire:model="verified" :label="'Verified'"/>

                            <x-input.rich-text wire:model="remarks" :placeholder="'Write your remarks'"/>
                        </x-tabs.content>

                    </x-slot>
                </x-tabs.tab-panel>
                <button wire:click.prevent="save"
                        class="w-full bg-emerald-500 p-2 rounded-lg border border-gray-400 hover:bg-emerald-600 text-lg text-white font-bold tracking-wider">
                    Post Activity
                </button>
            </div>
        </div>
        <x-modal.delete/>
    </x-forms.m-panel>
</div>
