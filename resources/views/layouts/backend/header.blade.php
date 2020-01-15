<header class="main-header">
    <a href="" class="logo">
      <span class="logo-lg"><b>Perpustakaan</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <div class = user-info >
                        @php
                        if (Auth::user()->avatar && file_exists(public_path(). '/assets/backend/dist/img/user/'. Auth::user()->avatar )){
                            $img = asset('/assets/backend/dist/img/user/' . Auth::user()->avatar);
                        }
                        else{
                            $img = asset('/assets/backend/dist/img/user/avatar5.png');
                        }
                        @endphp
                    </div>
                    <div class="image" ><img src="{{ $img }}" alt="User Image" style="width:20px; height:20px;">
                    <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </div>
                    </a>
                    <ul class="dropdown-menu">
                    <!-- User image -->
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
                    <h3>{{Auth::user()->name}}</h3></center>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                        <a href="profil" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"> Sign out
                        </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                            </form>
                        </div>
                    </li>
                    </ul>
                </li>
            <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>
