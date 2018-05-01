$(document).ready(function() {

  $('.employee-form-superviser').select2({
    minimumInputLength: 2,
    ajax: {
      url: '/api/superviser',
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

$(document).ready(function(){

  $('.lazy-employee-expand').first().data('id', 1).data('expanded', false);

  $(document).on('click', '.lazy-employee-expand',function (e) {
    e.preventDefault();
    var url = 'api/subordinates?parent=' + $(this).data('id');
    var parent = $(this).parent().parent().parent();

    if (! $(this).data('expanded')) {
      $(this).data('expanded', true);
      $(this).text('collapse');

      $.ajax({
        url: url,
        dataType: 'json',
      }).done(function(data) {
        if (data.length > 0) {
          var subordinatesList = generateList(data);
          parent.after(subordinatesList);
        }
      }).fail(function(){
        alert('Network error');
      });
    } else {
      parent.next('.lazy-employee-list').remove();
      $(this).data('expanded', false);
      $(this).text('expand');
    }

    function generateList(data) {
      var ul = $('<div class="lazy-employee-list pl-5"></div>');
      var li = '';
      var contents = '';
      for (var i = 0; i < data.length; i++) {

        contents = $('<div class="row"></div>');
        if (data[i].photo) {
          $('<div class="col-3">' +
          '<img class="img-thumbnail" src="/storage/thumbs/' + data[i].photo + '">' +
          '</div>'
        ).appendTo(contents);
        } else {
          $('<div class="col-3"></div>').appendTo(contents);
        }

        $('<div class="col-7">' +
          '<p>' + data[i].name + ', <span class="text-secondary">' + data[i].position + '</span></p>' +
          '<div>'
        ).appendTo(contents);

        if (data[i].expandable) {
          $('<div class="col-2">' +
            '<a href="/employee/' + data[i].id +'/show" class="btn btn-outline-primary mt-1 mb-1 pl-2 pr-2">show</a>' +
            '<a href="#" class="btn btn-outline-info lazy-employee-expand" data-id="' + data[i].id +'" data-expanded="false">expand</a>' +
            '</div>'
          ).appendTo(contents);
        } else {
          $('<div class="col-2">' +
            '<a href="/employee/' + data[i].id +'/show" class="btn btn-outline-primary mt-1 mb-1 pl-2 pr-2">show</a>' +
            '</div>'
          ).appendTo(contents);
        }

        li = $('<div class="lazy-employee-item bg-white rounded shadow">');
        contents.appendTo(li);
        li.appendTo(ul);
      }

      return ul;
    }

  });

});
