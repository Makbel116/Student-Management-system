<x-layout>
    {{-- remaining work- pagination --}}
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    
    <x-table title="Student" :collection="$students" />
    <x-table title="Batch" :collection="$batches" />
    <x-table title="Course" :collection="$courses" />
    <x-table title="Teacher" :collection="$teachers" />

</x-layout>
