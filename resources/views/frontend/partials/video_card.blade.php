<div class="card bg-dark text-white border-0 shadow-sm h-100 rounded-4 overflow-hidden">

    {{-- 🔒 Lock Overlay (for non-active users) --}}
    @if(auth()->user()->plan_id === 0)
    <div class="locked-overlay d-flex flex-column justify-content-center align-items-center text-center">
        <div class="lock-icon mb-3">
            <i class="bi bi-lock-fill"></i>
        </div>
        <p class="fw-semibold mb-3 text-warning fs-6">Subscribe to unlock this content</p>
        <a href="{{ route('plans.upgrade') }}" class="btn btn-warning rounded-pill fw-semibold px-4 shadow-sm">
            View Plans
        </a>
    </div>
    @endif

    @if($video->category->type === "music")
    <!-- 🎵 Music Player -->
    <div class="position-relative d-flex flex-column justify-content-center align-items-center p-3">
        <div class="music-disk mb-3" id="musicDisk{{ $video->id }}">
            <img src="{{ asset('assets/images/music-disk.jpg') }}" alt="Music Disk" class="w-100 rounded-circle">
        </div>
        <audio id="audio{{ $video->id }}" src="{{ asset('storage/' . $video->video_url) }}" controls class="w-100"></audio>
    </div>
    @else
    <!-- 🎬 Video Player -->
    <div class="video-wrapper position-relative">
        <video class="w-100" controls>
            <source src="{{ route('video.download', $video->id) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    @endif

    <!-- 🧾 Card Body -->
    <div class="card-body text-center py-3">
        <h6 class="text-warning fw-bold mb-3 text-truncate" title="{{ $video->title }}">
            {{ $video->title }}
        </h6>

        <a href="{{ route('video.download', $video->id) }}" download
            class="btn btn-warning w-100 fw-semibold d-flex align-items-center justify-content-center gap-2 rounded-pill shadow-sm">
            <i class="bi bi-download"></i> Download
        </a>
    </div>
</div>

<style>
    /* 🎵 Music Disk */
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

    /* 🎬 Video */
    .video-wrapper video {
        height: 220px;
        object-fit: cover;
        border-radius: 0.5rem;
    }

    /* 🧾 Card Hover Effect */
    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.4);
    }

    /* ✏️ Text */
    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* 🔒 Locked Overlay */
    .locked-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.75);
        z-index: 10;
        border-radius: 1rem;
        backdrop-filter: blur(6px);
        animation: fadeIn 0.4s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(1.05);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .lock-icon {
        background: rgba(255, 193, 7, 0.15);
        border: 2px solid #ffc107;
        color: #ffc107;
        border-radius: 50%;
        width: 70px;
        height: 70px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 2rem;
        box-shadow: 0 0 20px rgba(255, 193, 7, 0.5);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            box-shadow: 0 0 15px rgba(255, 193, 7, 0.3);
        }

        50% {
            box-shadow: 0 0 30px rgba(255, 193, 7, 0.8);
        }
    }

    /* 🎬 Video & Disk Blur for locked */
    .blurred {
        filter: blur(6px) brightness(0.6);
        pointer-events: none;
    }
</style>