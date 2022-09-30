
function loadUserImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#uploaded_user_image")
                .attr("src", e.target.result)
                .width(120)
                .height(120);
        };

        reader.readAsDataURL(input.files[0]);
    }
}


