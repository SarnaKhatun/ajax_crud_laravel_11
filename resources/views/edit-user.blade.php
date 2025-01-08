<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<img src="{{ asset('storage/') }}/{{ $student[0]->image }}" alt="" width="100">
<form id="update-form">
    @csrf
    <input type="text" value="{{ $student[0]->name }}" name="name" placeholder="Enter Name" required>
    <br><br>
    <input type="email" name="email" value="{{ $student[0]->email }}" placeholder="Enter Email" required>
    <br><br>
    <input type="file" name="image">
    <input type="hidden" name="id" value="{{ $student[0]->id }}">
    <br><br>
    <input type="submit" value="Update Data">
</form>
<span id="output"></span>
<script>
    $(document).ready(function() {
       $("#update-form").submit(function(event) {
           event.preventDefault();
          var form = $("#update-form")[0];
          var data = new FormData(form);

          $.ajax({
             type:"POST",
             url: "{{ route('updateStudent') }}",
              data:data,
              processData:false,
              contentType:false,
              success:function (data) {
                 $("#output").text(data.result);
                 window.open("/get-students","_self");
              },
              error:function (err) {
                 $("#output").text(err.responseText);
              }
          });
       });
    });
</script>
