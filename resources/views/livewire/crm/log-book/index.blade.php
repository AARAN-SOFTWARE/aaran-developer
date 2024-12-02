<div>
    <x-slot name="header">Log Book</x-slot>

    <x-forms.m-panel>

        <x-forms.top-controls :show-filters="$showFilters"/>

        <!-- Table Header  ------------------------------------------------------------------------------------------>

        <x-table.form>

            <x-slot:table_header name="table_header" class="bg-green-100">

                <x-table.header-serial></x-table.header-serial>
                <x-table.header-text sort-icon="none">Model</x-table.header-text>
                <x-table.header-text sort-icon="none">Action</x-table.header-text>
                <x-table.header-text sort-icon="none">Description</x-table.header-text>
                <x-table.header-text sort-icon="none">User</x-table.header-text>
                <x-table.header-action/>

            </x-slot:table_header>

            <!-- Table Body  ------------------------------------------------------------------------------------------>

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>

                        <x-table.cell-text>
                            {{$row->vname}}
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <div class="line-clamp-1">
                                {{$row->action }}
                            </div>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <div class="line-clamp-1">
                                {!! $row->description !!}
                            </div>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            {{$row->user->name}}
                        </x-table.cell-text>

                        <td class=" print:hidden ">
                            <div class="flex justify-center items-center gap-4 self-center">
                                <x-button.delete  wire:click="getDelete({{$row->id}})"/>
                            </div>
                        </td>
                    </x-table.row>
                @endforeach

            </x-slot:table_body>

        </x-table.form>
        <x-modal.delete/>


        <!-- Create  -------------------------------------------------------------------------------------------------->

        <x-forms.create :id="$common->vid">

            <div class="space-y-4">

                <div>
                    <x-input.floating wire:model="common.vname" :label="'Model'"/>
                    @error('common.vname')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <x-input.floating wire:model="action" :label="'Action'"/>

                <x-input.rich-text :placeholder="'Write Something'" wire:model="description"/>

            </div>

        </x-forms.create>


    </x-forms.m-panel>
</div>
