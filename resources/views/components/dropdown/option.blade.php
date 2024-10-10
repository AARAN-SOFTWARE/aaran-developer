@props([
    'highlight' => null
])
<li class="cursor-pointer px-3 py-1 hover:font-bold hover:bg-blue-100 text-blue-900 h-fit ml-2 mr-2 rounded-md text-sm my-1 {{$highlight ? 'bg-blue-100' : ''}} "
    {{$attributes}} x-on:click="isTyped = false">
    {{$slot}}
</li>
