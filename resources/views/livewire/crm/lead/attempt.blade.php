<div>
    <!--Add Attempt Modal-->
    <form wire:submit.prevent="create">
        <div class="w-full h-auto">
            <x-jet.modal wire:model.defer="showAttemptModal" >

                <div class="sm:px-6 px-2 pt-4">
                    <div class="text-lg">
                        Attempt Entry
                    </div>
                    <x-forms.section-border class="py-2"/>
                    <div class="mt-4">

                        <div class="space-y-4">

                            <div>
                                <x-input.floating wire:model="common.vname" :label="'Attempt No:'"/>
                                @error('common.vname')
                                <div class="text-xs text-red-500">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <x-input.model-select wire:model="lead_by" :label="'Lead By'">
                                <option value="">Choose...</option>
                                @foreach(\App\Models\User::all() as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </x-input.model-select>
                        </div>

                        <div class="mt-3">
                            <x-input.rich-text :placeholder="'Description'" wire:model="body"/>
                            @error('body')
                            <div class="text-xs text-red-500">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <x-input.model-select wire:model="status_id" :label="'Status'">
                                <option value="">Choose...</option>
                                @foreach(App\Enums\Status::cases() as $status)
                                    <option value="{{$status->value}}">{{$status->getName()}}</option>
                                @endforeach
                            </x-input.model-select>
                        </div>

                        <div class="mt-3">
                            <x-input.model-select wire:model="verified_by" :label="'Verified By'">
                                <option value="">Choose...</option>
                                @foreach(\App\Models\User::all() as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </x-input.model-select>
                        </div>


                    </div>
                    <div class="mb-1">&nbsp;</div>
                </div>

                <div class="sm:px-6 px-3 py-3 bg-gray-100 text-right">
                    <div class="w-full flex justify-between gap-3">
                        <div class="py-2">
                            <label for="common.active_id" class="inline-flex relative items-center cursor-pointer">
                                <input type="checkbox" id="common.active_id" class="sr-only peer"
                                       wire:model="common.active_id">
                                <div
                                    class="w-10 h-5 bg-gray-200 rounded-full peer peer-focus:ring-2
                                        peer-focus:ring-blue-300
                                         peer-checked:after:translate-x-full peer-checked:after:border-white
                                         after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300
                                         after:border after:rounded-full after:h-4 after:w-4 after:transition-all
                                         peer-checked:bg-blue-600"></div>
                                <span class="ml-3 sm:text-sm text-xs font-medium text-gray-900">Active</span>
                            </label>
                        </div>
                        <div class="flex gap-3">
                            <x-button.cancel/>
                            <x-button.cancel-x wire:click.prevent="$set('showAttemptModal', false)" />
                            <x-button.save/>
                            <x-button.save-x  wire:click.prevent="save" />
                        </div>
                    </div>
                </div>


            </x-jet.modal>
        </div>

    </form>

</div>
