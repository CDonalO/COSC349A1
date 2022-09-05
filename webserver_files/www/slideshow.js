let houses = document.getElementsByClassName("house");
for (let house = 0; house < houses.length; house++) {
    showSlides(house, house, house);
}

// Next/previous controls
function plusSlides(n, count) {
    let a = document.getElementById(count);
    let c;
    let slides = a.getElementsByClassName("slide");
    for (let i = 0; i < slides.length; i++) {
        if(slides[i].style.display == "block"){
            c = parseInt(slides[i].getElementsByClassName(i)[0].className) + 1;
        }
    }
    showSlides( c += n, count, c);
}
/* displays the slide relevant to the input */
function showSlides(n, count,c) {
    let i;
    let a = document.getElementById(count);
    let slides = a.getElementsByClassName("slide");
    if(slides.length !== 0) {
        if (n > slides.length) {
            c = 1;
        }
        if (n < 1) {
            c = slides.length;
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[c - 1].style.display = "block";
    }
}
