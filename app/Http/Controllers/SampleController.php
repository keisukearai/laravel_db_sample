<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

/**
 * SampleController
 */
class SampleController extends Controller {
    
    /**
     * 処理表示処理
     * @return object view形式
     */
    public function index() {
        // SQL文
        $sql = 'select * from users order by id desc';
        // SQL実行
        $list = DB::select($sql);
        // dd($list);
        
        // 出力値
        $output = [];
        $output['title'] = "一覧";
        $output['list'] = $list;
        return view('index', $output);
    }
    
    /**
     * 新規登録処理
     * @param Request $request リクエスト情報
     * @return object json形式
     */
    public function insert(Request $request) {
        
        // 画面の名前
        $r_name = $request->input('name');
        
        // SQL文(連番の最大値を取得)
        $sql = 'select max(id) + 1 as max_id from users';
        // SQL実行
        $max = DB::select($sql);
        $max_id = $max[0]->max_id;
        
        // SQL文
        $sql = "insert into users values ('$max_id', '$r_name')";
        // SQL実行
        DB::insert($sql);
        // コミット
        DB::commit();
        
        // 出力値
        $response = [];
        $response['status'] = "OK";
        
        return Response::json($response);
    }
    
    /**
     * 更新処理
     * @param Request $request リクエスト情報
     * @return object json形式
     */
    public function update(Request $request) {

        // 画面のID
        $r_id = $request->input('id');
        // 画面の名前
        $r_name = $request->input('name');
        
        // SQL文
        $sql = "update users set u_name = '$r_name' where id = '$r_id'";
        // SQL実行
        DB::update($sql);
        // コミット
        DB::commit();
        
        // 出力値
        $response = [];
        $response['status'] = "OK";
        
        return Response::json($response);
    }
    
    /**
     * 削除処理
     * @param Request $request リクエスト情報
     * @return object json形式
     */
    public function delete(Request $request) {
        
        // 画面のID
        $r_id = $request->input('id');
        
        // SQL文
        $sql = "delete from users where id = '$r_id'";
        // SQL実行
        DB::delete($sql);
        // コミット
        DB::commit();
        
        // 出力値
        $response = [];
        $response['status'] = "OK";
        
        return Response::json($response);
    }
}
