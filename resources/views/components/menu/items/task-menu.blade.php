<x-menu.base.li-menuitem :routes="'tasks'" :label="'Tasks'"/>
<x-menu.base.route-menuitem href="{{route('myTasks',[2])}}" :label="'My Tasks'"/>
<x-menu.base.route-menuitem href="{{route('openTasks',[3])}}" :label="'Open Tasks'"/>

@if(auth()->id()==1)
    <x-menu.base.route-menuitem href="{{route('allTasks',[4])}}" :label="'All Tasks'"/>
@endif

