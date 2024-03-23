<x-layout>
    <x-table  title="Student" :collection="$students"/>
    {{ $students->links() }}
</x-layout>