window.onload = function() {
    let SearchButton = document.querySelector("#lookup");
    let cities = document.querySelector("#cities");
    // polyfills  to use GET with query Params
    let url = new URL("http://localhost/Other Lab 5/info2180-lab5-master/world.php");
    


    SearchButton.addEventListener('click',()=>{
        removeAllChildNodes(document.querySelector("#result"));
        let params = {country: `${document.querySelector("#country").value}`};
        url.search = new URLSearchParams(params).toString();

        fetch(url).then(response => response.text())
        .then(data => {

        $("#result").append(data);
        }).catch(error => {
            $("#result").append(error);
            });
    });

    cities.addEventListener('click', ()=>{
        removeAllChildNodes(document.querySelector("#result"));
        params = {country: `${document.querySelector("#country").value}`, context: 'cities'};
        url.search = new URLSearchParams(params).toString();

        fetch(url).then(response => response.text())
        .then(data => {
            console.log($("#result"));
        $("#result").append(data);
        }).catch(error => {
            $("#result").append(error);
            });


    });

    function removeAllChildNodes(parent){
        while (parent.firstChild) {
            parent.removeChild(parent.firstChild);
        }

    }


 
}