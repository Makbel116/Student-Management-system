<x-layout>
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Students Per Batch
                </div>
                <div class="card-body"><canvas id="myBarChart" width="100%" height="50" data-values="{{ json_encode($dataFromViewforBar) }}"
                    student-counts-per-batch="{{ json_encode($studentCountsPerBatch) }}"></canvas></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Students Per Course
                </div>
                <div class="card-body"><canvas id="myPieChart" data-values="{{ json_encode($dataFromViewforPie) }}"
                    student-counts-per-course="{{ json_encode($studentCountsPerCourse) }}"></canvas></div>
            </div>
        </div>
    </div>
    
    <x-table title="Student" :collection="$students" />
   

   
        
</x-layout>
