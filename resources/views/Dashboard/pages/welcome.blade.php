@extends('dashboard.layout')

@section('title', "Dashboard!")

@section('stylesheets')
{{--  --}}
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active"></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">

    </div>
</div>
@endsection

@section('scripts')
{{-- <script>
    $(".menu-card").hover(function(){
        var imgurl = $(this).data("hoverimage");
        $(this).css("background-image", "url(" + imgurl + ")");
    }, function(){
        $(this).css("background-image", "");
    });
</script> --}}
@endsection
