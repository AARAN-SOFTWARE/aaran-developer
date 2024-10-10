@props([
    'id',
    'maxWidth' => '2xl',
    'attributes'=>null
])

<form wire:submit.prevent="save">
    <div class="w-full h-auto">
        <x-jet.modal wire:model.defer="showEditModal" maxWidth="{{{$maxWidth}}}" >
            <div class="sm:px-6 px-2 pt-4">
                <div class="text-lg">
                    {{$id === "" ? 'New Entry' : 'Edit Entry'}}
                </div>
                <x-forms.section-border class="py-2"/>
                <div class="mt-5">
                    {{$slot}}
                </div>
                <div class="mb-1">&nbsp;</div>
            </div>
            <div class="sm:px-6 px-3 py-3 bg-gray-100 text-right">
                <div class="w-full flex justify-between gap-3">
                    <div class="py-2">
                        <label for="common.active_id" class="inline-flex relative items-center cursor-pointer">
                            <input type="checkbox" id="common.active_id" class="sr-only peer"
                                   wire:model="common.active_id">
                            <div
                                class="w-10 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2
                                        peer-focus:ring-blue-300
                                         peer-checked:after:translate-x-full peer-checked:after:border-white
                                         after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300
                                         after:border after:rounded-full after:h-4 after:w-4 after:transition-all
                                         peer-checked:bg-blue-600"></div>
                            <span class="ml-3 sm:text-sm text-xs font-medium text-gray-900">Active</span>
                        </label>
                    </div>
                    <div class="flex gap-3">
{{--                        <x-button.cancel/>--}}
                        <x-button.cancel-x wire:click.prevent="$set('showEditModal', false)" {{$attributes}} />
{{--                        <x-button.save/>--}}
                        <x-button.save-x  wire:click.prevent="save" />
                    </div>
                </div>
            </div>
        </x-jet.modal>
    </div>
</form>
