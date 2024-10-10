<div>
    <x-slot name="header">Elements</x-slot>

    <x-corousels.carousel-auto class="sm:min-h-[80svh] h-72"/>
    <x-web.uielements.color-palette/>
    <x-web.uielements.buttons/>
    <x-web.uielements.cards/>
    <x-web.uielements.extra/>
    <x-web.uielements.form/>

    <div class="bg-white w-1/2 h-40 p-6 space-y-6">

        <div class="relative w-full">
            <input type="text" id="floating_outlined"
                   class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-blue-100
                   rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-2
                   focus:ring-cyan-50 focus:border-blue-600 peer text-end"
                   placeholder=" " autocomplete="off"/>
            <label for="floating_outlined"
                   class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300
           transform -translate-y-4 scale-75 top-2 z-10 origin-[0]
           bg-white  px-2 peer-focus:px-2 peer-focus:text-blue-600
           peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100
           peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4
           rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 pointer-events-none">Title</label>
        </div>

        <input type="text" class="text-end">


    </div>
</div>
