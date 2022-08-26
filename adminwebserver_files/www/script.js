function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function addHouseToCookie(id,cname){
    console.log(cname);
   let ids = getCookie(cname);
   if (ids !== ""){
       ids = JSON.parse(ids);
       if (ids.indexOf(id) !== -1){
           ids.splice(ids.indexOf(id),1);
       } else {
           ids.push(id);
       }
       setCookie(cname,JSON.stringify(ids),10);
   } else {
       setCookie(cname,JSON.stringify([id]),10);
   }
}

function hideSiblings(){
    let result = [];
    let node = this.parentNode.firstChild;

    while ( node ) {
        if ( node !== this && node.nodeType === Node.ELEMENT_NODE )
            result.push( node );
        node = node.nextElementSibling || node.nextSibling;
    }
    result.forEach(element => {if(element.style.display==="none"){
        element.style.display="block";
        this.children[0].innerHTML = "&#11167;";

    } else {
        element.style.display="none";
        this.children[0].innerHTML = "&#10148;";
    }});
}
window.onload = function() {
    let elements = document.getElementsByClassName("dropdown")
    for(let i =0; i < elements.length;i++){
        elements[i].addEventListener("click", hideSiblings);
    }
    // document.getElementById("unapproved_list").addEventListener("click", hideSiblings);
    // document.getElementById("approved_list").addEventListener("click", hideSiblings);
}

