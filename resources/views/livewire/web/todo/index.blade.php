<div>
    <x-slot name="header">Common</x-slot>
    <div id="content" class="mx-auto space-y-5 bg-white" style="max-width:500px;">
        <div class="container content py-6 mx-auto bg-gray-50 rounded-md p-1">
            <div class="mx-auto">
                <div id="create-form" class="hover:shadow p-6 bg-white border-blue-500 border-t-2 rounded-md">
                    <div class="flex ">
                        <h2 class="font-semibold text-lg text-gray-800 mb-5">Create New Todo</h2>
                    </div>
                    <div>
                        <form>
                            <div class="mb-6">
                                <x-input.floating wire:model.live="name" label="Todo"/>
                                @error('name')
                                <span class="text-red-500 text-xs mt-3 block ">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="flex-col flex gap-y-2 ">
                                <div class="w-full flex justify-end">
                                    <x-button.new-x  class="" wire:click.prevent="create" />
                                </div>
                                @if(session('success'))
                                    <span class="text-green-500 text-xs bg-green-100 px-2 py-1 text-center">Todo Created</span>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div  id="search-box" class="flex flex-col items-center p-4 justify-center ">
            <x-input.search-bar label="Search...." wire:model.live.debounce.500ms="search" />

        </div>


        <div id="todos-list">
            @foreach( $todo as  $row)
                <div class="todo mb-5 card px-5 py-6 bg-white col-span-1 border-t-2 border-blue-500 hover:shadow">
                    <div class="flex justify-between space-x-2">

                        <!-- <input type="text" placeholder="Todo.."
                                    class="bg-gray-100  text-gray-900 text-sm rounded block w-full p-2.5"
                                    value="Todo Name">

                                    <span class="text-red-500 text-xs block">error</span> -->

                        <h3 class="text-lg text-semibold text-gray-800">{{$row->name}}</h3>


                        <div class="flex items-center space-x-2">
                            <x-button.edit />
                            <x-button.delete wire:click="delete({{$row->id}})" />
                        </div>
                    </div>
                    <span class="text-xs text-gray-500"> {{$row->created_at->diffForHumans()}} </span>
                    <div class="mt-3 text-xs text-gray-700">
                        <!--
                                <button
                                    class="mt-3 px-4 py-2 bg-teal-500 text-white font-semibold rounded hover:bg-teal-600">Update</button>
                                <button
                                    class="mt-3 px-4 py-2 bg-red-500 text-white font-semibold rounded hover:bg-red-600">Cancel</button> -->

                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="w-6/12 mx-auto">
        {{$todo->links()}}
    </div>
</div>
