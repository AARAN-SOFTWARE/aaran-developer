<button wire:click.prevent="$set('showEditModal', false)"
    {{$attributes->merge(['class' => 'max-w-max bg-gradient-to-r from-slate-600 to-slate-500 hover:from-slate-500 hover:to-slate-600 focus:ring-2 focus:ring-offset-2
    focus:ring-slate-600 text-white sm:px-4 sm:py-2 px-2 py-1 text-[12px] inline-flex items-center gap-x-2 rounded-md tracking-widest font-semibold
    transition-all linear duration-400 '])}}>
    <x-icons.icon :icon="'chevrons-left'" class="sm:h-5 h-3 w-auto"/>
    <span class="sm:text-[16px] text-[14px]">CANCEL</span>
</button>
