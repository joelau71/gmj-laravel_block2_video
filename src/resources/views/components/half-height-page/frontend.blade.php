<div class="laravel_block2_video" id="laravel_block2_video_{{$element_id}}">
    <div class="relative overflow-hidden" style="max-height: 50vh">
        @if ($collection->is_youtube_link)
            <div class="videoWrapper relative h-0" style="padding-bottom: 56.25%;">
                <iframe class="absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{ $collection->youtube_link}}?autoplay=1&mute=1"></iframe>
            </div>
        @else
            <video
                class="relative transform left-1/2 -translate-x-1/2"
                width="100%" 
                style="min-width:800px"
                autoplay
                loop
                muted playsinline
            >
                <source src="{{$collection->getMedia("laravel_block2_video")->first()->getUrl() }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @endif

        <div class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 text-white">
            <div class="container mx-auto h-full px-8 flex flex-wrap items-center justify-center">
                <div>
                    {!! $collection->getTranslation("text", $locale) !!}
                    @if ($collection->link)
                        <a class="px-6 py-1 rounded-full border mt-4 mr-4 inline-block" href="{{ route("frontend.page", $collection->link->page->slug) }}">
                            {{ !empty($collection->link->title) ?
                                $collection->link->getTranslation("title", $locale) : $collection->link->page->getTranslation("title", $locale) }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
