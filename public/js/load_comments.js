$(document).ready(function(){
    $('#collapse-1').on('shown.bs.collapse', function() {

        $(".service-drop").addClass('fa-chevron-up').removeClass('fa-chevron-down');
    });

    $('#collapse-1').on('hidden.bs.collapse', function() {
        $(".service-drop").addClass('fa-chevron-down').removeClass('fa-chevron-up');
    });
});
