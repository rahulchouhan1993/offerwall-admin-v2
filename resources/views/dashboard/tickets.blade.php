@extends('layouts.default')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">

<!-- Before </body> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<div class="p-[15px] md:p-[35px] ">
    <div class="bg-[#fff] p-[15px] md:p-[20px] rounded-[10px]">
<textarea id="summernote" name="content" placeholder="Write something here......">Ye chat pr reply ka textarea input  hai</textarea>
    </div>
    </div>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            toolbar: [
                
            ],
        });
    });
</script>
@stop