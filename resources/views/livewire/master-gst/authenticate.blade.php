<div>
    <x-slot name="header">Gst Authenticate</x-slot>
    <x-forms.m-panel>
        <form wire:submit.prevent="authenticate">
            <div>
                <x-input.model-text wire:model="email" :label="'Email Address:'"/>
            </div>
            <button type="submit" class="rounded-lg bg-green-500 p-2 text-white hover:bg-green-400">Authenticate</button>
        </form>

        @if (session()->has('gst_auth_token'))
            <p class="text-green-500">Authenticated successfully!</p>
        @endif
    </x-forms.m-panel>
</div>
