<div>
    <x-controls.lookup.model :show-model="$showModel" label="Order No">
        <x-input.lookup-text  wire:model.live="vname"  x-ref="vname" :label="'Order'" :name="'vname'"/>
        <x-input.lookup-text  wire:model.live="order_name"  x-ref="state_code" :label="'Order Name'" :name="'order_name'"/>
    </x-controls.lookup.model>
</div>
