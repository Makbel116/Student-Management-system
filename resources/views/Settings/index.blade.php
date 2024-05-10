<x-layout>
    @if (Auth::user()->can('read roles'))      
    <x-properties :choosen="$roles" title="Role"/>
    @endif
    @if(Auth::user()->can('read users'))
    <x-properties :choosen="$users" title="User"/>
    @endif
    <x-properties :choosen="$schedules" title="Schedule"/>
    <x-properties :choosen="$locations" title="Location"/>
    <x-properties :choosen="$places" title="Place"/>
</x-layout>