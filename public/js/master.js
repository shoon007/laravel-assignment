
let lists = document.querySelectorAll('.list');
lists.forEach((list) => {
  // Add a click event listener to each list element
  list.addEventListener('click', () => {
    // Remove the active class from all other list elements
    lists.forEach((li) => li.classList.remove('active'));
    // Add the active class to the clicked element
    list.classList.add('active');
  });
});

let el = document.getElementById("wrapper");
        let toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };




        /* uploading or dragging folder */
         //selecting all required elements
         const dropArea = document.querySelector(".drag-area"),
        dragText = dropArea.querySelector("header"),
        button = dropArea.querySelector("button"),
        input = dropArea.querySelector("input");
        let file; //this is a global variable and we'll use it inside multiple functions

        button.onclick = ()=>{
            event.preventDefault(); //
          input.click(); //if user click on the button then the input also clicked
        }

        input.addEventListener("change", function(){
          //getting user select file and [0] this means if user select multiple files then we'll select only the first one
          file = this.files[0];
          dropArea.classList.add("active");
          showFile(); //calling function
        });


        //If user Drag File Over DropArea
        dropArea.addEventListener("dragover", (event)=>{
          event.preventDefault(); //preventing from default behaviour
          dropArea.classList.add("active");
          dragText.textContent = "Release to Upload File";
        });

        //If user leave dragged File from DropArea
        dropArea.addEventListener("dragleave", ()=>{
          dropArea.classList.remove("active");
          dragText.textContent = "Drag & Drop to Upload File";
        });

        //If user drop File on DropArea
        dropArea.addEventListener("drop", (event)=>{
          event.preventDefault(); //preventing from default behaviour
          //getting user select file and [0] this means if user select multiple files then we'll select only the first one

          file = event.dataTransfer.files[0];
          console.log(file);


   //showFile(); //calling function
        });

 function showFile(){
  let fileType = file.type; //getting selected file type
  let validExtensions = ["image/jpeg","image/webp", "image/jpg", "image/png"]; //adding some valid image extensions in array
  if(validExtensions.includes(fileType)){ //if user selected file is an image file
    let fileReader = new FileReader(); //creating new FileReader object
    fileReader.onload = ()=>{
      let fileURL = fileReader.result; //passing user file source in fileURL variable

//     let imgTag = `<img src="${fileURL}" alt="image" width="200px" >`; //creating an img tag and passing user selected file source inside src attribute
  //    dropArea.innerHTML = imgTag; //adding that created img tag inside dropArea container
      // assign the file name to the hidden input field value
      document.getElementById("file_name").value = file.name;

    }
    fileReader.readAsDataURL(file);
  }else{
    alert("This is not an Image File!");
    dropArea.classList.remove("active");
    dragText.textContent = "Drag & Drop to Upload File";
  }
}


//html text editor
         CKEDITOR.replace('content');
         //grab the value in texteditor
        // Get the editable div element and the hidden input
        let editor = document.getElementById ("editor");
        let hiddenInput = document.getElementById ("hidden-input");

        // Add an event listener for the form submission
   document.querySelector ("form").addEventListener ("submit", function (event) {
          // Prevent the default form behavior
        //  event.preventDefault ();


        // Get the HTML content of the editable div
        let html = editor.innerHTML;

        // Remove the HTML tags using a regular expression
        let text = html.replace (/<[^>]*>/g, "");

        // Assign it to the value of the hidden input
        hiddenInput.value = text;

          // Submit the form
        // this.submit ();
        });
   // Get the form element by id
   var form = document.getElementById("myForm");
   // Define a function to reset the form fields
   function resetForm() {
       // Call the reset method on the form element
       form.reset();
   }
