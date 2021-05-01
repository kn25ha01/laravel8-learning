<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     * ブログ一覧画面を表示する
     * 
     * @return view
     */
    public function showList()
    {
        $blogs = Blog::all();
        //dd($blogs);
        return view('blog.list', ['blogs' => $blogs]);
    }

    /**
     * ブログ詳細画面を表示する
     * 
     * @param int $id
     * @return view
     */
    public function showDetail($id)
    {
        $blog = Blog::find($id);
        //dd($blogs);

        // データが存在しない場合
        if (is_null($blog)) {
            // セッション作成
            \Session::flash('err_msg', 'データがありません。');

            // 元のページにリダイレクト
            return redirect(route('blogs'));
        }

        // 詳細画面へ
        return view('blog.detail', ['blog' => $blog]);
    }

    /**
     * ブログ登録画面を表示する
     * 
     * @return view
     */
    public function showCreate() {
        return view('blog.form');
    }

    /**
     * ブログを登録する
     * 
     * @return view
     */
    public function exeStore(BlogRequest $request) {

        // 入力データを受け取る
        $inputs =$request->all();

        \DB::beginTransaction();
        try {
            // ブログを登録
            Blog::create($inputs);
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        // セッション作成
        \Session::flash('err_msg', 'ブログを登録しました');

        // リダイレクト
        return redirect(route('blogs'));
    }

    /**
     * ブログ編集フォームを表示する
     * 
     * @param int $id
     * @return view
     */
    public function showEdit($id)
    {
        $blog = Blog::find($id);
        //dd($blogs);

        // データが存在しない場合
        if (is_null($blog)) {
            // セッション作成
            \Session::flash('err_msg', 'データがありません。');

            // 元のページにリダイレクト
            return redirect(route('blogs'));
        }

        // 詳細画面へ
        return view('blog.edit', ['blog' => $blog]);
    }

    /**
     * ブログを更新する
     * 
     * @return view
     */
    public function exeUpdate(BlogRequest $request) {

        // 入力データを受け取る
        $inputs =$request->all();

        \DB::beginTransaction();
        try {
            // ブログを更新
            $blog = Blog::find($inputs['id']);
            $blog->fill([
                'title' => $inputs['title'],
                'content' => $inputs['content'],
            ]);
            $blog->save();
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }

        // セッション作成
        \Session::flash('err_msg', 'ブログを更新しました');

        // リダイレクト
        return redirect(route('blogs'));
    }

    /**
     * ブログ削除
     * 
     * @param int $id
     * @return view
     */
    public function exeDelete($id)
    {
        if (empty($id)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('blogs'));
        }

        try {
            Blog::destroy($id);
        } catch(\Throwable $e) {
            abort(500);
        }

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('blogs'));
    }
}
