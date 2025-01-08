<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<h1>Student Data</h1>
<span id="output"></span>
<table border="1" id="students-table">
    <tr>
        <th>Sl. No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
</table>


<script>
    $(document).ready(function() {
       $.ajax({
          type:"GET",
           url: "{{ route('getStudents') }}",
           success:function (data) {
               console.log(data);
               if (data.students.length > 0)
               {
                   for(let i=0; i<data.students.length; i++) {
                       let img = data.students[i]['image'];
                       $("#students-table").append(`<tr>
                        <td>`+(i+1)+`</td>
                        <td>`+(data.students[i]['name'])+`</td>
                        <td>`+(data.students[i]['email'])+`</td>
                        <td>
                            <img src="{{ asset('storage/`+img+`') }}" alt="`+img+`" width="100px" height="100px" />
                        </td>
                        <td>
                        <a href="editUser/`+(data.students[i]['id'])+`">Edit</a>
                        <a href="#" class="deleteData" data-id="`+(data.students[i]['id'])+`">Delete</a>
                        </td>
                        </tr>`);
                   }
               }
               else {
                   $("#students-table").append("<tr><td colspan='4'>Data Not Found</td></tr>")
               }
           },
           error:function (err) {
               console.log(err.responseText);
           }
       });

       $("#students-table").on("click", ".deleteData", function(){
           var id = $(this).attr("data-id");
           var obj = $(this);
           $.ajax({
               type: "GET",
               url:"delete-data/"+id,
               success:function (data) {
                   $(obj).parent().parent().remove();
                   $("#output").text(data.result)
               },
               error:function(err) {
                   console.log(err.responseText)
               }
           })
       });
    });
</script>
