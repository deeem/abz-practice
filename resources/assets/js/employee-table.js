$(document).ready(function() {

  $(document).on('click', '.pagination a', function (e) {
    getEmployees($(this).attr('href'));
    e.preventDefault();
  });

  $(document).on('click', '.employee-table-sort a', function (e) {
    getEmployees($(this).attr('href'));
    e.preventDefault();
  });

  $('.employee-table-search form').on( 'submit', function( event ) {
    event.preventDefault();
    getEmployees($(location).attr('href') + '/?' + $( this ).serialize());
  });

  function getEmployees(url) {
    $.ajax({
        url: url,
        dataType: 'json',
    }).done(function (data) {
        $('.employee-table').html(data);
    }).fail(function () {
        alert('Posts could not be loaded.');
    });
  }

});
