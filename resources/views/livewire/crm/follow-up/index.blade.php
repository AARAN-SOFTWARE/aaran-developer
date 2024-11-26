<div>
    <x-slot name="header">Follow Ups</x-slot>

    <x-forms.m-panel>

        <!-- Top Controls --------------------------------------------------------------------------------------------->
        <x-forms.top-controls :show-filters="$showFilters"/>


        <x-table.form>

            <!-- Table Header ----------------------------------------------------------------------------------------->

            <x-slot:table_header name="table_header" class="bg-green-600">
                <x-table.header-serial width="20%"/>
                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}" center="">
                    Level
                </x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}" center="">
                    Description
                </x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}" center="">
                    Action
                </x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}" center="">
                    Status
                </x-table.header-text>
                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}" center="">
                    Priority
                </x-table.header-text>

                <x-table.header-action/>
            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">
                @foreach($list as $index=>$row)
                    <x-table.row>
                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>
                        <x-table.cell-text left><span class="capitalize">{{$row->vname}}</span></x-table.cell-text>
                        <x-table.cell-text left><span class="capitalize">{!!  $row->body !!}</span></x-table.cell-text>
                        <x-table.cell-text left><span class="capitalize">{{$row->action->vname}}</span></x-table.cell-text>
                        <x-table.cell-text class="{{App\Enums\Status::tryFrom($row->status_id)->getStyle()}}" center>
                            {{App\Enums\Status::tryFrom($row->status_id)->getName()}}
                        </x-table.cell-text>
                        <x-table.cell-text class="{{App\Enums\Priority::tryFrom($row->priority_id)->getStyle()}}" center>
                            {{App\Enums\Priority::tryFrom($row->priority_id)->getName()}}
                        </x-table.cell-text>
                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach
            </x-slot:table_body>
        </x-table.form>

        <x-modal.delete/>

        <div class="pt-5">{{ $list->links() }}</div>

        <!--Create Form ----------------------------------------------------------------------------------------------->
        <x-forms.create :id="$common->vid">
            <div class="flex flex-col  gap-3">



                <x-input.floating wire:model.live="common.vname" label="Level"/>
                @error('common.vname')
                <span class="text-red-400">{{$message}}</span>
                @enderror

                <x-dropdown.wrapper label="Action" type="actionTyped">
                    <div class="relative">
                        <x-dropdown.input label="Action" id="action_name"
                                          wire:model.live="action_name"
                                          wire:keydown.arrow-up="decrementAction"
                                          wire:keydown.arrow-down="incrementAction"
                                          wire:keydown.enter="enterAction"/>
                        <x-dropdown.select>
                            @if($actionCollection)
                                @forelse ($actionCollection as $i => $action)
                                    <x-dropdown.option highlight="{{$highlightAction === $i}}"
                                                       wire:click.prevent="setAction('{{$action->vname}}','{{$action->id}}')">
                                        {{ $action->vname }}
                                    </x-dropdown.option>
                                @empty
                                    <x-dropdown.create wire:click.prevent="actionSave('{{$action_name}}')" label="Action" />
                                @endforelse
                            @endif
                        </x-dropdown.select>
                    </div>
                </x-dropdown.wrapper>
                @error('action_name')
                <span class="text-red-400">{{$message}}</span>
                @enderror
                <x-input.rich-text wire:model="body" :placeholder="'Summarize your Action'"/>
{{--                <x-input.floating wire:model="action" :placeholder="'Action'"/>--}}
{{--                @error('common.action')--}}
{{--                <span class="text-red-400">{{$message}}</span>--}}
{{--                @enderror--}}
                <x-input.model-select wire:model="status_id" :label="'Status'">
                    <option value="">Choose...</option>
                    @foreach(App\Enums\Status::cases() as $status)
                        <option value="{{$status->value}}">{{$status->getName()}}</option>
                    @endforeach
                </x-input.model-select>
                <x-input.model-select wire:model="priority_id" :label="'Status'">
                    <option value="">Choose...</option>
                    @foreach(App\Enums\Priority::cases() as $priorities)
                        <option value="{{$priorities->value}}">{{$priorities->getName()}}</option>
                    @endforeach
                </x-input.model-select>

            </div>
        </x-forms.create>
    </x-forms.m-panel>
</div>
