<div>

    <x-slot name="header">Show</x-slot>

    <section class="text-gray-600 body-font overflow-hidden">

        <div class="container px-5 py-14 mx-auto">

            <div class="w-full">
                <div class="w-8/12 flex mx-auto">
                    <a href="{{route('softVersion')}}"
                       class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500 gap-1 mr-2">

                        Releases
                    </a>
                </div>

                <div class="flex flex-wrap w-8/12 mx-auto md:flex-nowrap my-5 justify-center ">

                    <div class="md:flex-grow border border-gray-200 p-5 rounded-lg ">

                        <div class="flex flex-col pb-4 space-y-4">
                            <div class="font-bold text-3xl title-font text-gray-700  capitalize">
                                {{$softVersion->version}}
                            </div>

                            <div class="text-gray-500 text-sm">
                                released on {{$softVersion->updated_at->diffForHumans()}}
                            </div>

                        </div>

                        <div class="border-t border-gray-200 pt-4 w-full">

                            <div class="flex flex-col space-y-5">
                                <span class="text-2xl font-medium text-gray-900 title-font capitalize">{{$softVersion->title}}</span>

                                <img
                                        src="{{URL(\Illuminate\Support\Facades\Storage::url('/images/'.$softVersion->image))}}"
                                        alt="{{$softVersion->image}}" class="h-[25rem] w-full"/>

                                <span class="leading-relaxed w-full">{!! $softVersion->body !!}</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
