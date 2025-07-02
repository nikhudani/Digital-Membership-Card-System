<?php

namespace App\Models\Dashboard\Membership\Details;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{

    use HasFactory;
    
    public $table = 'membership_social_links';

    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'customer_id',
        'website',
        'twitter',
        'facebook',
        'instagram',
        'reddit',
        'tumblr',
        'youtube',
        'linkedin',
        'whatsapp',
        'pinterest',
        'tiktok',
    ];

}
