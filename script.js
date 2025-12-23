/* =================================================
   WELCOME POPUP
   ================================================= */
document.addEventListener("DOMContentLoaded", () => {
    const popup = document.getElementById("welcomePopup");
    const enterBtn = document.getElementById("enterBtn");

    if (popup && enterBtn) {
        enterBtn.addEventListener("click", () => {
            popup.style.display = "none";
        });
    }
});

/* =================================================
   CUSTOM CURSOR (SMOOTH & LIGHT)
   ================================================= */
const cursor = document.querySelector(".cursor");
const trail = document.querySelector(".cursor-trail");

let mouseX = 0, mouseY = 0;
let trailX = 0, trailY = 0;

// Ikuti mouse
document.addEventListener("mousemove", (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;

    if (cursor) {
        cursor.style.left = mouseX + "px";
        cursor.style.top = mouseY + "px";
    }
});

// Animasi trail halus
function animateTrail() {
    if (trail) {
        trailX += (mouseX - trailX) * 0.15;
        trailY += (mouseY - trailY) * 0.15;
        trail.style.left = trailX + "px";
        trail.style.top = trailY + "px";
    }
    requestAnimationFrame(animateTrail);
}

animateTrail();

/* =================================================
   DISABLE CUSTOM CURSOR ON MOBILE (OPTIONAL)
   ================================================= */
if (window.innerWidth < 768) {
    if (cursor) cursor.style.display = "none";
    if (trail) trail.style.display = "none";
}