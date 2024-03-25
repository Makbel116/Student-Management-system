<x-layout>
    {{-- remaining work- pagination --}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>

    </div>
    <x-table title="Batch" :collection="$batches"/>
    <x-table title="Student" :collection="$students" />
    <x-table title="Course" :collection="$courses" />
    <x-table title="Teacher" :collection="$teachers" />

</x-layout>
