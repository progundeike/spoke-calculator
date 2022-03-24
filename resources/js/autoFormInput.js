$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

//autoFormInput
$('#selectRim').change(function() {
  var selectedRim = $(this).val();
  $.ajax({
      type: "POST",
      url: "/rim/input",
      data: { "selectedRim" : selectedRim },
      dataType: "json"
  }).done(function(data) {
      //成功の処理
      $('#hole').val(data.hole);
      $('#erd').val(data.erd);
      $('#rimOffset').val(data.rimOffset);
      $('#nippleHoleGap').val(data.nippleHoleGap);
  }).fail(function(){
      //エラーの処理
      alert('データベースに不具合が発生しました。手動での入力をお願い致します。')
  });
});

$('#selectedHub').change(function() {
  var selectedHub = $(this).val();
  $.ajax({
      type: "POST",
      url: "/hub/input",
      data: { "selectedHub" : selectedHub },
      dataType: "json"
  }).done(function(data) {
      //成功の処理
      $('#centerFlangeR').val(data.centerFlangeR);
      $('#centerFlangeL').val(data.centerFlangeL);
      $('#pcdR').val(data.pcdR);
      $('#pcdL').val(data.pcdL);
  }).fail(function(){
      //エラーの処理
      alert('データベースに不具合が発生しました。手動での入力をお願い致します。')
  });
});
