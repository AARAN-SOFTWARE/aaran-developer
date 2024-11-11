<div>
    <x-slot name="header">Issues - Activity</x-slot>

    <div class="flex flex-auto gap-3">
        <div>{{$issue->id}}</div>
        <div>{{$issue->vname}}</div>
        <div>{!! $issue->body !!}</div>
        <div>{{$issue->reporter->name}}</div>
        <div>{{$issue->assignee->name}}</div>
    </div>


</div>
