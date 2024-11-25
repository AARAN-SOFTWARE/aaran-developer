<div>
    <x-slot name="header">Enquiry</x-slot>

    <x-forms.m-panel>

        <!-- Top Controls --------------------------------------------------------------------------------------------->
        <x-forms.top-controls :show-filters="$showFilters"/>

        <x-table.form>

            <!-- Table Header ----------------------------------------------------------------------------------------->

            <x-slot:table_header name="table_header" class="bg-green-600">
                <x-table.header-serial width="20%"/>

                <x-table.header-text wire:click.prevent="sortBy('vname')" sortIcon="{{$getListForm->sortAsc}}" left>
                    Contact
                </x-table.header-text>
                <x-table.header-text sortIcon="none">Title</x-table.header-text>
                <x-table.header-text sortIcon="none">Enquiry</x-table.header-text>
                <x-table.header-text sortIcon="none">Status</x-table.header-text>

                <x-table.header-action/>
            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">

                @foreach($list as $index=>$row)
                    <x-table.row>

                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>

                        <x-table.cell-text left>
                            <span class="capitalize">
                                <a href="{{route('leads',[$row->id])}}">
                                    {{$row->contact->vname}}</a>
                            </span>
                        </x-table.cell-text>

                        <x-table.cell-text><a href="{{route('leads',[$row->id])}}">{{$row->vname}}</a></x-table.cell-text>

                        <x-table.cell-text>
                            <a href="{{route('leads',[$row->id])}}" class="line-clamp-1">
                            {!!  \Illuminate\Support\Str::words($row->body,14) !!}
                            </a></x-table.cell-text>


{{--                        <x-table.cell-text>{{$row->status_id}}</x-table.cell-text>--}}
                        <x-table.cell-text class="{{App\Enums\Status::tryFrom($row->status_id)->getStyle()}}" center>
                            {{App\Enums\Status::tryFrom($row->status_id)->getName()}}
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

                <!-- Party Name --------------------------------------------------------------------------------------->
                <x-dropdown.wrapper label="Party Name" type="contactTyped">
                    <div class="relative ">
                        <x-dropdown.input label="Party Name" id="contact_name"
                                          wire:model.live="contact_name"
                                          wire:keydown.arrow-up="decrementContact"
                                          wire:keydown.arrow-down="incrementContact"
                                          wire:keydown.enter="enterContact"/>
                        @error('contact_id')
                        <span class="text-red-500">{{'The Party Name is Required.'}}</span>
                        @enderror
                        <x-dropdown.select>
                            @if($contactCollection)
                                @forelse ($contactCollection as $i => $contact)
                                    <x-dropdown.option highlight="{{$highlightContact === $i  }}"
                                                       wire:click.prevent="setContact('{{$contact->vname}}','{{$contact->id}}')">
                                        {{ $contact->vname }}
                                    </x-dropdown.option>
                                @empty
                                    <x-dropdown.new href="{{route('contacts.upsert',['0'])}}" label="Party"/>
                                @endforelse
                            @endif
                        </x-dropdown.select>
                    </div>
                </x-dropdown.wrapper>
                @error('contact_name')
                <span class="text-red-400">{{$message}}</span>@enderror

                <x-input.floating wire:model="common.vname" :label="'Title'"/>

                <x-input.rich-text wire:model="body" :placeholder="'Write the issues'"/>

                <x-input.model-select wire:model="status_id" :label="'Status'">
                    <option value="">Choose...</option>
                    @foreach(App\Enums\Status::cases() as $status)
                        <option value="{{$status->value}}">{{$status->getName()}}</option>
                    @endforeach
                </x-input.model-select>

            </div>
        </x-forms.create>
    </x-forms.m-panel>
</div>
