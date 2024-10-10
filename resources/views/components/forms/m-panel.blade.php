@props([
    'margin' => ''
])
<div class="w-full border-t-[1px] border-blue-500 rounded-md shadow-lg  {{$margin}}">
    <div {{$attributes->merge(['class' => 'sm:p-5 p-2 bg-white rounded-md space-y-4 border border-gray-400 min-h-screen'])}} >
        {{$slot}}
    </div>
</div>
