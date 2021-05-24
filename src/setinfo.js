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
	start_slider_value.setAttribute("data-length", event.target.value);
});
end_slider.querySelector("input").addEventListener("input", event => {
	end_slider_value.setAttribute("data-length", event.target.value);
});
