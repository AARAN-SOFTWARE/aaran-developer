<div>
    <x-slot name="header">Issues - Activity</x-slot>

    <x-forms.m-panel>
        <div class="max-w-7xl mx-auto p-10 space-y-8 font-lex">

            <!-- Title ----------------------------------------------------------------------------------------------->

            <div class="inline-flex items-center space-x-2 font-merri">
                <div class="text-5xl text-gray-700">{{$issueData->id}}.</div>
                <div class="text-5xl font-bold tracking-wider capitalize text-gray-700">{{$issueData->vname}}</div>
            </div>

            <div class="hidden lg:flex justify-between">
                <a href="{{route('issues')}}"
                   class=" text-sm text-gray-600 gap-x-3 inline-flex items-center font-semibold hover:underline hover:decoration-blue-600 hover:text-blue-600 transition-all duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                              d="M4.72 9.47a.75.75 0 0 0 0 1.06l4.25 4.25a.75.75 0 1 0 1.06-1.06L6.31 10l3.72-3.72a.75.75 0 1 0-1.06-1.06L4.72 9.47Zm9.25-4.25L9.72 9.47a.75.75 0 0 0 0 1.06l4.25 4.25a.75.75 0 1 0 1.06-1.06L11.31 10l3.72-3.72a.75.75 0 0 0-1.06-1.06Z"
                              clip-rule="evenodd"/>
                    </svg>
                    Back to Home
                </a>
                <div>
                    <x-button.edit wire:click="editIssue"/>
                </div>
            </div>

            <!-- Images ----------------------------------------------------------------------------------------------->

            <x-image.gallery :list="$issueImages"/>

            <!-- Username & Status ------------------------------------------------------------------------------------>

            <div class="flex  items-center font-semibold text-sm font-lex gap-x-5">

                <div>Reporter : <span class="text-red-600"> {{ $issueData->reporter->name }}</span></div>
                <div class="border-l-2 h-5 border-gray-400"></div>

                <div class="text-gray-600">  {{$issueData->created_at->diffForHumans()}}</div>
                <div class="border-l-2 h-5 border-gray-400"></div>

                <div> Allocated To : <span
                        class="text-indigo-600">{{\Aaran\IssueManagement\Models\Issue::allocate($issueData->assignee_id)}}</span>
                </div>

                <div> Priority To :</div>
                <div
                    class="text-xs px-2 rounded-full py-0.5 {{ \App\Enums\Priority::tryFrom($issueData->priority_id)->getStyle() }}">{{ \App\Enums\Priority::tryFrom($issueData->priority_id)->getName() }}</div>
                <div class="border-l-2 h-5 border-gray-400"></div>

                <div> Status :</div>
                <div
                    class="text-xs px-2 rounded-full py-0.5 {{ \App\Enums\Status::tryFrom($issueData->status_id)->getStyle() }}">{{ \App\Enums\Status::tryFrom($issueData->status_id)->getName() }}</div>

            </div>

            <div class="text-sm text-justify leading-loose">{!! $issueData->body !!}</div>
            <div class="border-b-2 border-gray-600">&nbsp;</div>


            <!-- Activities ------------------------------------------------------------------------------------------->

            <div class="w-full h-96 overflow-scroll space-y-2 font-lex pr-2">

                @forelse($list as $index=>$row)
                    <div class="bg-gray-50 border border-gray-200 space-y-2 rounded-lg">
                        <div class="flex justify-between items-center gap-x-5 p-5 border-b">
                            <div class=" flex flex-col items-center gap-x-4">
                                <div class="flex items-center gap-x-2">

                                    <div class="flex-col flex">
                                        <div class="text-indigo-600">{{$row->reporter->name}}</div>

                                        <div
                                            class="text-gray-600 text-xs"> {{$row->created_at->diffForHumans()}}  </div>

                                    </div>

                                    <div
                                        class="text-xs px-3 py-1 rounded-full mb-3 mx-3 {{ \App\Enums\Status::tryFrom($row->status_id)->getStyle() }}">
                                        {{ \App\Enums\Status::tryFrom($row->status_id)->getName() }}</div>
                                </div>
                            </div>
                            <div class="flex justify-center items-center gap-4 self-center">
                                <x-button.edit wire:click="editActivity({{$row->id}})"/>
                                <x-button.delete wire:click="getDelete({{$row->id}})"/>
                            </div>
                        </div>
                        <div
                            class="text-justify min-h-20 p-5 text-sm text-gray-600 bg-white w-full"> {!! $row->vname !!} </div>
                    </div>
                @empty
                    <div class="flex-col flex justify-start items-center border rounded-md">
                        <div class="w-full bg-gray-100 p-2 ">No Activities yet</div>
                        <div class="w-full px-2 py-4">Empty Remarks</div>
                    </div>
                @endforelse

            </div>

            <!-- Create Activities ------------------------------------------------------------------------------------>

            <div class="w-full space-y-2">

                <div class="bg-gray-200 p-1 rounded-md">
                <x-input.textarea type="textarea" wire:model="common.vname"/>
                </div>

                <div class="w-full flex items-center justify-between ">

                    <x-input.model-select class="w-64" wire:model="status_id" :label="'Status'">
                        <option value="">Choose...</option>
                        @foreach(App\Enums\Status::cases() as $status)
                            <option value="{{$status->value}}">{{$status->getName()}}</option>
                        @endforeach
                    </x-input.model-select>

                    <button wire:click.prevent="getSaveIssueActivity"
                            class="bg-green-600 text-white px-4 py-2 rounded-md">
                        Post Activity
                    </button>
                </div>
            </div>
        </div>

        <x-modal.delete/>


        <!--Form Create ----------------------------------------------------------------------------------------------->

        <x-forms.create :id="$issue_id" :max-width="'6xl'">
            <div class="flex flex-row space-x-5 w-full">
                <div class="flex flex-col space-y-5 w-full">

                    <x-input.floating wire:model="title" :label="'Title'"/>

                    <x-input.rich-text wire:model="body" :placeholder="'Write the error'"/>

                </div>

                <!--Right Side -------------------------------------------------------------------------------------------->

                <div class="flex flex-col space-y-5 w-full">

                    <x-dropdown.wrapper label="Module" type="moduleTyped">
                        <div class="relative ">
                            <x-dropdown.input label="Module" id="module_name"
                                              wire:model.live="module_name"
                                              wire:keydown.arrow-up="decrementModule"
                                              wire:keydown.arrow-down="incrementModule"
                                              wire:keydown.enter="enterModule"/>
                            <x-dropdown.select>
                                @if($moduleCollection)
                                    @forelse ($moduleCollection as $i => $module)
                                        <x-dropdown.option highlight="{{$highlightModule === $i}}"
                                                           wire:click.prevent="setModule('{{$module->vname}}','{{$module->id}}')">
                                            {{ $module->vname }}
                                        </x-dropdown.option>
                                    @empty
                                        <x-dropdown.create wire:click.prevent="moduleSave('{{$module_name}}')"
                                                           label="Module"/>
                                    @endforelse
                                @endif
                            </x-dropdown.select>
                        </div>
                    </x-dropdown.wrapper>
                    @error('module_name')
                    <span class="text-red-400">{{$message}}</span>
                    @enderror

                    <x-input.model-select wire:model="assignee" :label="'Allocated'">
                        <option value="">Choose...</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </x-input.model-select>

                    <x-input.model-select wire:model="priority" :label="'Priority'">
                        <option value="">Choose...</option>
                        @foreach(App\Enums\Priority::cases() as $priority)
                            <option value="{{$priority->value}}">{{$priority->getName()}}</option>
                        @endforeach
                    </x-input.model-select>

                    <x-input.model-select wire:model="status" :label="'Status'">
                        <option value="">Choose...</option>
                        @foreach(App\Enums\Status::cases() as $status)
                            <option value="{{$status->value}}">{{$status->getName()}}</option>
                        @endforeach
                    </x-input.model-select>


                    <!-- Image  ----------------------------------------------------------------------------------------------->

                    <div class="flex flex-col py-2">
                        <label for="bg_image"
                               class="w-full text-zinc-500 tracking-wide pb-4 px-2">Image</label>

                        <div class="flex flex-wrap gap-2 w-full">
                            <div class="flex-shrink-0 w-full">
                                <div class="overflow-scroll w-full pb-3">
                                    @if($images)
                                        <div class="flex gap-5">
                                            @foreach($images as $image)
                                                <div
                                                    class=" flex-shrink-0 border-2 border-dashed border-gray-300 p-1 rounded-lg overflow-hidden">
                                                    <img
                                                        class="w-[156px] h-[89px] rounded-lg hover:brightness-110 hover:scale-105 duration-300 transition-all ease-out"
                                                        src="{{ $image->temporaryUrl() }}"
                                                        alt="{{$image?:''}}"/>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    @if(isset($old_images))
                                        <div class="flex gap-5">
                                            @foreach($old_images as $old_image)
                                                <div
                                                    class=" flex-shrink-0 border-2 border-dashed border-gray-300 p-1 rounded-lg overflow-hidden">
                                                    <img
                                                        class="w-[156px] h-[89px] rounded-lg hover:brightness-110 hover:scale-105 duration-300 transition-all ease-out"
                                                        src="{{URL(\Illuminate\Support\Facades\Storage::url('images/'.$old_image->image))}}"
                                                        alt="">
                                                    <div class="flex justify-center items-center">
                                                        <x-button.delete wire:click="DeleteImage({{$old_image->id}})"/>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <x-icons.icon :icon="'logo'" class="w-auto h-auto block "/>
                                    @endif
                                </div>
                            </div>
                            <div class="relative">
                                <div>
                                    <label for="bg_image"
                                           class="text-gray-500 font-semibold text-base rounded flex flex-col items-center
                                   justify-center cursor-pointer border-2 border-gray-300 border-dashed p-2
                                   mx-auto font-[sans-serif]">
                                        <x-icons.icon icon="cloud-upload" class="w-8 h-auto block text-gray-400"/>
                                        Upload Photo
                                        <input type="file" id='bg_image' wire:model="images" class="hidden" multiple/>
                                        <p class="text-xs font-light text-gray-400 mt-2">PNG and JPG are
                                            Allowed.</p>
                                    </label>
                                </div>

                                <div wire:loading wire:target="images" class="z-10 absolute top-6 left-12">
                                    <div class="w-14 h-14 rounded-full animate-spin
                                                        border-y-4 border-dashed border-green-500 border-t-transparent"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </x-forms.create>
    </x-forms.m-panel>
</div>
