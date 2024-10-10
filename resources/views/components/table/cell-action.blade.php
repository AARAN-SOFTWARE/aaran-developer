@props([
    'id'=>null,
])
<td class=" print:hidden ">
    <div class="flex justify-center items-center gap-4 self-center">
       <x-button.edit wire:click="edit({{$id}})"/>
       <x-button.delete  wire:click="getDelete({{$id}})"/>
    </div>
</td>
