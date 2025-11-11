<div class="p-4 bg-dark text-light">
    @foreach($categories as $category)
        @if($category->type === "video")

            {{-- 🟡 Main Category --}}
            @if($category->videos->count() > 0)
                <div class="mb-5 category-block">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-warning fw-bold m-0">{{ $category->name }}</h4>
                        @if($category->videos->count() > 8)
                            <a href="{{ route('videos.subcategory', $category->id) }}" class="btn btn-outline-warning btn-sm">View All</a>
                        @endif
                    </div>

                    <div class="row g-4">
                        @foreach($category->videos->take(8) as $video)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                @include('frontend.partials.video_card', ['video' => $video])
                            </div>
                        @endforeach
                    </div>
                </div>
                <hr class="border-secondary opacity-25">
            @endif

            {{-- 🔵 Subcategories --}}
            @foreach($category->children as $sub)
                @if($sub->videos->count() > 0)
                    <div class="mb-5 subcategory-block">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="text-info fw-semibold m-0">{{ $sub->name }}</h5>
                            @if($sub->videos->count() > 8)
                                <a href="{{ route('videos.subcategory', $sub->id) }}" class="btn btn-outline-info btn-sm">View All</a>
                            @endif
                        </div>

                        <div class="row g-4">
                            @foreach($sub->videos->take(8) as $video)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    @include('frontend.partials.video_card', ['video' => $video])
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    @endforeach
</div>

<style>
/* 🌙 Smooth layout fixes */
.category-block, .subcategory-block {
    padding-bottom: 1rem;
}

hr {
    margin: 2rem 0;
}

/* 🎥 Card styling (consistent height) */
.card {
    background-color: #1e1e1e;
    border: none;
    border-radius: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
}

.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.5);
}

/* 🧾 Video title truncation */
.video-title {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* 🧩 Grid alignment fix */
.row.g-4 > [class*='col-'] {
    display: flex;
}

.row.g-4 > [class*='col-'] > .card {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

/* ✨ Section heading */
.text-warning, .text-info {
    letter-spacing: 0.5px;
}
</style>
