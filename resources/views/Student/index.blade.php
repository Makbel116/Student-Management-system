<x-layout>
  @if(Auth::user()->can('create students'))
  <div class="my-4"><a href="/student/register"><i class="fas fa-plus"> </i> create a new student</a></div>
  @endif
    <x-table  title="Student" :collection="$students"/>
</x-layout>