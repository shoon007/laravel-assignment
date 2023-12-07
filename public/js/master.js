let lists = document.querySelectorAll(".list");
lists.forEach((list) => {
    // Add a click event listener to each list element
    list.addEventListener("click", () => {
        // Remove the active class from all other list elements
        lists.forEach((li) => li.classList.remove("active"));
        // Add the active class to the clicked element
        list.classList.add("active");
    });
});

let el = document.getElementById("wrapper");
let toggleButton = document.getElementById("menu-toggle");

toggleButton.onclick = function () {
    el.classList.toggle("toggled");
};

//html text editor
//  CKEDITOR.replace('content');
//grab the value in texteditor
// Get the editable div element and the hidden input
let editor = document.getElementById("editor");
let hiddenInput = document.getElementById("hidden-input");

// Get the form element by id
var form = document.getElementById("myForm");
// Define a function to reset the form fields
function resetForm() {
    // Call the reset method on the form element
    form.reset();
}
