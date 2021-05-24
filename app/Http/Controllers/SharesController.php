<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SharesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //「モデル名::all()」で全データを取得
        $items = Share::all();
        return response()->json([
            'message' => 'OK',
            'data' => $items
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //データを追加するため
        $item = new Share;  //モデル作成
        $item->user_id = $request->user_id;
        $item->share = $request->share;
        $item->save();  //値を確定
        return response()->json([
            'message' => 'Share created successfully',
            'data' => $item
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Share $share)
    {
        $item = Share::where('id' ,$share->id)->first();
        $like = DB::table('likes')->where('share_id',$share->id)->get();
        $user_id = $item->user_id;
        $user = DB::table('users')->where('id',(int)$user_id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Share::where('id', $share->id)->delete();
        if($item) {
            return response()->json(
                ['message' => 'Share deleted successfully'],
                200
            );
        }else {
            return response()->json(
                ['message' => 'Share not found'],
                404
            );
        }
    }
}
