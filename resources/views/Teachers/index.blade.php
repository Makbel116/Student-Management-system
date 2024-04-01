<x-layout>
  <div class="my-4"><a href="/teacher/register"><i class="fas fa-plus"> </i> create a new teacher</a></div>
  <x-table  title="Teacher" :collection="$teachers"/>
</x-layout>