@extends('frontend.layouts.app')

@section('title', 'All Music')

@section('content')
    <div class="main-content"
        style="background: #0f0f0f; min-height: 100vh; padding-top: 90px; padding-left: 20px; padding-right: 20px;">

        <div class="container-fluid" style="max-width: calc(100% - 250px);"> {{-- 250px sidebar --}}
            {{-- Section Header --}}
            <div class="text-center mb-5">
                <h2 class="text-warning fw-bold">{{ $title ?? 'All Videos' }}</h2>
                <p class="text-light-50">Explore all music under this section</p>
            </div>

            @if($music->count() > 0)
                <div class="row g-4">
                    @foreach($music as $mic)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card border-0 shadow-sm rounded-3 bg-dark text-light video-card h-100">
                                <!-- Music Player (Disk) -->
                                <div class="position-relative d-flex justify-content-center align-items-center p-3">
                                    <div class="music-disk" id="musicDisk{{ $mic->id }}">
                                        <img src="{{ url('assets/images/music-disk.jpg') }}" alt="Music Disk"
                                            class="w-100 rounded-circle">
                                    </div>
                                    <audio id="audio{{ $mic->id }}" src="{{ url('storage/' . $mic->music_file) }}" controls
                                        style="position:absolute; bottom:10px; width:90%;"></audio>
                                </div>
                                {{-- Card Body --}}
                                <div class="card-body p-2 d-flex flex-column justify-content-end">
                                    <h5 class="fw-bold text-warning video-title mb-0" title="{{ $mic->title }}">
                                        {{ $mic->title }}
                                    </h5>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-5">
                    {{ $music->links('pagination::bootstrap-5') }}
                </div>

            @else
                <div class="text-center text-light mt-5">
                    <p>No music available in this section.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Custom Styles --}}
    <style>
        .main-content {
            margin-left: 250px;
            /* sidebar width */
        }

        .video-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(255, 193, 7, 0.5);
        }

        .video-title {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Equal height for cards */
        .row>.col-lg-3,
        .row>.col-md-4,
        .row>.col-sm-6 {
            display: flex;
        }

        .row>.col-lg-3 .card,
        .row>.col-md-4 .card,
        .row>.col-sm-6 .card {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
        }

        .video-wrapper {
            width: 100%;
            height: 180px;
            overflow: hidden;
        }

        .video-wrapper video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Responsive: collapse sidebar on small screens */
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
            }

            .container-fluid {
                max-width: 100%;
                padding-left: 15px;
                padding-right: 15px;
            }
        }
    </style>
@endsection