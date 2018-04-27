$(document).ready(function() {

  $(document).on('click', '.pagination a', function (e) {
    getPosts($(this).attr('href'));
    e.preventDefault();
  });

  $(document).on('click', '.employee-table-sort a', function (e) {
    getPosts($(this).attr('href'));
    e.preventDefault();
  });

  $( "form" ).on( "submit", function( event ) {
    event.preventDefault();
    getPosts($(location).attr('href') + '/?' + $( this ).serialize());
  });

  function getPosts(url) {
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
