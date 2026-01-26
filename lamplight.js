const lamp = document.querySelector(".lamp");
const background = document.querySelector(".background");

// restore lamp state on page load (same tab only)
if (sessionStorage.getItem("lamp") === "on") {
    background.classList.add("light");
}

lamp.addEventListener("click", () => {
    background.classList.toggle("light");

    if (background.classList.contains("light")) {
        sessionStorage.setItem("lamp", "on");
    } else {
        sessionStorage.setItem("lamp", "off");
    }
});
