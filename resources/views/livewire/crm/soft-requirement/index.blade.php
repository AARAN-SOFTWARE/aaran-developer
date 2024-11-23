<div>
    <x-slot name="header">Software RequireMents</x-slot>

    <x-forms.m-panel>

        <!-- Top Controls --------------------------------------------------------------------------------------------->
        <x-forms.top-controls :show-filters="$showFilters"/>

        <!-- Caption -------------------------------------------------------------------------------------------------->

        {{--        <div class="flex gap-3">--}}
        {{--            <x-table.caption caption="{{$module->vname}}">--}}
        {{--                {{$list->count()}}--}}
        {{--            </x-table.caption>--}}
        {{--        </div>--}}

        <x-table.form>

            <!-- Table Header ----------------------------------------------------------------------------------------->

            <x-slot:table_header name="table_header" class="bg-green-600">
                <x-table.header-serial width="20%"/>

                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}" left>
                    Client Name
                </x-table.header-text>

                <x-table.header-text sortIcon="none">
                    Software Type
                </x-table.header-text>

                <x-table.header-text sortIcon="none">
                    Plan type
                </x-table.header-text>

                <x-table.header-text sortIcon="none">
                    Service type
                </x-table.header-text>

                <x-table.header-text sortIcon="none">
                    No of Software
                </x-table.header-text>

                <x-table.header-text sortIcon="none">
                    Status
                </x-table.header-text>

                <x-table.header-text sortIcon="none">
                    Remarks
                </x-table.header-text>

                <x-table.header-action/>
            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">

{{--                @foreach($list as $index=>$row)--}}
                    <x-table.row>

                        <x-table.cell-text>1</x-table.cell-text>

                        <x-table.cell-text left><span class="capitalize">Lorem ipsum.</span></x-table.cell-text>
                        <x-table.cell-text left><span class="capitalize">Lorem ipsum.</span></x-table.cell-text>
                        <x-table.cell-text left><span class="capitalize">Lorem ipsum.</span></x-table.cell-text>
                        <x-table.cell-text left><span class="capitalize">Lorem ipsum.</span></x-table.cell-text>
                        <x-table.cell-text left><span class="capitalize">Lorem ipsum.</span></x-table.cell-text>
                        <x-table.cell-text left><span class="capitalize">Lorem ipsum.</span></x-table.cell-text>
                        <x-table.cell-text left><span class="capitalize">Lorem ipsum.</span></x-table.cell-text>


{{--                        <x-table.cell-action id="{{$row->id}}"/>--}}
                    </x-table.row>
{{--                @endforeach--}}

            </x-slot:table_body>

        </x-table.form>

        <x-modal.delete/>

{{--        <div class="pt-5">{{ $list->links() }}</div>--}}

        <!--Create Form ----------------------------------------------------------------------------------------------->
        <x-forms.create :id="$common->vid">
{{--            <div class="flex flex-col  gap-3">--}}

{{--                <x-input.floating wire:model.live="common.vname" label="Name"/>--}}
{{--                @error('common.vname')--}}
{{--                <span class="text-red-400">{{$message}}</span>--}}
{{--                @enderror--}}

{{--                @if($module->cols === 2)--}}
{{--                    <x-input.floating wire:model="desc" label="Description 1"/>--}}
{{--                @endif--}}

{{--                @if($module->cols === 3)--}}
{{--                    @if($module->id==11)--}}
{{--                        <x-input.floating wire:model="desc" label="Transport ID"/>--}}
{{--                        <x-input.floating wire:model="desc_1" label="Transport NO"/>--}}
{{--                    @else--}}
{{--                        <x-input.floating wire:model="desc" label="Description 1"/>--}}
{{--                        <x-input.floating wire:model="desc_1" label="Description 2"/>--}}
{{--                    @endif--}}
{{--                @endif--}}

{{--            </div>--}}
        </x-forms.create>
    </x-forms.m-panel>
</div>

