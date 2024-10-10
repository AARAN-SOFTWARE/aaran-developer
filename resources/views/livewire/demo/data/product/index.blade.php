<div>
    {{--    <x-slot name="header">Product Factory</x-slot>--}}
    <div class="w-full flex gap-5 justify-center items-center">
        <div class="w-2/3 text-md font-semibold">click to Create Products :</div>
        <div class="w-1/3 flex justify-start">
            <x-button.primary wire:click="loadDummy">Product</x-button.primary>
        </div>
    </div>
</div>
