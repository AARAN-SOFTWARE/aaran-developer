<div x-show="isTyped"
     x-transition:leave="transition ease-in duration-100"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     x-cloak class="" >
    <div class="absolute z-20 w-full my-2">
        <div class="block py-2 shadow-md w-full
                                rounded-lg border-transparent flex-1 appearance-none border
                                 bg-white text-gray-800 ring-1 ring-blue-600">
            <ul class="overflow-y-scroll h-44 ">
                {{$slot}}
            </ul>
        </div>
    </div>
</div>
