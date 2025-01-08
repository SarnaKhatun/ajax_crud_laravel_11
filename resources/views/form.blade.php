<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form id="my-form">
    @csrf
    <input type="text" name="name" placeholder="Enter Name" required>
    <br><br>
    <input type="email" name="email" placeholder="Enter Email" required>
    <br><br>
    <input type="file" name="image" required>
    <br><br>
    <input type="submit" value="Add Student" id="btnSubmit">
</form>
<span id="output"></span>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $("#my-form").submit(function(event) {
            event.preventDefault();
            var form = $("#my-form")[0];
            var data = new FormData(form);
            $("#btnSubmit").prop("disabled", true);

            $.ajax({
                type:"POST",
                url: "{{route('add.student')}}",
                data:data,
                processData:false,
                contentType:false,
                success:function(data) {
                    $("#output").text(data.res);
                    $("#btnSubmit").prop("disabled", false);
                    $("input[type='text']").val('');
                    $("input[type='email']").val('');
                    $("input[type='file']").val('');
                },
                error:function (e) {
                  $("#output").text(e.responseText)
                  $("#btnSubmit").prop("disabled", false);
                  $("input[type='text']").val('');
                  $("input[type='email']").val('');
                  $("input[type='file']").val('');
                }
            })

        });
    });

</script>
</body>
</html>
