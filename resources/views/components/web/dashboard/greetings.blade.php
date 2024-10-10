<div class=" sm:w-3/12 w-auto h-[20rem] rounded-lg bg-gray-50 hover:shadow-md">
    @if (App\Helper\Core::greetings() == 'Good morning')
        <div class="relative h-full">
            <img src="../../../../images/wall1.webp" alt="" class="w-full h-full brightness-75 rounded-lg hover:brightness-100 transition-all duration-300 ease-out">
            <div class="absolute top-24 w-full text-center p-5 space-y-4">
                <div class="w-full text-center font-roboto  font-semibold text-2xl text-white">
                    <span class="w-full">{{ App\Helper\Core::greetings() }},
                    </span>&nbsp;<span>{{ Auth::user()->name }}</span>&nbsp;&nbsp;<span>👋</span>
                </div>
                <div>
                    <span class="text-base font-sans text-white">{!! App\Helper\Slogan::getRandomQuote() !!}</span>
                </div>
            </div>
        </div>
    @elseif (App\Helper\Core::greetings() == 'Good afternoon')
        <div class="relative h-full">
            <img src="../../../../images/wall2.webp" alt="" class="w-full h-full brightness-75 rounded-lg hover:brightness-100 transition-all duration-300 ease-out">
            <div class="absolute top-24 w-full text-center p-5 space-y-4">
                <div class="w-full text-center font-semibold text-2xl text-white">
                    <span class="w-full">{{ App\Helper\Core::greetings() }},
                    </span>&nbsp;<span>{{ Auth::user()->name }}</span>&nbsp;&nbsp;<span>👋</span>
                </div>
                <div>
                    <span class="text-base font-sans text-white">{!! App\Helper\Slogan::getRandomQuote() !!}</span>
                </div>
            </div>
        </div>
    @elseif (App\Helper\Core::greetings() == 'Good evening')
        <div class="relative h-full">
            <img src="../../../../images/wall3.webp" alt="" class="w-full h-full brightness-75 rounded-lg hover:brightness-100 transition-all duration-300 ease-out">
            <div class="absolute top-24 w-full text-center p-5 space-y-4">
                <div class="w-full text-center font-semibold text-2xl text-white">
                    <span class="w-full">{{ App\Helper\Core::greetings() }},
                    </span>&nbsp;<span>{{ Auth::user()->name }}</span>&nbsp;&nbsp;<span>👋</span>
                </div>
                <div>
                    <span class="text-base font-sans text-white">{!! App\Helper\Slogan::getRandomQuote() !!}</span>
                </div>
            </div>
        </div>
    @else
        <div class="relative h-full">
            <img src="../../../../images/wall4.webp" alt="" class="w-full h-full brightness-75 rounded-lg hover:brightness-100 transition-all duration-300 ease-out">
            <div class="absolute top-24 w-full text-center p-5 space-y-4">
                <div class="w-full text-center font-semibold text-2xl text-white">
                    <span class="w-full">{{ App\Helper\Core::greetings() }},
                    </span>&nbsp;<span>{{ Auth::user()->name }}</span>&nbsp;&nbsp;<span>👋</span>
                </div>
                <div>
                    <span class="text-base font-sans text-white">{!! App\Helper\Slogan::getRandomQuote() !!}</span>
                </div>
            </div>
        </div>
    @endif
</div>



