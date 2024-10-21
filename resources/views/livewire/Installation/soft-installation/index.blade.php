<div>
    <x-slot name="header">SoftWare Installation</x-slot>

    <x-forms.m-panel>

        <x-forms.top-controls :show-filters="$showFilters"/>

        <div class="flex w-full">

            <x-table.caption :caption="'Contact Details'">
                {{$soft->count()}}
            </x-table.caption>
        </div>

        <!-- Table Header  ------------------------------------------------------------------------------------------>

        <x-table.form>

            <x-slot:table_header name="table_header" class="bg-green-100">

                <x-table.header-serial></x-table.header-serial>
                <x-table.header-text sort-icon="none">Contact Name</x-table.header-text>
                <x-table.header-text sort-icon="none">Domain Url</x-table.header-text>
                <x-table.header-text sort-icon="none">DB User</x-table.header-text>
                <x-table.header-text sort-icon="none">DB Password</x-table.header-text>
                <x-table.header-text sort-icon="none">Git Url</x-table.header-text>
                <x-table.header-text sort-icon="none">Version</x-table.header-text>
                <x-table.header-text sort-icon="none">Status</x-table.header-text>
                <x-table.header-text sort-icon="none">Install Date</x-table.header-text>
                <x-table.header-action/>

            </x-slot:table_header>

            <!-- Table Body  ------------------------------------------------------------------------------------------>
            <x-slot:table_body name="table_body">

                @foreach($soft as $index=>$row)

                    <x-table.row>

                        <x-table.cell-text>
                            <a href="{{route('maintenance',[$row->id])}}">
                                {{$index+1}}
                            </a></x-table.cell-text>

                        <x-table.cell-text>
                            <a href="{{route('maintenance',[$row->id])}}">
                            {{$row->contact->vname}}</x-table.cell-text>

{{--                        <x-table.cell-text>--}}
{{--                            <a href="{{route('maintenance',[$row->id])}}">--}}
{{--                            {{$row->vname}}</x-table.cell-text>--}}

                        <x-table.cell-text>
                            <a href="{{$row->vname}}" target="_blank">
                                {{$row->vname}}
                            </a>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <a href="{{route('maintenance',[$row->id])}}">
                                {{$row->db_user}}
                            </a>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <a href="{{route('maintenance',[$row->id])}}">
                                {{$row->db_password}}
                            </a>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <a href="{{$row->git_url}}" target="_blank">
                                {{$row->git_url}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <a href="{{route('maintenance',[$row->id])}}">
                                {{$row->soft_version}}
                            </a>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <a href="{{route('maintenance',[$row->id])}}">
                                {{ \App\Enums\Status::tryFrom($row->status)->getName() }}
                            </a>
                        </x-table.cell-text>

                        <x-table.cell-text>
                            <a href="{{route('maintenance',[$row->id])}}">
                                {{ date('d-m-Y',strtotime($row->install_date)) }}
                            </a>
                        </x-table.cell-text>

                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach

            </x-slot:table_body>

            <x-modal.delete/>
        </x-table.form>

        <!-- Create  -------------------------------------------------------------------------------------------------->

        <x-forms.create :id="$common->vid">

            <div class="space-y-4">

                <!-- Contact ----------------------------------------------------------------------------------->

                <x-dropdown.wrapper label="Contact Name" type="contactTyped">
                    <div class="relative ">

                        <x-dropdown.input label="Contact Name*" id="contact_name"
                                          wire:model.live="contact_name"
                                          wire:keydown.arrow-up="decrementContact"
                                          wire:keydown.arrow-down="incrementContact"
                                          wire:keydown.enter="enterContact"/>
                        <x-dropdown.select>

                            @if($contactCollection)
                                @forelse ($contactCollection as $i => $contact)
                                    <x-dropdown.option highlight="{{ $highlightContact === $i }}"
                                                       wire:click.prevent="setContact('{{$contact->vname}}','{{$contact->id}}')">
                                        {{ $contact->vname }}
                                    </x-dropdown.option>
                                @empty
                                    <x-dropdown.new href="{{route('contacts.upsert',['0'])}}" label="Contact"/>
                                @endforelse
                            @endif

                        </x-dropdown.select>
                    </div>
                </x-dropdown.wrapper>

                <x-input.floating wire:model="common.vname" :label="'Domain Url'"/>

{{--                <x-input.floating wire:model="domain_url" :label="'Domain Url'"/>--}}

                <x-input.floating wire:model="db_user" :label="'DB Name'"/>

                <x-input.floating wire:model="db_password" :label="'DB Password'"/>

                <x-input.floating wire:model="git_url" :label="'Git Url'"/>

                <x-input.floating wire:model="soft_version" :label="'SoftWare Version'"/>

{{--                <x-input.model-select wire:model="status" :label="'Status'">--}}
{{--                    <option value="">Choose...</option>--}}
{{--                    @foreach(App\Enums\Status::cases() as $status)--}}
{{--                        <option value="{{$status->value}}">{{$status->getName()}}</option>--}}
{{--                    @endforeach--}}
{{--                </x-input.model-select>--}}

                <x-input.floating wire:model="install_date" type="date" :label="'Install Date'"/>

            </div>
        </x-forms.create>
    </x-forms.m-panel>
</div>
