<div>
    <x-slot name="header">HomeSlide</x-slot>

    <x-forms.m-panel>

        <!-- Top Controls --------------------------------------------------------------------------------------------->
        <x-forms.top-controls :show-filters="$showFilters"/>

        <x-table.caption :caption="'Slides Content'">
            {{$list->count()}}
        </x-table.caption>

        <!-- Table Header --------------------------------------------------------------------------------------------->
        <x-table.form>
            <x-slot:table_header name="table_header" class="bg-green-100">

                <x-table.header-serial width="20%"/>

                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">Title
                </x-table.header-text>

                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Description
                </x-table.header-text>

                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">Link
                </x-table.header-text>

                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">
                    Background Image
                </x-table.header-text>

                {{--                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}">Content--}}
                {{--                    Image--}}
                {{--                </x-table.header-text>--}}

                <x-table.header-action/>

            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">

                @forelse($list as $index=>$row)
                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->vname}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->description}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->link}}</x-table.cell-text>
                        <x-table.cell-text>
                            <div class="flex-shrink-0 h-12 w-12 rounded-xl mx-auto mt-2">

                                <img src="{{ \Illuminate\Support\Facades\Storage::url('/images/'.$row->bg_image) }}"
                                     alt=""/>
                            </div>
                        </x-table.cell-text>
                        {{--                        <x-table.cell-text>--}}
                        {{--                            <div class="flex-shrink-0 h-12 w-12 rounded-xl mx-auto mt-2">--}}
                        {{--                                <img src="{{ \Illuminate\Support\Facades\Storage::url('/images/'.$row->cont_image)}}"--}}
                        {{--                                     alt="{{$row->cont_image}}"/>--}}
                        {{--                            </div>--}}
                        {{--                        </x-table.cell-text>--}}
                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @empty
                    <x-table.cell-empty/>
                @endforelse
            </x-slot:table_body>
        </x-table.form>

        <x-modal.delete/>

        <div class="pt-5">{{ $list->links() }}</div>

        <!-- Create  -------------------------------------------------------------------------------------------------->

        <x-forms.create :id="$common->vid">

            <div class="flex flex-col  gap-3">
                <x-input.floating wire:model="common.vname" label="Title"/>
                {{--                <x-input.model-text wire:model="common.vname" :label="'Title'"/>--}}
                @error('common.vname')
                <span class="text-red-400">{{ $message }}</span>
                @enderror
                <x-input.floating wire:model="description" label="Description"/>
                {{--                <x-input.model-text wire:model="description" :label="'Description'"/>--}}
                <x-input.floating wire:model="link" label="Link"/>
                {{--                <x-input.model-text wire:model="link" :label="'Link'"/>--}}
                <!-- Bg Image --------------------------------------------------------------------------------->

                <div class="flex flex-col py-2">
                    <label for="bg_image"
                           class="w-full text-zinc-500 tracking-wide pb-4 px-2">Background Image</label>
                    <div class="flex flex-wrap gap-2">
                        <div class="flex-shrink-0">
                            <div>
                                @if($bg_image)
                                    <div
                                        class=" flex-shrink-0 border-2 border-dashed border-gray-300 p-1 rounded-lg overflow-hidden">
                                        <img
                                            class="w-[156px] h-[89px] rounded-lg hover:brightness-110 hover:scale-105 duration-300 transition-all ease-out"
                                            src="{{ $bg_image->temporaryUrl() }}"
                                            alt="{{$bg_image?:''}}"/>
                                    </div>
                                @endif

                                @if(!$bg_image && isset($bg_image))
                                    <img class="h-24 w-full"
                                         src="{{URL(\Illuminate\Support\Facades\Storage::url('images/'.$old_bg_image))}}"
                                         alt="">
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
                                    <input type="file" id='bg_image' wire:model="bg_image" class="hidden"/>
                                    <p class="text-xs font-light text-gray-400 mt-2">PNG and JPG are
                                        Allowed.</p>
                                </label>
                            </div>

                            <div wire:loading wire:target="bg_image" class="z-10 absolute top-6 left-12">
                                <div class="w-14 h-14 rounded-full animate-spin
                                                         border-y-4 border-dashed border-green-500 border-t-transparent"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Image------------------------------------------------------------------------->

                {{--                    <div class="flex flex-row gap-6">--}}
                {{--                        <div class="flex">--}}

                {{--                            <label for="bg_image"--}}
                {{--                                   class="w-[10rem] text-zinc-500 tracking-wide py-2">Image</label>--}}

                {{--                            <div class="flex-shrink-0">--}}

                {{--                                <div>--}}
                {{--                                    @if($cont_image)--}}
                {{--                                        <div class="flex-shrink-0 ">--}}
                {{--                                            <img class="h-24 w-full" src="{{ $cont_image->temporaryUrl() }}"--}}
                {{--                                                 alt="{{$cont_image?:''}}"/>--}}
                {{--                                        </div>--}}
                {{--                                    @endif--}}

                {{--                                    @if(!$cont_image && isset($cont_image))--}}
                {{--                                        <img class="h-24 w-full"--}}
                {{--                                             src="{{URL(\Illuminate\Support\Facades\Storage::url('images/'.$old_cont_image))}}"--}}
                {{--                                             alt="">--}}

                {{--                                    @else--}}
                {{--                                        <x-icons.icon :icon="'logo'" class="w-auto h-auto block "/>--}}
                {{--                                    @endif--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}

                {{--                        <div class="relative">--}}

                {{--                            <div>--}}
                {{--                                <label for="cont_image"--}}
                {{--                                       class="text-gray-500 font-semibold text-base rounded flex flex-col items-center--}}
                {{--                                   justify-center cursor-pointer border-2 border-gray-300 border-dashed p-2--}}
                {{--                                   mx-auto font-[sans-serif]">--}}
                {{--                                    <x-icons.icon icon="cloud-upload"--}}
                {{--                                                  class="w-8 h-auto block text-gray-400"/>--}}
                {{--                                    Upload Photo--}}

                {{--                                    <input type="file" id='cont_image' wire:model="cont_image" class="hidden"/>--}}
                {{--                                    <p class="text-xs font-light text-gray-400 mt-2">PNG and JPG are--}}
                {{--                                        Allowed.</p>--}}
                {{--                                </label>--}}
                {{--                            </div>--}}

                {{--                            <div wire:loading wire:target="cont_image" class="z-10 absolute top-6 left-12">--}}
                {{--                                <div class="w-14 h-14 rounded-full animate-spin--}}
                {{--                                                        border-y-4 border-dashed border-green-500 border-t-transparent"></div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
            </div>
        </x-forms.create>

    </x-forms.m-panel>
</div>

