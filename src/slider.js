var slider = document.getElementById("Temperature");
var output = document.getElementById("tmp");
output.innerHTML = slider.value; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)
slider.oninput = function() {
    output.innerHTML = this.value;
}

var sliderhumid = document.getElementById("Humidity");
var outputhumid = document.getElementById("hmd");
outputhumid.innerHTML = sliderhumid.value;

sliderhumid.oninput = function() {
    outputhumid.innerHTML = this.value;
}