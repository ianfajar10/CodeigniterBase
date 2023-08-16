$(document).ready(function () {
    let name = $app.user.name

    if (name.trim().split(/\s+/).length > 1) {
        name = name.trim().split(" ")[0]
        $("#span_name").text(name);
    } else {
        $("#span_name").text(name);
    }

});