@extends('adminlte::page')

@section('title', '403')

@section('content_header')

@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="modal fade in" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Thông báo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Bạn không đủ thẩm quyền để thực hiện chức năng này.</p>
                        </div>
                        <div class="modal-footer">                            
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>
    </div>
</div>
@stop

@section('css')
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="/vendor/fontawesome-free/css/all.min.css">
@stop

@section('js')
<!-- jQuery -->
<script src="/vendor/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    $(window).on('load', function() {
        $('#modal-default').modal('show');
    });
</script>
@stop