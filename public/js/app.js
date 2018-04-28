$(document).ready(function() {

  $('.employee-form-superviser').select2({
    minimumInputLength: 2,
    ajax: {
      url: '/employee-superviser',
      dataType: 'json',
      data: function (params) {
        return {
          q: $.trim(params.term)
        };
      },
      processResults: function (data) {
        return {
          results: data
        };
      }
    }
  });

});

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
