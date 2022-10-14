<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email', 'username', 'password', 'is_online', 'profile'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'profile',
    ];

    public function getProfileAttribute()
    {
        return "https://bareillycollege.org/wp-content/uploads/2022/07/david-beckham-1024x768.webp";
    }

    public function socialMedia()
    {
        return $this->hasOne(SocialMedia::class);
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class, 'chats_users');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id');
    }

    // users that follow this user
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id');
    }

    public function blockedAccounts()
    {
        return $this->belongsToMany(User::class, 'blocked', 'created_by', 'blocked_user');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class)->latest('created_at')->limit(25);
    }


    public function isNotTheUser(User $user)
    {
        return $this->id !== $user->id;
    }

    public function isFollowing(User $user)
    {
        return (bool) $this->following->where('id', $user->id)->count();
    }

    public function canFollow(User $user)
    {
        if (!$this->isNotTheUser($user)) {
            return false;
        }
        return !$this->isFollowing($user);
    }

    public function canUnfollow(User $user)
    {
        return $this->isFollowing($user);
    }

    //     User $a wants to follow user $b:

    //     $a->following()->attach($b);

    //     User $a wants to stop following user $b:

    // $a->following()->detach($b);

    // Get all followers of user $a:

    // $a_followers = $a->followers()->get();

}
