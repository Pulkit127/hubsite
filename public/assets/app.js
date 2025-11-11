const avatarNav = document.getElementById('userAvatarNav');
const dropdownNav = document.querySelector('.user-dropdown');

avatarNav.addEventListener('click', () => {
    dropdownNav.style.display = (dropdownNav.style.display === "block") ? "none" : "block";
});

// Close if clicked outside
document.addEventListener('click', (e) => {
    if (!avatarNav.contains(e.target) && !dropdownNav.contains(e.target)) {
        dropdownNav.style.display = "none";
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const videos = document.querySelectorAll("video");
    const audios = document.querySelectorAll("audio");

    // 🎬 Stop all other videos when one starts
    videos.forEach(video => {
        video.addEventListener("play", () => {
            videos.forEach(v => {
                if (v !== video) v.pause();
            });
            audios.forEach(a => a.pause()); // also stop music if playing
        });
    });
});