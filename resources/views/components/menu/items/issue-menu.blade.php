<x-menu.base.li-menuitem :routes="'issues'" :label="'Issues'"/>
<x-menu.base.route-menuitem href="{{route('myIssues',[2])}}" :label="'My Issues'"/>
<x-menu.base.route-menuitem href="{{route('openIssues',[3])}}" :label="'Open issues'"/>

@if(auth()->id()==1)
    <x-menu.base.route-menuitem href="{{route('allIssues',[4])}}" :label="'All Issues'"/>
@endif
