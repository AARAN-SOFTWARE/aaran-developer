<x-menu.base.li-menuitem :routes="'myTask'" :label="'My Task'"/>
<x-menu.base.li-menuitem :routes="'allTask'" :label="'All Task'"/>
<x-menu.base.li-menuitem :routes="'publicTask'" :label="'Public Task'"/>

@if(auth()->id()==1)
<x-menu.base.li-menuitem :routes="'viewAllTask'" :label="'View All Task'"/>
@endif
<x-menu.base.li-menuitem :routes="'activity'" :label="'Activity'"/>

