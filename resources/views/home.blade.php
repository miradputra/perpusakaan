@extends('layouts.backend')

<div class="content-wrapper">
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <br>
                    <br>
                    <div style="margin-top:20px">
                        <div class="card" style="margin-left:35%">Welcome to Dashboard
                            <b>{{Auth::user()->name}}!!</b>
                        </div>
                        <center>
                            <h1><span style='font-size:30px;'>&#128218;</span> PERPUSTAKAAN</h1>
                        </center>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



