<div>

    <x-slot name="header">Projects</x-slot>

    <x-forms.m-panel>

        <x-forms.top-controls :show-filters="$showFilters"/>

        <div class="flex w-full">

            <x-table.caption :caption="'Project'">
                {{$list->count()}}
            </x-table.caption>
        </div>

        <!-- Table Header  ------------------------------------------------------------------------------------------>

        <x-table.form>

            <x-slot:table_header name="table_header" class="bg-green-100">

                <x-table.header-serial></x-table.header-serial>
                <x-table.header-text sort-icon="none">Title</x-table.header-text>
                <x-table.header-text sort-icon="none">Description</x-table.header-text>
                <x-table.header-text sort-icon="none">Started On</x-table.header-text>
                <x-table.header-action/>

            </x-slot:table_header>

            <!-- Table Body  ------------------------------------------------------------------------------------------>
            <x-slot:table_body name="table_body">

                @foreach($list as $row)

                    <x-table.row>

                        <x-table.cell-text>
                            <a href="{{route('projects.work-flows',[$row->id])}}">{{$row->id}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <a href="{{route('projects.work-flows',[$row->id])}}">{{$row->vname}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <a href="{{route('projects.work-flows',[$row->id])}}">{!! $row->description!!}</a>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <a href="{{route('projects.work-flows',[$row->id])}}">{{ date('d-m-Y',strtotime($row->vdate)) }}</a>
                        </x-table.cell-text>

                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach

            </x-slot:table_body>

        </x-table.form>
        <x-modal.delete/>

        <x-forms.create :id="$common->vid">
            <div class="space-y-4">

                <x-input.floating wire:model="common.vname" :label="'Project Title'"/>
                @error('common.vname')
                <span class="text-red-500 text-xs">{{'Need Project Title.'}}</span>
                @enderror

                <x-input.rich-text :placeholder="''" wire:model="description"/>

                <x-input.floating wire:model="vdate" type="date" :label="'Started On'"/>

            </div>
        </x-forms.create>
    </x-forms.m-panel>

</div>
