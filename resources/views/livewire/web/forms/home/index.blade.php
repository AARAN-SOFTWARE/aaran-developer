<div class="flex flex-col gap-y-3">

    <x-input.floating wire:model="common.vname" :label="'Title'"/>

    <x-input.floating wire:model="desc" :label="'Description'"/>

    <x-input.floating wire:model="cover_title" :label="'Cover Title'"/>

    <x-input.floating wire:model="cover_desc" :label="'Cover Description'"/>

    <x-input.floating wire:model="test_title" :label="'Test Title'"/>

    <x-input.floating wire:model="test_desc" :label="'Test Description'"/>

    <x-input.floating wire:model="serve_title" :label="'Serve Description'"/>

    <x-input.floating wire:model="feats_title" :label="'Feats Title'"/>

    <x-input.floating wire:model="feats_desc" :label="'Feats Description'"/>

    <!-- component -->
    <x-button.save/>

</div>


