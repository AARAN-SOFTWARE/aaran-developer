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
                    Name
                </x-table.header-text>
                <x-table.header-text sortIcon="none">Mobile Number</x-table.header-text>
                <x-table.header-text sortIcon="none">Whatsapp</x-table.header-text>
                <x-table.header-text sortIcon="none">Email</x-table.header-text>
                <x-table.header-text sortIcon="none">Enquiry</x-table.header-text>
                <x-table.header-action/>
            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">
                @foreach($enquiries as $index=>$row)

                    <x-table.row>

                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>

{{--                        <x-table.cell-text left>--}}
{{--                            <span class="capitalize">--}}
{{--                                <a href="{{route('leads',[$row->id])}}">--}}
{{--                                    {{$row->contact->vname}}</a>--}}
{{--                            </span>--}}
{{--                        </x-table.cell-text>--}}

                        <x-table.cell-text><a href="{{route('leads.fresh', $row->id)}}">{{$row->contact_person}}</a>
                        </x-table.cell-text>

                        <x-table.cell-text><a href="">{{$row->vname}}</a>
                        </x-table.cell-text>
                        {{----}}

                        <x-table.cell-text> {{$row->whatsapp}}
                        </x-table.cell-text>

                        <x-table.cell-text> {{$row->email}}
                        </x-table.cell-text>
                        {{----}}
                        <x-table.cell-text>
                            <a href="{{route('leads',[$row->id])}}" class="line-clamp-1">
                                {!!  \Illuminate\Support\Str::words($row->body,14) !!}
                            </a></x-table.cell-text>


                        {{--                        <x-table.cell-text>{{$row->status_id}}</x-table.cell-text>--}}
{{--                        <x-table.cell-text class="{{App\Enums\Status::tryFrom($row->status_id)->getStyle()}}" center>--}}
{{--                            {{App\Enums\Status::tryFrom($row->status_id)->getName()}}--}}
{{--                        </x-table.cell-text>--}}

{{--                      <td>--}}
{{--                          <div class="flex justify-center items-center sm:gap-4 gap-2 px-1 self-center">--}}
{{--                              <a href="{{route('enquiry',[$row->id])}}" class="pt-1">--}}
{{--                                  <x-button.edit/>--}}
{{--                              </a>--}}
{{--                              <x-button.delete wire:click="getDelete({{$row->id}})"/>--}}

{{--                          </div>--}}
{{--                      </td>--}}

                        <x-table.cell-action id="{{$row->id}}"/>
                    </x-table.row>
                @endforeach
            </x-slot:table_body>

        </x-table.form>
        <x-modal.delete/>

        <!-- Create  -------------------------------------------------------------------------------------------------->

        <x-forms.create :id="$common->vid">

            <div class="space-y-4">

                {{--Name--}}
                <div>
                    <x-input.floating wire:model="contact_person" :label="'Name'"/>
                    @error('contact_person')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                {{--Mobile--}}
                <div>
                    <x-input.floating wire:model.lazy="common.vname"  :label="'Mobile'"/>
                    @error('common.vname')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror

                    {{-- Confirmation Message --}}
                    @if($showConfirmation)
                        <div class="bg-yellow-100 text-yellow-700 p-2 mt-2 rounded">
                            Mobile number already exists. Do you want to autofill the data?
                            <div class="flex space-x-2 mt-2">
                                <button
                                    type="button"
                                    wire:click="autofill"
                                    class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                    Yes
                                </button>
                                <button
                                    type="button"
                                    wire:click="$set('showConfirmation', false)"
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                    No
                                </button>
                            </div>
                        </div>
                    @endif

                </div>

                {{--Whatsapp--}}
                <div>
                    <x-input.floating wire:model="whatsapp" :label="'Whatsapp Number'"/>
                    @error('whatsapp')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                {{--Email--}}
                <div>
                    <x-input.floating wire:model="email" :label="'Mail'"/>
                    @error('email')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                {{--Enquiry--}}
                <div>
                    <x-input.rich-text wire:model="body" :placeholder="'Write Your Enquiries'"/>
                    @error('body')
                    <div class="text-xs text-red-500">
                        {{$message}}
                    </div>
                    @enderror
                </div>

            </div>
        </x-forms.create>

{{--         Pagination Here --}}
        <div class="pt-5">{{ $enquiries->links() }}</div>


    </x-forms.m-panel>

</div>
