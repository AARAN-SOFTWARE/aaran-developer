<div class=" flex overflow-hidden">
    <div class="w-2/4 h-48 ">
        <div x-data="{
            slides: [
                @foreach ($slides as $slide)
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

            <!-- Previous button -->

            <button type="button"
                    class="absolute left-1 top-20 z-20 flex rounded-full  items-center justify-center
                    bg-white/40 hover:bg-white/90"
                    aria-label="previous slide" x-on:click="previous()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                     stroke-width="3" class="size-4 pr-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                </svg>
            </button>

            <button type="button"
                    class="absolute right-1 top-20 z-20 flex rounded-full items-center justify-center
                    bg-white/40 hover:bg-white/90"
                    aria-label="previous slide" x-on:click="next()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                     stroke-width="3" class="size-4 pl-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
            </button>

            <!-- Next button -->
            <!-- Slides -->
            <div class="relative h-full w-full rounded-md">
                <template x-for="(slide, index) in slides">
                    <div x-cloak x-show="currentSlideIndex == index + 1" class=" inset-0 w-full h-full "
                         x-transition.opacity.duration.300ms>
                        <img class="absolute w-full h-44 inset-0 text-slate-700 rounded-l-md object-cover"
                             x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt"/>
                    </div>
                </template>
            </div>

        </div>
    </div>
    <div class="bg-gray-100 w-full h-44 rounded-r-md p-2 flex flex-col justify-evenly space-y-0.5">
        <div class="flex justify-between items-center h-auto space-y-1">
            <div class="inline-flex items-center text-xs text-gray-700 gap-x-2 font-semibold">
                <div class="w-5 h-5 rounded-full overflow-hidden bg-white flex justify-center  items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         class="size-4 fill-blue-700">
                        <path
                            d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z"/>
                    </svg>
                </div>
                <span>{{$createdBy}}</span>
            </div>
            <div
                class="max-w-max px-2 text-pink-800 text-xs bg-pink-100 text-pink-700 border border-pink-700 rounded-sm font-semibold">
                {{$status }}
            </div>
        </div>
        <div class="bg-white h-auto p-1.5 border rounded-sm space-y-1">
            <div class="text-sm font-semibold underline line-clamp-1">{!!  $title !!}</div>
            <div class="text-xs line-clamp-1">{!! $description !!}</div>
            <div class="text-xs flex justify-between items-center font-semibold">
                <div class="inline-flex items-center gap-x-2 text-red-800  ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3 fill-orange-600">
                        <path fill-rule="evenodd" d="M10 2.5c-1.31 0-2.526.386-3.546 1.051a.75.75 0 0 1-.82-1.256A8 8 0 0 1 18 9a22.47 22.47 0 0 1-1.228 7.351.75.75 0 1 1-1.417-.49A20.97 20.97 0 0 0 16.5 9 6.5 6.5 0 0 0 10 2.5ZM4.333 4.416a.75.75 0 0 1 .218 1.038A6.466 6.466 0 0 0 3.5 9a7.966 7.966 0 0 1-1.293 4.362.75.75 0 0 1-1.257-.819A6.466 6.466 0 0 0 2 9c0-1.61.476-3.11 1.295-4.365a.75.75 0 0 1 1.038-.219ZM10 6.12a3 3 0 0 0-3.001 3.041 11.455 11.455 0 0 1-2.697 7.24.75.75 0 0 1-1.148-.965A9.957 9.957 0 0 0 5.5 9c0-.028.002-.055.004-.082a4.5 4.5 0 0 1 8.996.084V9.15l-.005.297a.75.75 0 1 1-1.5-.034c.003-.11.004-.219.005-.328a3 3 0 0 0-3-2.965Zm0 2.13a.75.75 0 0 1 .75.75c0 3.51-1.187 6.745-3.181 9.323a.75.75 0 1 1-1.186-.918A13.687 13.687 0 0 0 9.25 9a.75.75 0 0 1 .75-.75Zm3.529 3.698a.75.75 0 0 1 .584.885 18.883 18.883 0 0 1-2.257 5.84.75.75 0 1 1-1.29-.764 17.386 17.386 0 0 0 2.078-5.377.75.75 0 0 1 .885-.584Z" clip-rule="evenodd" />
                    </svg>
                    <span >{{$allocated}}</span>
                </div>
                <div class="px-2 border border-cyan-800 bg-cyan-100 text-cyan-800 rounded-sm">{{$priority}}</div>
            </div>
            <div class="w-full inline-flex justify-between items-center">
                <a href="{{$readMoer}}" type="button"
                   class="bg-green-600 p-1 text-white font-semibold rounded-sm text-xs">
                    Read More ...</a>
                <div class="inline-flex items-center justify-between space-x-1 pt-1.5">
                    <button wire:click="edit({{$id}})"
                            class="relative group text-gray-500 transition-colors duration-200  hover:text-blue-600 focus:outline-none animate">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                        </svg>
                        <div class="absolute invisible group-hover:visible -top-9 -right-2">
                            <div class="bg-blue-600 text-white text-xs px-2 py-1 rounded-md">
                                Edit
                            </div>
                            <div
                                class="absolute left-[16px] w-0 h-0 border-l-[5px] border-l-transparent border-t-[7.5px] border-t-blue-600 border-r-[5px] border-r-transparent"></div>
                        </div>
                    </button>
                    <button wire:click="getDelete({{$id}})"
                            class="relative group text-gray-500 transition-colors duration-200  hover:text-red-500 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                        </svg>
                        <div class="absolute invisible group-hover:visible -top-9 -right-3 ">
                            <div class="bg-red-600  text-white text-xs px-2 py-1 rounded-md">
                                Delete
                            </div>
                            <div
                                class="absolute left-[25px] w-0 h-0 border-l-[5px] border-l-transparent border-t-[7.5px] border-t-red-600 border-r-[5px] border-r-transparent"></div>
                        </div>
                    </button>
                </div>
                </div>
            </div>
        </div>
    </div>

