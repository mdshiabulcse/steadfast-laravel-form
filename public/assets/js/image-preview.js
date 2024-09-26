function previewFile(input) {
    "use strict";

    var preview = input.previousElementSibling;
    var file = input.files[0];
    var reader = new FileReader();

    // if(input.files[0].size > 1000000){
        // alert("Maximum file size is 1MB!");
    // } else {
        reader.onloadend = function() {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    // }
}

function previewDimensionsFile(input) {
    "use strict";

    var preview = input.previousElementSibling;
    var file = input.files[0];
    var reader = new FileReader();

    if (file.type !== 'image/png')
    {
        alert("Accepted file is png.");
        return
    }

    var img = new Image();
    img.src = window.URL.createObjectURL( file );
    img.onload = function()
    {
        var width = this.naturalWidth,
            height = this.naturalHeight;

        if (width !== 815){
            preview.src = "";
            input.value = ""
            alert("Need to width is 815!");
            return;
        }

        if (height !== 639){
            preview.src = "";
            input.value = ""
            alert("Need to height is 639!");
            return;
        }

    };

    if(input.files[0].size > 1000000){
        alert("Maximum file size is 1MB!");
    }else {
        reader.onloadend = function() {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }
}

function preview35DimensionsFile(input) {
    "use strict";

    var preview = input.previousElementSibling;
    var file = input.files[0];
    var reader = new FileReader();

    if (file.type !== 'image/png')
    {
        alert("Accepted file is png.");
        return
    }

    var img = new Image();
    img.src = window.URL.createObjectURL( file );
    img.onload = function()
    {
        var width = this.naturalWidth,
            height = this.naturalHeight;

        if (width !== 35){
            preview.src = "";
            input.value = ""
            alert("Need to width is 35!");
            return;
        }

        if (height !== 35){
            preview.src = "";
            input.value = ""
            alert("Need to height is 35!");
            return;
        }

    };

    if(input.files[0].size > 1000000){
        alert("Maximum file size is 1MB!");
    }else {
        reader.onloadend = function() {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }
}

