<div>
    <x-slot name="header">Follow Ups</x-slot>

    <x-forms.m-panel>

        <!-- Top Controls --------------------------------------------------------------------------------------------->
        <x-forms.top-controls :show-filters="$showFilters"/>

        <x-table.form>

            <!-- Table Header ----------------------------------------------------------------------------------------->

            <x-slot:table_header name="table_header" class="bg-green-600">
                <x-table.header-text sortIcon="none">FollowUp No</x-table.header-text>
                <x-table.header-text sortIcon="none">Leader</x-table.header-text>
                <x-table.header-text sortIcon="none">Feature</x-table.header-text>
                <x-table.header-text sortIcon="none">Responsible Team Members</x-table.header-text>
                <x-table.header-text sortIcon="none">Status</x-table.header-text>
                <x-table.header-text sortIcon="none">Report</x-table.header-text>
                <x-table.header-text sortIcon="none">Verified By</x-table.header-text>
                <x-table.header-action/>
            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">
                @foreach($followups as $index=>$row)

                    <x-table.row>

{{--                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>--}}

                        <x-table.cell-text><a href="">{{$row->vname}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text> {{$row->lead->name}}
                        </x-table.cell-text>

                        <x-table.cell-text> {{$row->feature}}
                        </x-table.cell-text>

                        <x-table.cell-text> {{$row->team_members}}
                        </x-table.cell-text>



                        <x-table.cell-text>
                            <span class="{{ $row->status === 'Ongoing' ? 'text-orange-500' : ($row->status === 'Completed' ? 'text-green-500' : '') }}">
                                {{ $row->status }}
                            </span>
                        </x-table.cell-text>


                        <x-table.cell-text>
                            {!! $row->body !!}
                        </x-table.cell-text>

                        <x-table.cell-text>
                            {{$row->verified->name}}
                        </x-table.cell-text>

                        <x-table.cell-action id="{{$row->id}}"/>

                    </x-table.row>

                @endforeach


            </x-slot:table_body>

        </x-table.form>




        <!-- Create  -------------------------------------------------------------------------------------------------->

        <x-forms.create :max-width="'2xl'" :id="$common->vid">

            <div class="space-y-4">

{{--                Followup No--}}
                <div>
                    <x-input.floating wire:model.lazy="common.vname"  :label="'Followup No'"/>
                    @error('common.vname')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>

{{--                Leader --}}
                <div>
                    <x-input.model-select wire:model="lead_id" :label="'Leader Name'">
                        <option value="">Choose...</option>
                        @foreach(\App\Models\User::all() as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </x-input.model-select>
                </div>


{{--                Feature--}}
                <div>
                    <x-input.floating wire:model="feature" :label="'Feature You are Working on..'"/>
                    @error('feature')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>


{{--                Team Members--}}
                <div>
                    <x-input.floating wire:model="team_members" :label="'Responsible Team Members'"/>
                    @error('team_members')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div>
                    <x-input.model-select wire:model="status" :label="'Status'">
                        <option value="">Choose...</option>
                        <option value="Ongoing">Ongoing..</option>
                        <option value="Completed">Completed</option>
                    </x-input.model-select>
                    @error('status')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>


{{--                Report --}}
                <div class="mt-3">
                    <x-input.rich-text :placeholder="'Write your Reports Here'" wire:model="body"/>
                    @error('report')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>

 {{--                Verified By --}}

                <div class="">
                    <x-input.model-select wire:model="verified_by" :label="'Verified By'">
                        <option value="">Choose...</option>
                        @foreach(\App\Models\User::all() as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </x-input.model-select>
                </div>

            </div>


        </x-forms.create>

{{--         Pagination Here--}}
{{--        <div class="pt-5">{{ $followups->links() }}</div>--}}


    </x-forms.m-panel>

    <x-modal.delete/>



</div>
