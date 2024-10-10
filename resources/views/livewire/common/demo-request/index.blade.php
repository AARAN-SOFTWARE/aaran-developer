<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <x-slot name="header">Demo Request</x-slot>

    <x-forms.m-panel>

        <x-forms.top-controls :show-filters="$showFilters"/>

        <x-table.caption :caption="'Demo Request'">
            {{$list->count()}}
        </x-table.caption>

        <x-table.form>
            <x-slot:table_header name="table_header" class="bg-purple-100">

                <x-table.header-serial></x-table.header-serial>

                <x-table.header-text wire:click.prevent="sortBy('id')" sort-icon="{{$getListForm->sortAsc}}">vname
                </x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('id')" sort-icon="{{$getListForm->sortAsc}}">phone
                </x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('id')" sort-icon="{{$getListForm->sortAsc}}">email
                </x-table.header-text>
                <x-table.header-text>subject</x-table.header-text>
                <x-table.header-text>message</x-table.header-text>
                <x-table.header-text>Status</x-table.header-text>
                <x-table.header-action/>

            </x-slot:table_header>

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)

                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->vname}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->phone}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->email}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->subject}}</x-table.cell-text>
                        <x-table.cell-text>{{$row->message}}</x-table.cell-text>
                        <x-table.cell-status active="{{$row->active_id}}"/>
                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach
            </x-slot:table_body>

        </x-table.form>
        <x-modal.delete/>
        <div class="pt-5">{{ $list->links() }}</div>

        <!-- Create  -------------------------------------------------------------------------------------------------->

        <x-forms.create :id="$common->vid">

            <div class="flex flex-col gap-3">
                <x-input.floating wire:model="common.vname" label="Name"/>
                <x-input.floating wire:model="phone" label="Phone"/>
                <x-input.floating wire:model="email" label="Email"/>
                <x-input.floating wire:model="subject" label="Subject"/>
                <x-input.floating wire:model="message" label="Message"/>
            </div>

        </x-forms.create>


    </x-forms.m-panel>
</div>
