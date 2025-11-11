@extends('frontend.layouts.app')

@section('title', $title ?? 'All Videos')

@section('content')
<div class="main-content">
    <div class="p-4 bg-dark text-light mt-4">
        <div class="mb-5 category-block">
            {{-- Section Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="text-warning fw-bold m-0">
                    {{ $title ?? 'All Videos' }}
                </h4>
            </div>

            {{-- Videos Grid --}}
            <div class="row g-4">
                @forelse($videos as $video)
                <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
                    <div class="card bg-dark border-0 shadow-sm rounded-4 flex-grow-1">
                        <div class="video-wrapper position-relative">
                            <video class="w-100" controls>
                                <source src="{{ asset('storage/' . $video->video_url) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>

                        <div class="card-body text-center py-3">
                            <h6 class="text-warning fw-bold mb-3 text-truncate" title="{{ $video->title }}">
                                {{ $video->title }}
                            </h6>

                            <a href="{{ asset('storage/' . $video->video_url) }}" download
                                class="btn btn-warning w-100 fw-semibold d-flex align-items-center justify-content-center gap-2 rounded-pill shadow-sm">
                                <i class="bi bi-download"></i> Download
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <h5 class="text-secondary">No videos available.</h5>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- 🎨 Custom Styles --}}
<style>
    /* Layout spacing */
    .category-block {
        padding-bottom: 1rem;
    }

    /* Video Card */
    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.4);
    }

    /* Video styling */
    .video-wrapper video {
        height: 220px;
        object-fit: cover;
        border-radius: 0.75rem;
    }

    /* Title truncation */
    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Music Disk (optional future use) */
    .music-disk {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 4px solid #ffc107;
        overflow: hidden;
        animation: rotateDisk 5s linear infinite;
        transition: 0.3s ease;
    }

    .music-disk:hover {
        animation-play-state: paused;
        transform: scale(1.05);
        box-shadow: 0 0 20px rgba(255, 193, 7, 0.6);
    }

    @keyframes rotateDisk {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }
</style>
@endsection