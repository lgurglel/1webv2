window.setInterval(
    function(){
        var d = new Date();
        document.getElementById("clock").innerHTML =  d.toLocaleTimeString();
        displayCanvas();
    }
    , 1000);
        