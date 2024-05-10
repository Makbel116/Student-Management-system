<x-layout>
  @if (Auth::user()->can('create courses'))
      
  <div class="my-4"><a href="/course/register"><i class="fas fa-plus"> </i> create a new course</a></div>
  @endif
  <x-table  title="Course" :collection="$courses"/>
</x-layout>