<x-layout>
   {{-- remaining work- pagination --}}
    <x-table title="Student" :collection="$students" />
    <x-table title="Course" :collection="$courses" />
    <x-table title="Teacher" :collection="$teachers" />

</x-layout>
