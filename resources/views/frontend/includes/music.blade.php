<div class="p-3 bg-dark text-light rounded-3">

    @foreach($categories as $category)
        @if($category->type === "music")
            <hr class="border-secondary" />
            <h4 class="text-warning mb-4 fw-bold">{{ $category->name }}</h4>

            {{-- 🎵 Main Category Music --}}
            @if($category->music->count() > 0)
                <h5 class="text-info mb-3">Music</h5>
                <div class="row g-4 mb-3">
                    @foreach($category->music->take(8) as $track)
                        <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
                            @include('frontend.partials.music_card', ['music' => $track])
                        </div>
                    @endforeach
                </div>

                @if($category->music->count() > 8)
                    <div class="text-end mb-4">
                        <a href="{{ route('music.category', $category->id) }}" class="btn btn-warning btn-sm">View All</a>
                    </div>
                @endif
            @endif

            {{-- Subcategories --}}
            @foreach($category->children as $sub)

                {{-- 🎵 Subcategory Music --}}
                @if($sub->music->count() > 0)
                    <h5 class="text-info mt-4 mb-3">{{ $sub->name }} - Music</h5>
                    <div class="row g-4 mb-3">
                        @foreach($sub->music->take(8) as $track)
                            <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
                                @include('frontend.partials.music_card', ['music' => $track])
                            </div>
                        @endforeach
                    </div>
                    @if($sub->music->count() > 8)
                        <div class="text-end mb-4">
                            <a href="{{ route('music.subcategory', $sub->id) }}" class="btn btn-warning btn-sm">View All</a>
                        </div>
                    @endif
                @endif
            @endforeach
        @endif
    @endforeach
</div>