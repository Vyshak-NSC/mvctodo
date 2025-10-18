document.addEventListener('DOMContentLoaded', function(){
    const filters = document.querySelectorAll('.filter-button');
    console.log(filters);
    filters.forEach(function(filter){
        filter.addEventListener('click', function(){
            const statusInput = filter.querySelector('input');
            const status = statusInput.getAttribute('data-status');
            console.log('Filter tasks by status: ' + status);
        });
    });
});