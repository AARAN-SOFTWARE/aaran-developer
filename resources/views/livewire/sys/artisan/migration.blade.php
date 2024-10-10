<div>
    <x-slot name="header">System Config</x-slot>

    <x-forms.m-panel>

        <div class="flex flex-row gap-5 w-full">

            <div class="flex flex-col gap-3 w-1/4">
                <button wire:click.prevent="runMigration" class="px-2 py-1 bg-gray-400">Run Migration</button>

                <button wire:click.prevent="runMigrationRollBack" class="px-2 py-1 bg-gray-400">Run Migration:rollback
                </button>

                <button wire:click.prevent="clearView" class="px-2 py-1 bg-gray-400">Run view:clear</button>

                <button wire:click.prevent="storageLink" class="px-2 py-1 bg-gray-400">Storage Link</button>

                <button wire:click.prevent="storageUnLink" class="px-2 py-1 bg-gray-400">Storage UnLink</button>

                <button wire:click.prevent="runMigrationFreshSeed" class="px-2 py-1 bg-gray-400">Run Migration:fresh
                    --seed
                </button>

                <div wire:loading
                     wire:target="clearView,storageLink,storageLink,runMigrationRollBack,runMigration,runMigrationFreshSeed">
                    Work is on progress...
                </div>
            </div>

        </div>
    </x-forms.m-panel>
</div>
