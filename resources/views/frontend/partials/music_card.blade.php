<div class="card bg-dark text-light border-0 text-center p-3 mb-3 position-relative">
    <!-- Vinyl Disk -->
    <div class="vinyl-wrapper mx-auto mb-3" style="width: 120px; height: 120px; position: relative;">
        <img src="{{ url('assets/images/music-disk.png') }}" class="vinyl-disk"
            style="width: 100%; height: 100%; border-radius: 50%;" alt="{{ $music->title }}">
        <!-- Needle -->
       <div class="needle"></div>
    </div>

    <div class="card-body">
        <h6 class="video-title">{{ $music->title }}</h6>
        <audio controls class="music-player" style="width: 100%;">
            <source src="{{ url('storage/' . $music->music_file) }}" type="audio/mpeg">
        </audio>
    </div>
</div>

<style>
    /* Vinyl spinning */
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .vinyl-disk.playing {
        animation: spin 2s linear infinite;
        /* Smooth spinning */
    }

    /* Needle drop */
    .needle.playing {
        transform: rotate(0deg);
        /* drops onto disk */
        transition: transform 0.5s ease-in-out;
    }

    .needle.paused {
        transform: rotate(-30deg);
        /* lifts from disk */
        transition: transform 0.5s ease-in-out;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const players = document.querySelectorAll('audio.music-player');

        players.forEach(player => {
            const card = player.closest('.card');
            const disk = card.querySelector('.vinyl-disk');
            const needle = card.querySelector('.needle');

            player.addEventListener('play', () => {
                // Pause other players and reset their disks
                players.forEach(other => {
                    if (other !== player) {
                        other.pause();
                        const otherCard = other.closest('.card');
                        otherCard.querySelector('.vinyl-disk').classList.remove('playing');
                        const otherNeedle = otherCard.querySelector('.needle');
                        otherNeedle.classList.remove('playing');
                        otherNeedle.classList.add('paused');
                    }
                });

                // Start spinning and drop needle
                disk.classList.add('playing');
                needle.classList.add('playing');
                needle.classList.remove('paused');
            });

            player.addEventListener('pause', () => {
                disk.classList.remove('playing');
                needle.classList.remove('playing');
                needle.classList.add('paused');
            });

            player.addEventListener('ended', () => {
                disk.classList.remove('playing');
                needle.classList.remove('playing');
                needle.classList.add('paused');
            });
        });
    });
</script>