@extends('layouts.backend')

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <div class = user-info m-b-20>
                    @php
                    if (Auth::user()->avatar && file_exists(public_path(). '/assets/backend/dist/img/user/'. Auth::user()->avatar )){
                        $img = asset('/assets/backend/dist/img/user/' . Auth::user()->avatar);
                    }
                    else{
                        $img = asset('/assets/backend/dist/img/user/avatar5.png');
                    }
                    @endphp
                </div>
                <center>
                    <div class="image" ><img src="{{ $img }}" alt="" style=""></div>
                    <h3><b>{{Auth::user()->name}}</b></h3>
                </center>
              <p class="text-muted text-center">Software Engineer </p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
