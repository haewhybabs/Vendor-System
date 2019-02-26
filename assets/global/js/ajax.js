function ajax_articles() {
  $('.show-articles').click(function () {
    $.ajax({
      url: base_url+"index.php?/ajax_demo/give_more_data",
      async: false,
      type: "POST",
      data: "type=article",
      dataType: "html",
      success: function(data) {
        $('#ajax-content-container').html(data);
      }
    })
  });
    
}

$(document).ready(function() {
    setTimeout(function() {
        $.ajax({
        url: _baseUrl + "/your/controller/param",    
        type: 'post',    
        data: {"token": "your_token"}, });   
    }, 10000);
});