<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <h1>{{ $title }}</h1>
        <?php // 新規入力エリア ?>
        <div style="padding-left:60px;">
            <input type="text" value="" id="u_name" />
            <input type="button" value="新規作成" id="btn_insert" />
        </div>
        <?php // 更新・削除エリア ?>
        <ul>
            <?php // dd($list); ?>
            @foreach ($list as $data)
            <?php // dd($data); ?>
                <li>
                    {{ $data->id }}:
                    <input type="text" value="{{ $data->u_name }}" id="u_name_{{ $data->id }}" />
                    <input type="button" value="更新" class="btn_up" id="btn_up_{{ $data->id }}" />
                    <input type="button" value="削除" class="btn_del" id="btn_del_{{ $data->id }}" />
                </li>
            @endforeach
        </ul>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                /*
                 * 新規ボタン押下処理
                 */
                $("#btn_insert").click(function() {
                    // ajaxSetup
                    $.ajaxSetup({
　　                    headers: {
　　　                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
　　                    }
　                  });

                    // 名前
　                  let name = $("#u_name").val();
　                  
　                  // ajax実行
　                  $.ajax({
　　　                  type: "POST",
　　　                  // 送信data
　　　                  data: {
　　　　                    name: name
　　　                  },
　　　                  // url
　　　                  url: 'sample_insert',
　　　                  dataType: "json",
　　　                  // 通信に成功した場合
　　　                  success: function(json) {
　　　　                    console.log(json);
　　　　                    alert("新規登録に成功しました！！！");
　　　　                    // 再表示
                            setTimeout(function() {
                                // 画面リロード
                                window.location.href = "sample";
                            }, 500);
　　　                  },
　　　                  // 失敗した場合
　　　                  error: function(XMLHttpRequest, textStatus, errorThrown) {
　　　　                    alert("新規登録時にエラーが発生しました：" + textStatus + ":\n" + errorThrown);
　　　                  }
　                  });
                }); // end btn_insert

                /*
                 * 更新ボタン押下処理
                 */
                $(".btn_up").click(function() {
                    // ajaxSetup
                    $.ajaxSetup({
　　                    headers: {
　　　                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
　　                    }
　                  });

　                  let btn_id = $(this).attr("id");
　                  // btn_id = btn_up_3
　                  let id = btn_id.split("_")[2];
　                  console.log(id);
　                  let name = $("#u_name_" + id).val();

　                  // ajax実行
　                  $.ajax({
　　　                  type: "POST",
　　　                  // 送信data
　　　                  data: {
　　　                      id: id,
　　　　                    name: name
　　　                  },
　　　                  // url
　　　                  url: 'sample_update',
　　　                  dataType: "json",
　　　                  // 通信に成功した場合
　　　                  success: function(json) {
　　　　                    console.log(json);
　　　　                    alert("更新に成功しました！！！");
　　　　                    // 再表示
                            setTimeout(function() {
                                // 画面リロード
                                window.location.href = "sample";
                            }, 500);
　　　                  },
　　　                  // 失敗した場合
　　　                  error: function(XMLHttpRequest, textStatus, errorThrown) {
　　　　                    alert("更新時にエラーが発生しました：" + textStatus + ":\n" + errorThrown);
　　　                  }
　                  });
                }); // end btn_up

                /*
                 * 削除ボタン押下処理
                 */
                $(".btn_del").click(function() {
                    // ajaxSetup
                    $.ajaxSetup({
　　                    headers: {
　　　                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
　　                    }
　                  });

　                  let btn_id = $(this).attr("id");
　                  // btn_id = btn_up_3
　                  let id = btn_id.split("_")[2];
　                  
　                  // 削除確認
                    if (confirm("本当に「" + id + "」を削除しますか？") === false) {
                        return false;
                    }

　                  // ajax実行
　                  $.ajax({
　　　                  type: "GET",
　　　                  // 送信data
　　　                  data: {
　　　                      id: id
　　　                  },
　　　                  // url
　　　                  url: 'sample_delete',
　　　                  dataType: "json",
　　　                  // 通信に成功した場合
　　　                  success: function(json) {
　　　　                    console.log(json);
　　　　                    alert("削除に成功しました！！！");
　　　　                    // 再表示
                            setTimeout(function() {
                                // 画面リロード
                                window.location.href = "sample";
                            }, 500);
　　　                  },
　　　                  // 失敗した場合
　　　                  error: function(XMLHttpRequest, textStatus, errorThrown) {
　　　　                    alert("削除時にエラーが発生しました：" + textStatus + ":\n" + errorThrown);
　　　                  }
　                  });
                }); // end btn_del
            }); // end ready
        </script>
    </body>
</html>