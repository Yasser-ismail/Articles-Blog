<div class="sidebar" data-color="purple" data-background-color="black"
     data-image="{{asset('assets/img/sidebar-2.jpg')}}">

    <div class="logo">
        <a href="{{route('home')}}" class="simple-text logo-normal">
            Test
        </a>
    </div>
    <div class="sidebar-wrapper ps-container ps-theme-default" data-ps-id="24274ac7-bb71-cb08-c704-2cbd9fca4029">
        <ul class="nav">
            <li class="nav-item {{Request::is('admin/home') ? 'active' : ''}}  ">
                <a class="nav-link" href="{{route('admin.home')}}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{Request::path() === 'admin/users' ? 'active' : ''}}  ">
                <a class="nav-link" href="{{route('users.index')}}">
                    <i class="material-icons">person</i>
                    <p>Users</p>
                </a>
            </li>
            <li class="nav-item {{Request::is('admin/posts') ? 'active' : ''}}  ">
                <a class="nav-link" href="{{route('posts.index')}}">
                    <i class="material-icons">lists_content</i>
                    <p>Posts</p>
                </a>
            </li>
        </ul>
        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
            <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;">
            <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </div>
    <div class="sidebar-background" style="background-image: url({{asset('/assets/img/sidebar-2.jpg')}}) "></div>
</div>
