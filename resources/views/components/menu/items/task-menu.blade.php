<x-menu.base.li-menuitem :routes="'tasks'" :label="'Tasks'"/>
{{--<x-menu.base.route-menuitem href="{{route('tasks',[1])}}" :label="'Tasks'"/>--}}
<x-menu.base.route-menuitem href="{{route('myTasks',[2])}}" :label="'My Tasks'"/>
<x-menu.base.route-menuitem href="{{route('publicTasks',[3])}}" :label="'Open Tasks'"/>

@if(auth()->id()==1)
    <x-menu.base.route-menuitem href="{{route('allTasks',[4])}}" :label="'All Tasks'"/>
@endif
{{--<x-menu.base.li-menuitem :routes="'activity'" :label="'Activity'"/>--}}

