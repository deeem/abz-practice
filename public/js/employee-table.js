$(document).ready(function() {

  $(document).on('click', '.pagination a', function (e) {
    getPosts($(this).attr('href'));
    e.preventDefault();
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
