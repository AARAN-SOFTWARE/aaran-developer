<div class="bg-white">
    <x-web.home-new.items.banner
        label="Blog"
        desc=" We Design and develop Outstanding Digital products and digital -
                first Brands"
        padding="sm:px-[95px]"
        padding_mob="px-[40px]"
    />
    <x-slot name="header">Show</x-slot>
    <div class="w-7/12 mx-auto ">

        <div class="w-full h-auto flex flex-col my-14 gap-5">

            <div class="text-6xl capitalize">
                {{$blog->vname}}
            </div>

            <div class="uppercase flex gap-x-3 text-red-600">

                <span>
                    <x-icons.icon-fill :iconfill="'tag-menu'" class="w-4 h-3 " :colour="'#dc2626'"/>
                <span>{{ \Aaran\Blog\Models\Post::type($blog->blogcategory_id)}}</span>
                </span>

                <span>| &nbsp;{{\Aaran\Blog\Models\Post::tagName($blog->blogtag_id)}}</span>
                <span class="uppercase">| &nbsp;{{$blog->visibility==0?'Private':'Public'}}</span>
            </div>

            @if($blog->image != 'no image')
            <img
                src="{{URL(\Illuminate\Support\Facades\Storage::url('/images/'.$blog->image))}}"
                alt="{{$blog->image}}" class="h-[35rem] w-full"/>
            @else
                <x-image.empty-img/>
            @endif

            <div class="text-gray-500 inline-flex ">

                <div class="flex gap-1.5 justify-center ">
                    <x-icons.icon :icon="'clock'" class="w-5 h-5"/>
                    <span>{{ $blog->created_at->diffForHumans() }}</span>
                </div>

                <span class="inline-flex items-center gap-x-1 mx-3 mt-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="size-4 text-gray-600">
                    <path fill-rule="evenodd"
                          d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                          clip-rule="evenodd"/>
                </svg>
                <span class="uppercase">&nbsp;POST BY : {{ $blog->user->name }}</span>
                </span>

            </div>

            <div class="text-gray-700">
                {{$blog->body}}
            </div>
        </div>


    </div>

</div>
