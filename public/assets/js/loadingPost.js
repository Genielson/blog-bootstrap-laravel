
function loadingPost() {

    var url = "/loadingPosts";
    console.log(url);
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == XMLHttpRequest.DONE) {
            if (xmlHttp.status == 200) {
                // document.getElementById("txtHint").innerHTML = this.responseText;
                console.log('deu certo');
                console.log(this.responseText);
                var response = JSON.parse(this.responseText);
                console.log(response[0].id);
            } else {
                console.log("algo deu errado");
            }
        }
    };
    xmlHttp.open('GET', url, true);
    xmlHttp.send();
}

