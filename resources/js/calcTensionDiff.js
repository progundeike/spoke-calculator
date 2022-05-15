$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(getTensionDiff());

$("#radio").change(function() {
  getTensionDiff();
});

function getTensionDiff() {
  var leftCross = $('input:radio[name="crossL"]:checked').val();
  var rightCross = $('input:radio[name="crossR"]:checked').val();
  $('#left').text(leftCross);
  $('#right').text(rightCross);
  $.ajax({
      type: "POST",
      url: "/tensionDiff",
      data: {
              "leftCross" : leftCross,
              "rightCross" : rightCross,
              },
      dataType: "json"
  }).done(function(data) {
      $('#tensionDiff').text(data);
  }).fail(function(){
      alert('エラーが発生しました');
  });
}
