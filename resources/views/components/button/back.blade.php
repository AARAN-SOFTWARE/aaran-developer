<button wire:click="getRoute"
    {{$attributes->merge(['class' => 'max-w-max bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-600 focus:ring-2 focus:ring-offset-2
    focus:ring-blue-600 text-white sm:px-4 sm:py-2 px-2 py-1 text-[12px] inline-flex items-center gap-x-2 rounded-md tracking-widest font-semibold
    transition-all linear duration-400 '])}}>
    <x-icons.icon :icon="'backward'" class="sm:h-5 h-3 w-auto"/>
    <span class="sm:text-[16px] text-[14px]">BACK</span>
</button>


