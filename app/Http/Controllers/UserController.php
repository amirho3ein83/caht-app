<?php

namespace App\Http\Controllers;

use App\Models\Blocked;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class UserController extends Controller
{


    const _validation = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::query()

                ->when(FacadesRequest::input('search'), function ($q, $search) {
                    $q->where('name', 'like', "{$search}%");
                })
                ->paginate(18),
            'filters' => FacadesRequest::only('search')
        ]);
    }
    public function exploreUsers(Request $request)
    {

        if ($request->search) {
            $users = User::when($request->search, function ($query, $search) {
                $query->where('username', 'like', "%{$search}%");
            })
                // ->when($request->categories, function ($query, $categories) {
                //     $query->whereIn('username', $categories);
                // })
                ->whereNot('id', Auth::id())
                ->simplePaginate(10)
                ->withQueryString();

            $followings = Auth::user()->followings->pluck('id')->toArray();
            $followers = Auth::user()->followers->pluck('id')->toArray();

            foreach ($users as $key => $user) {


                if (in_array($user['id'], $followings)) {
                    $user['following'] = true;
                } else if (in_array($user['id'], $followers)) {
                    info($user);
                    $user['follow_back_suggest'] = true;
                }
            }
        } else {
            $users = [];
        }

        return Inertia::render('Chat/ExploreUsers', ['users' => $users, 'filters' => $request->get('search', 'categories')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newUser = $request->validate($this->_validation);

        User::create($newUser);
    }


    public function profile($id)
    {

        $person = User::with('socialMedia')->withCount('followers', 'followings')->find($id);

        if (User::find(Auth::id())->isFollowing($id)) {

            $person->following = true;
        } else if (User::find($id)->isFollowing(Auth::id())) {
            info($person->id);
            $person->follow_back_suggest = true;
        }

        return Inertia::render('Chat/Profile', ['person' => $person]);
    }

    public function dashboard()
    {
        $user = User::with('socialMedia')->withCount('followers', 'followings')->find(Auth::id());
        return Inertia::render('Chat/Dashboard', ['user' => $user]);
    }


    public function getFollowers(User $user)
    {
        return $user->followers;
    }

    public function getFollowings(User $user)
    {
        return $user->followings;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $newUser = $request->validate($this->_validation);

        $user->update($newUser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    }


    public function blockAccount($id)
    {
        Blocked::create([
            'created_by' => Auth::id(),
            'blocked_user' => $id
        ]);
    }

    public function unblockAccount($id)
    {
        Blocked::where([['created_by', Auth::id()], ['blocked_user', $id]])->delete();
    }

    public function blockedAccounts($id)
    {
        $ids = Blocked::where([['created_by', Auth::id()], ['blocked_user', $id]])->pluck('blocked_user')->toArray();

        $blocked_accounts = User::whereIn('id', $ids)->get();

        return $blocked_accounts;
    }

    public function getUser(Request $request)
    {
        return User::where('username', $request->username)
            ->first();
    }
    public function getUserInfo(Request $request)
    {
        return  Cache::remember('socialMedia', 60 * 60, function () {
            return Auth::user()->socialMedia;
        });
    }

    // public function getFollowings()
    // {
    //     return  Cache::remember('followings', 60 * 60, function () {
    //         return Auth::user()->followings;
    //     });
    // }
    // public function getFollowers()
    // {
    //     return  Cache::remember('followers', 60 * 60, function () {
    //         return Auth::user()->followers;
    //     });
    // }

    public function follow(User $user)
    {
        User::firstWhere('id', Auth::id())->followings()->attach($user);

        Cache::flush();
    }

    public function unFollow(User $user)
    {
        User::firstWhere('id', Auth::id())->followings()->detach($user);

        Cache::flush();
    }

    // public function onlineUser(Request $request, $id)
    // {
    //     // broadcast(new UserWentOnline($userId))->toOthers();

    //     // here should use redis

    //     User::where('id', $id)->update([
    //         'is_online' => 1
    //     ]);
    // }
    // public function offlineUser(Request $request, $id)
    // {
    //     // broadcast(new UserWentOffline($userId))->toOthers();
    //     // here should use redis

    //     User::where('id', $id)->update([
    //         'is_online' => 0
    //     ]);
    // }


}
