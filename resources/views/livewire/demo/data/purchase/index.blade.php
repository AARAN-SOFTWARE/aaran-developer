<div>
{{--    <x-slot name="header">Purchase Factory</x-slot>--}}
    <div class=" w-full flex gap-5 justify-between items-center">
        <div class="w-2/3 text-md font-semibold"> Click to Create Purchase  :</div>
        <div class="w-1/3 flex justify-start">

        <x-button.primary wire:click="loadDummy">Purchase</x-button.primary>
        </div>
    </div>
</div>
