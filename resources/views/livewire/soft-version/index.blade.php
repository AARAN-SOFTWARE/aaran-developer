<div>
    <x-slot name="header">Soft Version</x-slot>

    <!--Header -------------------------------------------------------------------------------------------------------->

    <x-forms.m-panel>

        <x-forms.top-controls :show-filters="$showFilters"/>

        <section class="text-gray-600 body-font overflow-hidden">

            <div class="container px-5 py-8 mx-auto">

                <div class="w-full">

                    <div class="w-1/12 h-8 flex rounded-sm bg-blue-600 text-white justify-center items-center">
                        <a href="{{route('softVersion')}}"
                           class="text-lg">
                            Releases
                        </a>
                    </div>

                    @foreach($list as $index=>$row)

                        <!-- left side card --------------------------------------------------------------------------->

                        <div class="flex w-full my-10 ">

                            <div class="w-40 flex-shrink-0 flex flex-col my-5">
                                <span class="font-semibold text-2xl title-font text-gray-700 capitalize">
                                    {{$row->version}}
                                </span>

                                <span class="mt-1 text-gray-500 text-sm">
                                    {{$row->updated_at->diffForHumans()}}
                                </span>
                            </div>

                            <!-- right side card ---------------------------------------------------------------------->

                            <div class="w-10/12 border border-gray-200 p-5 h-[20rem] rounded-lg ">

                                <div class="w-full flex justify-between">
                                    <div class="font-bold text-3xl title-font text-gray-700 pb-5 capitalize">
                                        {{$row->version}}
                                    </div>

                                    <div class="text-gray-500 inline-flex gap-x-3">

                                        <button wire:click="edit({{$row->id}})"
                                                class="rounded-md ">

                                            <x-icons.icon :icon="'pencil'"
                                                          class="h-5 w-auto block text-cyan-700 hover:scale-110"/>
                                        </button>

                                        <button wire:click="getDelete({{$row->id}})"
                                                class="rounded-md ">

                                            <x-icons.icon :icon="'trash'"
                                                          class="h-5 w-auto block text-cyan-700 hover:scale-110"/>
                                        </button>
                                    </div>
                                </div>

                                <!-- Title & Body --------------------------------------------------------------------->

                                <div class="border-t border-gray-200 pt-4 flex flex-col h-44">

                                    <div class="flex flex-col space-y-3">
                                        <span
                                            class="text-2xl font-medium text-gray-900 title-font capitalize">{{$row->title}}
                                        </span>

                                        <span class="leading-relaxed line-clamp-3 h-26 ">{!! $row->body !!}</span>
                                    </div>
                                </div>

                                <div class="my-4">
                                    <a href="{{route('softVersion.show',[$row->id])}}"
                                       class="text-indigo-500 inline-flex items-center">Learn More
                                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor"
                                             stroke-width="2"
                                             fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                            <path d="M12 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    <x-modal.delete/>
                </div>
            </div>

        </section>

        <!-- Create Record -------------------------------------------------------------------------------------------->

        <x-forms.create :id="$common->vid">

            <div class="space-y-5">

                <x-input.floating wire:model="version" :label="'Version'"/>

                <x-input.floating wire:model="title" :label="'Title'"/>

                <x-input.rich-text wire:model="body" :placeholder="'Body'"/>

                <!-- Image -------------------------------------------------------------------------------------------->

                <div class="flex flex-col py-2">
                    <label for="image"
                           class="w-full text-zinc-500 tracking-wide pb-4 px-2">Image</label>
                    <div class="flex flex-wrap gap-2">
                        <div class="flex-shrink-0">
                            <div>
                                @if($image)
                                    <div
                                        class=" flex-shrink-0 border-2 border-dashed border-gray-300 p-1 rounded-lg overflow-hidden">
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
                                    <x-icons.icon :icon="'logo'" class="w-auto h-auto block "/>
                                @endif
                            </div>
                        </div>

                        <div class="relative">
                            <div>
                                <label for="image"
                                       class="text-gray-500 font-semibold text-base rounded flex flex-col items-center
                                   justify-center cursor-pointer border-2 border-gray-300 border-dashed p-2
                                   mx-auto font-[sans-serif]">
                                    <x-icons.icon icon="cloud-upload" class="w-8 h-auto block text-gray-400"/>
                                    Upload Photo
                                    <input type="file" id='image' wire:model="image" class="hidden"/>
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




