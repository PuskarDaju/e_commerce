document.getElementById('fileInput').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('profilePic').src = event.target.result;
        }
        reader.readAsDataURL(file);
    }
});

document.getElementById('saveButton').addEventListener('click', function() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    
    // Here you can add functionality to save the data
    alert(`Changes saved:\nName: ${name}\nEmail: ${email}\nImage:${img}`);
});
