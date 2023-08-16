document.addEventListener("DOMContentLoaded", function () {
  const sidebarNav = document.getElementById("sidebar-nav");
  const links = sidebarNav.getElementsByTagName("a");

  for (let i = 0; i < links.length; i++) {
    links[i].classList.remove("active");

    if (links[i].href === window.location.href) {
      links[i].classList.add("active");
    }
  }
});