<div class="bg-white">

    <x-slot name="header"></x-slot>

    <x-forms.m-panel>
        <div class="space-y-5 w-[20rem]">
            <x-input.floating wire:model.live="count" :label="'Count'"/>

            <div class="grid grid-cols-2 w-[20rem] space-y-3">

                <x-button.secondary wire:click="runFactoryProduct">Product</x-button.secondary>
                <x-button.secondary wire:click="runFactoryCompany">Company</x-button.secondary>
                <x-button.secondary wire:click="runFactoryContactDetail">Contact</x-button.secondary>
                <x-button.secondary wire:click="runFactoryOrder">Order</x-button.secondary>
                <x-button.secondary wire:click="runFactoryStyle">Style</x-button.secondary>
                <x-button.secondary wire:click="runFactoryTransaction">Transaction</x-button.secondary>
                <x-button.secondary wire:click="runFactorySale">Sale</x-button.secondary>
                <x-button.secondary wire:click="runFactoryPurchaseItem">Purchase</x-button.secondary>
            </div>
        </div>

    </x-forms.m-panel>
</div>
