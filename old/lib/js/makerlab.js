function submitform()
{
    document.editForm.submit();
}

function ajaxCall() {
    $.post("open_gate.php", {name: "John", time: "2pm"})
            .done(function(data) {
                alert("Data Loaded: " + data);
        $("#modalContent").html(data);
        //window.location.hash="#myModalexample"; 
            });
}