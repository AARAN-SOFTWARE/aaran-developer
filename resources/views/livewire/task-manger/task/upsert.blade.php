<div>
    <x-slot name="header">Task</x-slot>
    {{--    {{dd($taskData)}}--}}

    <!-- Top Control ------------------------------------------------------------------------------------------------>

    <x-forms.m-panel>
        <div class="max-w-7xl mx-auto p-10 space-y-8">

            <div class="inline-flex">
                <div class="text-5xl">{{$taskData->id}}.</div>

                <div class="text-5xl font-bold tracking-wider">{{$taskData->vname}}</div>

            </div>

            <div class="hidden lg:flex justify-between mb-6">
                <a href="{{route('task')}}"
                   class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                    <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                        <g fill="none" fill-rule="evenodd">
                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5"
                                  d="M21 1v20.16H.84V1z">
                            </path>
                            <path class="fill-current"
                                  d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                            </path>
                        </g>
                    </svg>
                    Back to Task
                </a>
            </div>

            <div class="w-full">
                @if($taskData->image!='no_image')
                    <img src="{{URL(\Illuminate\Support\Facades\Storage::url('images/'.$taskData->image))}}"
                         class="w-full h-[45rem] object-cover rounded-lg"
                         alt="view of a coastal Mediterranean village on a hillside, with small boats in the water."/>
                @else
                    <img
                        src="https://grcviewpoint.com/wp-content/uploads/2022/11/Time-to-Correct-A-Long-standing-Curriculum-Coding-Error-Say-Experts-GRCviewpoint.jpg"
                        class="w-full h-[45rem] object-cover rounded-lg"
                        alt="view of a coastal Mediterranean village on a hillside, with small boats in the water."/>
                @endif
            </div>

            <div>
                <div class="flex items-center gap-1 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                         class="size-6">
                        <path fill-rule="evenodd"
                              d="M14.615 1.595a.75.75 0 0 1 .359.852L12.982 9.75h7.268a.75.75 0 0 1 .548 1.262l-10.5 11.25a.75.75 0 0 1-1.272-.71l1.992-7.302H3.75a.75.75 0 0 1-.548-1.262l10.5-11.25a.75.75 0 0 1 .913-.143Z"
                              clip-rule="evenodd"/>
                    </svg>

                    <span>
                        Status : {{ \App\Enums\Status::tryFrom($taskData->status)->getName() }}
                        | Allocated To : {{\Aaran\Taskmanager\Models\Task::allocate($taskData->allocated)}}
                        | Created By : {{$taskData->user->name}} | {{$taskData->created_at->diffForHumans()}}
                </span>
                </div>
            </div>

            <div class="text-xl text-justify ">{!! $taskData->body !!}</div>
            <div class="border-b-2 border-gray-400">&nbsp;</div>

            <!--User Comments ----------------------------------------------------------------------------------------->

            <div class="w-full h-96 overflow-scroll p-5 space-y-2">
                @foreach($list as $index=>$row)
                    <div class="bg-gray-50 border border-gray-200 p-5 space-y-2 rounded-lg">
                        <div class="flex justify-between">
                            <div class="text-indigo-500">By : {{$row->user->name}}
                                | {{$row->created_at->diffForHumans()}}  </div>
                            <div class="flex justify-center items-center gap-4 self-center">
                                <x-button.edit wire:click="edit({{$row->id}})"/>
                                <x-button.delete wire:click="getDelete({{$row->id}})"/>
                            </div>
                        </div>
                        <div class="text-justify text-slate-700"> {!! $row->vname !!} </div>
                    </div>
                @endforeach
            </div>

            <!--Comments ---------------------------------------------------------------------------------------------->

            <div class="space-y-5">
                <div class="text-2xl font-bold tracking-wider underline">Comments :</div>
                <x-input.rich-text wire:model="common.vname" :placeholder="'Write your comments'"/>
                <button wire:click.prevent="save"
                        class="w-full bg-emerald-500 p-2 rounded-lg border border-gray-400 hover:bg-emerald-600 text-lg text-white font-bold tracking-wider">
                    Post Comment
                </button>
            </div>
        </div>
        <x-modal.delete/>
    </x-forms.m-panel>
</div>
