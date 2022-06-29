const menu = document.querySelector(".navmenu");
const sidebar = document.querySelector(".sidebar")
const navbar = document.querySelector(".navbar")
const page = document.querySelector("main")
const content = document.querySelector("#content");
const edit = document.querySelector(".edit");
menu.addEventListener("click",function () {
    menu.classList.toggle("change");
    if (sidebar.style.display==="flex")
    {
        sidebar.style.display="none";
        navbar.style="transform: translateX(0px);";
        page.style="transform: translateX(0px);";
        content.style.width = "850px";
        edit.style.width = "1200px";
}
    else
    {
        sidebar.style.display="flex";
        navbar.style="transform: translateX(200px);";
        navbar.style.width = "84vw";
        page.style="transform: translateX(200px);";
        page.style.width = "84vw";
        content.style.width = "650px";
        edit.style.width = "1000px";
    }
})