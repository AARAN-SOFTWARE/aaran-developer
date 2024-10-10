<div class="bg-[#F8F8FF]">

    <x-slot name="header">Dashboard</x-slot>

    <div class="flex-col flex gap-10 tracking-wider p-2">

        <!-- Col 1 ---------------------------------------------------------------------------------------------------->
        <div class=" bg-[#F8F8FF] gap-10 flex sm:flex-row flex-col tracking-wider rounded-lg">

            <x-web.dashboard.greetings/>

            @if(session()->get('role_id')==1|| session()->get('role_id')==2|| session()->get('role_id')==3 )
                {{--                @if(Aaran\Aadmin\Src\DbMigration::hasEntry())--}}
                <x-web.dashboard.sales :transactions="$transactions"/>
                <x-web.dashboard.cards :transactions="$transactions"/>
            @endif

        </div>

        <!-- Col 2 ---------------------------------------------------------------------------------------------------->
        <div class=" bg-[#F8F8FF] gap-10 flex sm:flex-row flex-col tracking-wider rounded-lg ">

            <x-web.dashboard.customer :contacts="$contacts"/>
            <x-web.dashboard.entries :entries="$entries"/>

            <div class="sm:w-5/12 w-auto bg-white  rounded-lg flex-col flex h-[28rem] gap-y-5 hover:shadow-md gap-y">

                <div
                    class="w-full h-[4rem] py-3 border-b border-gray-200 inline-flex items-center justify-between px-8">
                         <span class="inline-flex items-center gap-2">
                         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-cyan-600">
                          <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                        </svg>

                            <span class="font-semibold text-lg font-roboto">Recent Articles</span>
                        </span>
                    <a href="{{ route('blog') }}" class="inline-flex items-center gap-1 text-gray-500 font-semibold hover:bg-cyan-50 hover:text-cyan-600 px-2 py-1 rounded-md transition-colors duration-300 ease-out">
                        <span class="text-xs ">View All</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/>
                        </svg>
                    </a>
                </div>
                <div class="flex-col flex px-5 h-[24] overflow-y-auto gap-y-5">
                    @forelse($blogs as $row)

                        <div
                            class="w-full h-auto  flex gap-x-2 bg-gray-50 hover:bg-slate-100 rounded-md animate__animated
                            wow animate__backInRight"
                            data-wow-duration="3s">
                            <div class="h-24 w-32">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url('/images/'.$row->image) }}"
                                     class="w-full h-20" alt="">
                            </div>
                            <div class="w-4/6 flex-col flex py-1 ">
                                <div class="h-1/4 inline-flex items-center gap-x-2">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                             class="size-3">
                                        <path fill-rule="evenodd"
                                              d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                              clip-rule="evenodd"/>
                                        </svg>
                                    </span>
                                    <span class="text-xs text-gray-600">By {{$row->user->name}}</span>
                                </div>
                                <div class="3/4 flex-col flex justify-start items-start ">
                                    <div
                                        class="text-md font-semibold">{{\Illuminate\Support\Str::words($row->vname, 5)}}</div>
                                    <div class="text-xs">{{\Illuminate\Support\Str::words($row->body, 9)}}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        @for($i=0; $i<=8; $i++)
                            <div
                                class="w-full h-auto  flex gap-x-2 bg-gray-50 hover:bg-slate-100 rounded-md animate__animated wow animate__backInRight"
                                data-wow-duration="3s">
                                <div class="h-24 w-32">
                                    <img src="../../../../images/home/bg_1.webp"
                                         class="w-full h-full rounded-l-md" alt="">
                                </div>
                                <div class="w-4/6 flex-col flex py-1 ">
                                    <div class="h-1/4 inline-flex items-center gap-x-2">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                             class="size-3">
                                        <path fill-rule="evenodd"
                                              d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                              clip-rule="evenodd"/>
                                        </svg>
                                    </span>
                                        <span class="text-xs text-gray-600">By {{ Auth::user()->name }}</span>
                                    </div>
                                    <div class="3/4 flex-col flex justify-start items-start ">
                                        <div
                                            class="text-md font-semibold">Lorem ipsum dolor sit amet, consectetur.
                                        </div>
                                        <div class="text-xs"> Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Ratione, voluptas!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>

