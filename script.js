var slidePic = document.getElementById("range");
var y = document.getElementById("f");
y.innerHTML = slidePic.value;

slidePic.oninput = function() {
    y.innerHTML = this.value;
}
