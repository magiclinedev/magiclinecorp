@extends('dash-layout')
@section('title')
{{ GoogleTranslate::trans('Bug Report', app()->getLocale()) }}
@endsection
@section('page-active')
{{ GoogleTranslate::trans('Bug Report', app()->getLocale()) }}
@endsection
@section('links')
<!-- summernote -->
<link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
@endsection
@section('main-content')
<div class="row d-flex justify-content-center">
    <div class="col-md-9">
    <div class="card card-outline">
        <div class="card-header">
          <h3 class="card-title">{{ GoogleTranslate::trans('Bug Report', app()->getLocale()) }}</h3>
        </div>
        @if(Session::get('success'))
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="icon fas fa-check"></i> {{ GoogleTranslate::trans(Session::get('success'), app()->getLocale()) }}
            </div>
        @endif
        @if(Session::get('fail'))
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="icon fas fa-ban"></i>  {{ GoogleTranslate::trans(Session::get('fail'), app()->getLocale()) }}
            </div>
        @endif
      <?php $currentuser = session()->get('LoggedUser'); ?>
      <form action="{{route('savebugreport')}}" method="post" enctype="multipart/form-data">
        @csrf
      <!-- /.card-header -->
      <div class="card-body">
        <div class="form-group">
          <input class="form-control" placeholder="To: Admin" disabled>
        </div>
        <div class="form-group">
            <input class="form-control" type="hidden" name="user_id" value="{{$currentuser}}">
            <input class="form-control" name="title" placeholder="Title:" value="{{old('title')}}">
            <div>
                <span class="text-danger">@error('title'){{ $message }}@enderror</span>
            </div>
        </div>
        <div class="form-group">
            <textarea id="compose-textarea" name="description" class="form-control" style="height: 300px">
               {{old('description')}}
            </textarea>
        </div>
        <div>
            <span class="text-danger">@error('description'){{ $message }}@enderror</span>
        </div>
        <div class="form-group">
          <div class="btn btn-default btn-file">
            <i class="fas fa-paperclip"></i> {{ GoogleTranslate::trans('Attachment', app()->getLocale()) }}
            <input type="file" name="attachment" id="attachment">
          </div>
          <div id="attachment_value"></div>
          <p class="help-block">{{ GoogleTranslate::trans('Max. 32MB', app()->getLocale()) }}</p>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <div class="float-right"><!-- 
          <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button> -->
          <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> {{ GoogleTranslate::trans('Send', app()->getLocale()) }}</button>
        </div>
        <!-- <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button> -->
      </div>
      <!-- /.card-footer -->
    </form>
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
@endsection
@section('scripts')
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote()
  })
</script>
<script>
    // Get the file input element
    var attachment = document.getElementById('attachment');
    var attachment_value = document.getElementById('attachment_value');
    // Add an event listener to listen for changes in the file input
    attachment.addEventListener('change', function(event) {
      // Get the selected file
      var selectedFile = event.target.files[0];

      // Check if a file was selected
      if (selectedFile) {
        // Display the filename
        //alert("Selected File: " + selectedFile.name);
        attachment_value.innerText = selectedFile.name;
        // Alternatively, display the file value
        // alert("Selected File: " + selectedFile.value);
      }
    });
</script>
@endsection