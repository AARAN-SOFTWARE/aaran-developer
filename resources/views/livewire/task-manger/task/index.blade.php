<div>
    <x-slot name="header">Task</x-slot>

    <x-forms.m-panel>

        <!--Top Controls ---------------------------------------------------------------------------------------------->

        <x-forms.top-controls :show-filters="$showFilters"/>

        <div class="flex flex-col sm:grid grid-cols-4 w-full gap-10">
            @foreach($list as $index=>$row)

                <article
                    class="flex rounded-xl max-w-sm flex-col overflow-hidden border border-slate-300 bg-slate-100 text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                    <div class="h-44 md:h-64 overflow-hidden">
                        @if($row->image!=='no_image')
                            <img src="{{URL(\Illuminate\Support\Facades\Storage::url('images/'.$row->image))}}"
                                 class="w-full h-full object-cover transition duration-700 ease-out hover:scale-105"
                                 alt="view of a coastal Mediterranean village on a hillside, with small boats in the water."/>
                        @else
                            <img
                                src="https://grcviewpoint.com/wp-content/uploads/2022/11/Time-to-Correct-A-Long-standing-Curriculum-Coding-Error-Say-Experts-GRCviewpoint.jpg"
                                class="object-cover transition duration-700 ease-out hover:scale-105"
                                alt="view of a coastal Mediterranean village on a hillside, with small boats in the water."/>
                        @endif
                    </div>

                    <!--Card Content ---------------------------------------------------------------------------------->

                    <div class="flex flex-col gap-4 p-6">
                        <div class="flex justify-between">
                            <div class="flex items-center gap-1 font-medium">
                            <span class="text-xl">
                            {{$row->id}}.
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="size-6">
                                    <path fill-rule="evenodd"
                                          d="M14.615 1.595a.75.75 0 0 1 .359.852L12.982 9.75h7.268a.75.75 0 0 1 .548 1.262l-10.5 11.25a.75.75 0 0 1-1.272-.71l1.992-7.302H3.75a.75.75 0 0 1-.548-1.262l10.5-11.25a.75.75 0 0 1 .913-.143Z"
                                          clip-rule="evenodd"/>
                                </svg>

                                <span>
                                    {{ \App\Enums\Status::tryFrom($row->status)->getName() }}
                                | {{\Aaran\Taskmanager\Models\Task::allocate($row->allocated)}}
                            </span>
                            </div>

                            <!--Edit & Delete ------------------------------------------------------------------------->

                            <div class="flex justify-center items-center gap-4 self-center">
                                <x-button.edit wire:click="edit({{$row->id}})"/>
                                <x-button.delete wire:click="getDelete({{$row->id}})"/>
                            </div>
                        </div>

                        <!--Title & Body ------------------------------------------------------------------------------>

                        <h3 class="text-balance text-xl lg:text-2xl font-bold text-black dark:text-white"
                            aria-describedby="tripDescription">{{\Illuminate\Support\Str::words($row->vname,2)}}</h3>

                        <p id="tripDescription" class="text-pretty text-sm mb-2">
                            {!!\Illuminate\Support\Str::words( $row->body,25 )!!}
                        </p>

                        <a href="{{route('task.upsert',[$row->id])}}">
                            <button type="button"
                                    class="cursor-pointer whitespace-nowrap bg-blue-700 px-4 py-2 text-center mt-2
                            text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75
                            focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                            focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0
                            dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600 rounded-xl">Read
                                More
                            </button>
                        </a>

                    </div>
                </article>

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
                <div class="flex flex-col py-2">
                    <label for="bg_image"
                           class="w-full text-zinc-500 tracking-wide pb-4 px-2">Image</label>

                    <div class="flex flex-wrap sm:gap-6 gap-2">
                        <div class="flex-shrink-0">
                            <div>
                                @if($image)
                                    <div
                                        class=" flex-shrink-0 bg-blue-100 p-1 rounded-lg overflow-hidden">
                                        <img
                                            class="w-[156px] h-[89px] rounded-lg hover:brightness-110 hover:scale-105 duration-300 transition-all ease-out"
                                            src="{{ $image->temporaryUrl() }}"
                                            alt="{{$image?:''}}"/>
                                    </div>
                                @endif

                                @if(!$image && isset($image))
                                    <img class="h-24 w-full"
                                         src="{{URL(\Illuminate\Support\Facades\Storage::url('images/'.$old_image))}}"
                                         alt="">
                                @else
                                    <x-icons.icon :icon="'image'" class="w-auto h-auto block "/>
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
                                    <input type="file" id='bg_image' wire:model="image" class="hidden"/>
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

                <x-input.model-select wire:model="allocated" :label="'Allocated'">
                    <option value="">Choose...</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </x-input.model-select>

                <x-input.model-select wire:model="status" :label="'Status'">
                    <option value="">Choose...</option>
                    @foreach(App\Enums\Status::cases() as $status)
                        <option value="{{$status->value}}">{{$status->getName()}}</option>
                    @endforeach
                </x-input.model-select>
            </div>
        </div>
    </x-forms.create>

</div>
