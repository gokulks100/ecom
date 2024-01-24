@php

    $admin = new App\Http\Controllers\AdminController();

    $roles = $admin->getRoles();

    // if( isset(request()->route()->action['as'] == "dashboard") ? "active" : "" }})

@endphp

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div href="#" class="nav-link">
                {{-- <div class="nav-profile-image">
                    <img src="images/faces/face1.jpg" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div> --}}
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ $user->name ?? '' }}</span>
                    {{-- <span class="text-secondary text-small">{{ $role->role }}</span> --}}
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </div>
        </li>
        {{-- <li class="nav-item {{ request()->route()->action['as'] == 'dashboard' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li> --}}
        @php
        $i = 0;
        @endphp
        @foreach ($roles as $title)
            @if ($title->menu_count > 1)
                <li class="nav-item {{ (request()->route()->action['as'] == 'roles' ||  request()->route()->action['as'] ==  "users" || request()->route()->action['as'] ==  "notified-list") ? 'active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic{{$i}}" aria-expanded="false"
                        aria-controls="ui-basic">
                        <span class="menu-title">{{ $title->title }} </span>
                        <i class="menu-arrow"></i>
                        <i class="mdi {{ $title->icon }}"></i>
                    </a>
                    <div class="collapse {{ (request()->route()->action['as'] ==  "users" ||  request()->route()->action['as'] ==  "roles" || request()->route()->action['as'] ==  "notified-list")  ? 'show' : '' }}"
                        id="ui-basic{{$i++}}">
                        <ul class="nav flex-column sub-menu">
                            @php
                                $privileges = json_decode($admin->getRolePrivileges($title->title));
                            @endphp
                            @foreach ($privileges as $privilege)
                                <li class="nav-item"> <a class="nav-link {{ request()->route()->action['as'] == $privilege->value ? 'active' : '' }}"
                                        href="{{ route($privilege->value) }}">{{ $privilege->privilege }}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </li>
                @php
                    $i++;
                @endphp
            @else
                <li class="nav-item {{ request()->route()->action['as'] == $title->value ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route($title->value) }}">
                        <span class="menu-title">{{ $title->title }}</span>
                        <i class="mdi {{ $title->icon }}"></i>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</nav>
