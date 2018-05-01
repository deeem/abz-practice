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
