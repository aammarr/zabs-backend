<div class="col-md-3">

    @if(Auth::user()->role_id==1)
        @foreach($laravelAdminMenus->menus as $section)
            @if($section->items)
                <div class="panel panel-default panel-flush">
                    <div class="panel-heading">
                        {{ $section->section }}
                    </div>

                    <div class="panel-body">
                        <ul class="nav" role="tablist">
                            @foreach($section->items as $menu)
                                <li role="presentation">
                                    <?php  if(!empty($menu->title))  : ?>
                                    <a href="{{ url($menu->url) }}">
                                        {{ $menu->title }}
                                    </a>
                                    <?php endif; ?>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        @endforeach
    @elseif(Auth::user()->role_id==2)
        @foreach($laravelAdminMenus->menus as $section)
            @if($section->items)
                <div class="panel panel-default panel-flush">
                    <div class="panel-heading">
                        {{ $section->section }}
                    </div>

                    <div class="panel-body">
                        <ul class="nav" role="tablist">
                            @foreach($section->items as $menu)
                                <li role="presentation">
                                    <?php  if(!empty($menu->title))  : ?>
                                    <a href="{{ url($menu->url) }}">
                                        {{ $menu->title }}
                                    </a>
                                    <?php endif; ?>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>
