<div>
    <x-controls.lookup.model :show-model="$showModel" label="Style">
            <x-input.lookup-text  wire:model="vname" x-ref="vname" :label="'Style Name'"
                                 :name="'vname'"/>
            <x-input.lookup-text  wire:model="desc" :label="'Description'" :name="'desc'"/>
    </x-controls.lookup.model>
</div>
