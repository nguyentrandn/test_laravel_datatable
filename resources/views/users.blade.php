<!DOCTYPE html>
<html>
<head>
    <title>Laravel Datatables Filter with Dropdown Example - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
     
<div class="container position-realtive">
    <div class="popup">
        <form action="" class="">
            <div class="popup_header">
                <h3>Thay doi trang thai</h3>
                <input type="button" class="btn btn-danger" name="btn_popup_cancer" value="X">
            </div>
            <div class="popup_content">
                <select class="form-select w-50" id="select" aria-label="Default select example">
                    <option selected value="0">Chon trang thai</option>
                    <option value="1">Cho xac thuc</option>
                    <option value="2">Phe duyet</option>
                    <option value="3">Ngung hoat dong</option>
                    <option value="4">Rut khoi hoi</option>
                </select>
                <div class="mt-5 w-75">
                    <input type="button" name="btn_popup_submit" class="btn btn-primary mx-5 " value="Xac nhan">
                    <input type="button" name="btn_popup_cancer" class="btn btn-secondary mx-5" value="Cancer">
                </div>
            </div>
        </form>
    </div>

    <h1>Laravel Datatables Filter</h1>
      
    <div class="card">
        <div class="card-body">
            <form id="form_status" class="form-group">
                @csrf
                <label><strong>Status :</strong></label>
                <label for="1"><input type="radio" name="status" id="1" value="0">Tat ca</label>
                <label for="2"><input type="radio" name="status" id="2" value="1">Cho xac thuc </label>
                <label for="3"><input type="radio" name="status" id="3" value="2">Phe duyet</label>
                <label for="4"><input type="radio" name="status" id="4" value="3">ngung hoat dong</label>
                <label for="5"><input type="radio" name="status" id="5" value="4">Rut khoi hoi</label>
            </form>
            <form action="" id="form_gender">
                @csrf
                <label><strong>Gender :</strong></label>
                <label for="6"><input type="radio" name="gender" id="6" value="">Tat ca</label>
                <label for="7"><input type="radio" name="gender" id="7" value="1">Nam</label>
                <label for="8"><input type="radio" name="gender" id="8" value="0">Nu</label>
            </form>
        </div>
    </div>
    <div class="my-2">
        <input name="btn_popup_cancer" type="button" class="btn btn-warning me-3" value="Cap nhat trang thai"/>
        <input type="button" id="bt" class="btn btn-danger" value="Xoa"/>
    </div>
    <form action="" id="form_table" onsubmit="return(false)">
        @csrf
        <table class="table table-bordered data-table" id="#users-table">
            <thead>
                <tr>
                    <th id="b">No</th>
                    <th>Name</th>
                    <th>Number</th>
                    <th>gender</th>
                    <th>type</th>
                    <th>date_in</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </form>
    
</div>
</body>
     
<script type="text/javascript">
$(document).ready(function() {
  $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            url: "{{ route('users.index') }}",
            data: function (d) {
                d.search = $('input[type="search"]').val(),
                d.status = $('input[name="status"]:checked').val(),
                d.gender = $('input[name="gender"]:checked').val()
                }
            },
            columns: [
                {data: 'id', name: 'id' , orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'number', name: 'number'},
                {data: 'grender', name: 'grender'},
                {data: 'type', name: 'type'},
                {data: 'date_in', name: 'date_in'},
                {data: 'status', name: 'status', orderable: false, searchable: false},
            ]
        });                 
  
        $('input[name="status"]').click(function(){
            console.log($('input[type="radio"]:checked').val());
            table.draw();
        })
        ;$('input[name="gender"]').click(function(){
            console.log($('input[type="radio"]:checked').val());
            table.draw();
        });



        $('#bt').on('click', function () {
            arr = []
            $('input[name="checkbox"]').each(function() {
                if ($(this).is(":checked")) {
                    arr.push($(this).val())
                }
            })
            // console.log(arr);
            data = {
                arr : arr
            }
            $.ajax({
                    type: "DELETE",
                    url:   "{{ route('delete') }}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function () {
                        table.draw();
                    },
                })
            .done(function (data){
                console.log(data);
            })
        }) 

//   Handler Cancer Popup
  $('input[name="btn_popup_cancer"]').click(function (){
        $(".popup").toggleClass('active');
  })
    // Handler Submit Status
  $('input[name="btn_popup_submit"]').click(function(){
    const status = $('#select').val()
    arr = []
        $('input[name="checkbox"]').each(function() {
            if ($(this).is(":checked")) {
                arr.push($(this).val())
            }
        })
        console.log(arr);
        data = {
            status : status,
            arr : arr
        }
    $.ajax({
        type: 'POST',
        url: "{{ route('update') }}",
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })
    .done(function (data){
        $(".popup").toggleClass('active');
        table.draw();
        alert(data);
    })
  })
});
});
</script>
</html>