


window.onload = () => {
    let links = document.querySelectorAll("[data-delete]");
    for (link of links) {
        link.addEventListener("click",function(e){

            e.preventDefault() 

        })
    }
    };