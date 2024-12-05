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
{{--                <x-table.header-text sortIcon="none">Title</x-table.header-text>--}}
                {{----}}
                <x-table.header-text sortIcon="none">Mobile Number</x-table.header-text>
                <x-table.header-text sortIcon="none">Whatsapp</x-table.header-text>
                <x-table.header-text sortIcon="none">Email</x-table.header-text>
                {{----}}
                <x-table.header-text sortIcon="none">Enquiry</x-table.header-text>
{{--                <x-table.header-text sortIcon="none">Status</x-table.header-text>--}}
                <x-table.header-action/>
            </x-slot:table_header>

            <!-- Table Body ------------------------------------------------------------------------------------------->

            <x-slot:table_body name="table_body">
                @foreach($enquiries as $index=>$row)

                    <x-table.row>

                        <x-table.cell-text>{{$index+1}}</x-table.cell-text>

                        <x-table.cell-text left>
                            <span class="capitalize">
                                <a href="{{route('leads',[$row->id])}}">
                                    {{$row->contact->vname}}</a>
                            </span>
                        </x-table.cell-text>

                        <x-table.cell-text><a href="{{route('leads',[$row->id])}}">{{$row->vname}}</a>
                        </x-table.cell-text>
                        {{----}}
                        <x-table.cell-text> {{$row->mobile}}
                        </x-table.cell-text>

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
                      <td>
                          <div class="flex justify-center items-center sm:gap-4 gap-2 px-1 self-center">
                              <a href="{{route('enquiries.upsert',[$row->id])}}" class="pt-1">
                                  <x-button.edit/>
                              </a>
                              <x-button.delete wire:click="getDelete({{$row->id}})"/>

                          </div>
                      </td>



                    </x-table.row>
                @endforeach

            </x-slot:table_body>

        </x-table.form>

        <x-modal.delete/>

        <div class="pt-5">{{ $enquiries->links() }}</div>


    </x-forms.m-panel>

</div>
