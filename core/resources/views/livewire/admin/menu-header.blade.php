<div class="collapse navbar-collapse " id="sidebar-menu">
    <ul class="navbar-nav pt-lg-3">
        @foreach($menus as $menu)
            @if(Auth::user()->can($menu->permission))
                @if($menu->children->isEmpty())
                    <li class="nav-item  @if(request()->is($menu->url)) rounded rounded-2 bg-primary @endif">
                        <a class="nav-link text-white" wire:navigate  href="{{route($menu->permission)}}">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="{{$menu->icon}}"></i>
                                    </span>
                            <span class="nav-link-title">
                                        {{ $menu->title}}
                                    </span>
                        </a>
                    </li>
                @else
                    <li class="nav-item  dropdown @if(request()->is($menu->url)) rounded rounded-2 bg-primary @endif">
                        <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <i class="{{$menu->icon}}"></i>
                                    </span>
                            <span class="nav-link-title">
                                        {{ $menu->title}}
                                    </span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($menu->children as $child)
                                @if(Auth::user()->can($child->permission))
                                    <li><a class="dropdown-item text-white
                                     @if(request()->is($child->url)) bg-primary @endif
                                    " href="{{route($child->permission)}}">{{ $child->title }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endif
        @endforeach
    </ul>
</div>
