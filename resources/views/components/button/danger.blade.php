<button type="submit"
    {{$attributes->merge(['class' => 'max-w-max bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-600 focus:ring-2 focus:ring-offset-2
    focus:ring-red-600 text-white sm:px-4 sm:py-2 px-2 py-1 text-[12px] inline-flex items-center gap-x-2 rounded-md tracking-widest font-semibold
    transition-all linear duration-400 '])}}>
    <x-icons.icon :icon="'trash'" class="sm:h-5 h-3 w-auto"/>
    <span>DELETE</span>
</button>
