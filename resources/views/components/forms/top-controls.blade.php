@props([
'showFilters'=>false,
])

<div class="flex sm:flex-row sm:justify-between sm:items-center  flex-col gap-6 py-4 print:hidden">
    <div class="w-2/4 flex items-center space-x-2">

        <x-input.search-bar wire:model.live="getListForm.searches"
                            wire:keydown.escape="$set('getListForm.searches', '')" label="Search"/>
        {{--        <x-icons.search-new wire:model.live="getListForm.searches"/>--}}
        <x-input.toggle-filter :show-filters="$showFilters"/>
    </div>

    <div class="flex sm:justify-center justify-between">
        <x-forms.per-page/>
        {{--        <x-button.new/>--}}
        <div class="self-end">
            <x-button.new-x wire:click="create"/>
        </div>
    </div>
</div>
<x-input.advance-search :show-filters="$showFilters"/>
