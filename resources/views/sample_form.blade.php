<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <h1><a href="sample_form">{{ $title }}</a></h1>
        <?php // 新規入力エリア ?>
        <form method="post" action="sample_form_insert">
            {{ csrf_field() }}
            <div style="padding-left:60px;">
                <input type="text" value="" name="u_name" />
                <input type="submit" value="新規作成" />
            </div>
        </from>
        <?php // 更新・削除エリア ?>
        <form method="post">
        <ul>
            <?php // dd($list); ?>
            @foreach ($list as $data)
            <?php // dd($data); ?>
                <li>
                    {{ $data->id }}:
                    <input type="text" value="{{ $data->u_name }}" id="u_name_{{ $data->id }}" />
                    <input type="button" value="更新" data-action="sample_form_update" class="btn_up" id="btn_up_{{ $data->id }}" />
                    <input type="button" value="削除" data-action="sample_form_delete" class="btn_del" id="btn_del_{{ $data->id }}" />
                </li>
            @endforeach
        </ul>
        </form>
        <!-- </from> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                /*
                 * 更新ボタン押下処理
                 */
                $(".btn_up").click(function() {
　                  let btn_id = $(this).attr("id");
　                  // btn_id = btn_up_3
　                  let id = btn_id.split("_")[2];
　                  console.log(id);
　                  let u_name = $("#u_name_" + id).val();
　                  
　                  let form = $(this).parents('form');
　                  form.attr('action', $(this).data('action'));
　                  $('<input>').attr({
                        'type': 'hidden',
                        'name': 'id',
                        'value': id
                    }).appendTo(form);
                    
                    $('<input>').attr({
                        'type': 'hidden',
                        'name': 'u_name',
                        'value': u_name
                    }).appendTo(form);
　                  
　                  // サブミット
　                  form.submit();

                }); // end btn_up

                /*
                 * 削除ボタン押下処理
                 */
                $(".btn_del").click(function() {
　                  let btn_id = $(this).attr("id");
　                  // btn_id = btn_up_3
　                  let id = btn_id.split("_")[2];
　                  
　                  // 削除確認
                    if (confirm("本当に「" + id + "」を削除しますか？") === false) {
                        return false;
                    }

                    let form = $(this).parents('form');
　                  form.attr('action', $(this).data('action'));
　                  $('<input>').attr({
                        'type': 'hidden',
                        'name': 'id',
                        'value': id
                    }).appendTo(form);
　                  
　                  // サブミット
　                  form.submit();
                }); // end btn_del
            }); // end ready
        </script>
    </body>
</html>