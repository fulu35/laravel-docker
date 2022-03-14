<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApiUser;
use Illuminate\Support\Facades\Redis;
class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cached_users = $this->cachedUsers();
        return view('api_user.local_users')->with('users',  $cached_users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $api_user = new ApiUser();
        $api_user->name = $request->name;
        $api_user->save();

        $cached_users_redis = Redis::get('cached_users');
        if( $cached_users_redis ) {
            $cached_users = unserialize( $cached_users_redis );
        } else {
            $cached_users = [];
        }
        
        array_push( $cached_users, $api_user );
        Redis::set( 'cached_users', serialize($cached_users) );

        return response()->json($api_user->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    protected function cachedUsers() {
        $cached_users = [];
        $cached_users_redis = Redis::get('cached_users');
        if( $cached_users_redis ) {
            $cached_users = unserialize( $cached_users_redis );
        } else {
            $api_users_db = ApiUser::all();
            foreach($api_users_db as $item) {
                array_push($cached_users, $item);
            }
            Redis::set( 'cached_users', serialize($cached_users) );
        }

        return $cached_users;
    }
    public function showForm() {
        $cached_users =$this->cachedUsers();
        $local_users = [];
        foreach($cached_users as $user) {
            array_push($local_users, $user->name);
        }
        return view('api_user.form')->with('local_users',$local_users);
    }
}
