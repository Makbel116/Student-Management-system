// Simple-DataTables
// https://github.com/fiduswriter/Simple-DataTables/wiki
window.addEventListener('DOMContentLoaded', event => {

    const Batch = document.getElementById('Batch');
    if (Batch) {
        new simpleDatatables.DataTable(Batch);
    }

    const Student= document.getElementById('Student');
    if (Student) {
        new simpleDatatables.DataTable(Student);
    }

    const Course= document.getElementById('Course');
    if (Course) {
        new simpleDatatables.DataTable(Course);
    }

    const Teacher= document.getElementById('Teacher');
    if (Teacher) {
        new simpleDatatables.DataTable(Teacher);
    }
});