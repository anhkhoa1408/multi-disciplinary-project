// Clear the concole on every refresh
console.clear();

// Selecting the Range Slider container which will effect the LENGTH property of the password.
const start_slider = document.querySelector(".start-slider");
const end_slider = document.querySelector(".end-slider");

// Text which will show the value of the range slider.
const start_slider_value = start_slider.querySelector(".length__title");
const end_slider_value = end_slider.querySelector(".length__title");

// Using Event Listener to apply the fill and also change the value of the text.
start_slider.querySelector("input").addEventListener("input", event => {
	start_slider_value.setAttribute("data-length", convert2Time(event.target.value));
});
end_slider.querySelector("input").addEventListener("input", event => {
	end_slider_value.setAttribute("data-length", convert2Time(event.target.value));
});

function convert2Time(value)
{
    var hours1 = Math.floor(value / 60);
    var minutes1 = value % 60;
    var ans = "";
    if (hours1 < 10)
    {
        ans = "0";
    }
    ans += + hours1.toString() + ':';
    if (minutes1 < 10)
    {
        ans += "0";
    }
    ans += minutes1.toString();
    return ans;
}