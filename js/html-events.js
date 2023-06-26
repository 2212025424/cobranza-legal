let buttonLateralMenu = document.getElementsByClassName("document-navbar_movile-button")[0]
let lateralMenu = document.getElementsByClassName("document-navbar_movile-menu")[0]

buttonLateralMenu.addEventListener("click", function () {
    lateralMenu.classList.toggle("show")
})

let submenuButtonDesktop = document.getElementsByClassName("document-navbar_desktop-submenu-button")[0]
let submenuDesktop = document.getElementsByClassName("document-navbar_desktop-submenu")[0]

submenuButtonDesktop.addEventListener("click", function () {
    submenuButtonDesktop.classList.toggle("active")
    submenuDesktop.classList.toggle("show")
})

let submenuButtonMovile = document.getElementsByClassName("document-navbar_movile-submenu-button")[0]
let submenuMovile = document.getElementsByClassName("document-navbar_movile-submenu")[0]

submenuButtonMovile.addEventListener("click", function () {
    submenuMovile.classList.toggle("show")
})

let businesspointsoption = document.getElementsByClassName("business-points_title")

for (i = 0; i < businesspointsoption.length; i ++) {
    businesspointsoption[i].addEventListener("click", function () {

        let previus = document.getElementsByClassName("business-points_description show")

        for (j = 0; j < previus.length; j ++) {
            previus[j].classList.toggle("show")
        }

        this.nextSibling.nextElementSibling.classList.toggle("show")

    })
}
