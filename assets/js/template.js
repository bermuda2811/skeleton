$(document).ready(function(){
    //generate select template
    _select_field_area();
    _select_operator_area();
    _select_compare_area();


    function _select_field_area() {
        var table_name = $('#table_name').val();

        $.get(url_get_field, {table_name:table_name}, function(html) {
            $('.select_field_area').html(html);
        });
    }
    function _select_operator_area() {

        $.get(url_get_operator, {}, function(html) {
            $('.select_operator_area').html(html);
        });
    }
    function _select_compare_area() {

    }
    $('.add_condition').click(function() {

    });
});