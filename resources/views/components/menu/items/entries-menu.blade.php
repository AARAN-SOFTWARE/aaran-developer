<x-menu.base.li-menuitem :routes="'sales'" :label="'Sales'"/>
<x-menu.base.li-menuitem :routes="'purchase'" :label="'Purchase'"/>
<x-menu.base.li-menuitem :routes="'exportsales'" :label="'Export Sales'"/>
<x-menu.base.route-menuitem  href="{{route('transactions',[1])}}" :label="'Receipt'"/>
<x-menu.base.route-menuitem  href="{{route('transactions',[2])}}" :label="'Payment'"/>
