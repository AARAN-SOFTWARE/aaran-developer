@props([
'label'=>''

])

<div class="xl:flex flex-row gap-3 py-3 ">
    <label for="{{$label}}"
           class="w-[10rem] text-zinc-500 tracking-wide py-2">{{ Str::replace('_',' ',Str::ucfirst($label))}}</label>

    <input type="checkbox" id="{{$label}}" autocomplete="off" {{ $attributes }}
            class="h-5 w-5 hover:cursor-pointer mt-2 bg-gray-100 border-gray-300 rounded focus:ring-2 transition duration-300 ease-in-out text-green-400 focus:ring-green-500'"/>
</div>
