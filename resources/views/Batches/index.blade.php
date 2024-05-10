<x-layout>
  @if(Auth::user()->can('create batches'))
  <div class="my-4"><a href="/batch/register"><i class="fas fa-plus"> </i> create a new batch</a></div>
@endif
    <x-table title="Batch" :collection="$batches"/>
</x-layout>