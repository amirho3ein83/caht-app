<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                ->withQueryString()
                ->through(fn ($user) => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'profile' => $user->profile
                ]);
        }else{
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        return Inertia::render('Users/Edit');
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
}
