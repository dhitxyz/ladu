<div class="w-full py-24">
    <div class="max-w-7xl mx-auto px-6 md:px-28">
        <div class="flex flex-col md:flex-row items-start justify-between gap-8">

            @foreach (config('caralapor', []) as $index => $step)

                <div class="flex-1 text-center relative">

                    @if ($index !== count(config('caralapor', [])) - 1)
                        <div class="block absolute top-6 left-1/2 w-full h-0.5 bg-gray-200 z-0"></div>
                    @endif

                    <div class="relative z-10 w-14 h-14 mx-auto flex items-center justify-center rounded-full text-white text-sm {{ $index === 0 ? 'bg-[#CA0B3E]' : 'bg-gray-300' }}">

                        @if ($step['icon'] === 'pencil')
                            <i class="fas fa-pencil-alt"></i>
                        @elseif ($step['icon'] === 'paper-plane')
                            <i class="fas fa-paper-plane"></i>
                        @elseif ($step['icon'] === 'comments')
                            <i class="fas fa-comments"></i>
                        @elseif ($step['icon'] === 'comment-dots')
                            <i class="fas fa-comment-dots"></i>
                        @elseif ($step['icon'] === 'check')
                            <i class="fas fa-check"></i>
                        @endif

                    </div>

                    <h3 class="mt-4 text-md font-semibold text-gray-800">
                        {{ $step['title'] }}
                    </h3>

                    <p class="mt-2 text-sm text-gray-500 leading-relaxed px-2">
                        {{ $step['desc'] }}
                    </p>

                </div>

            @endforeach

        </div>
    </div>
</div>
