<?php

namespace App\Models\Dashboard\Membership;

use App\Models\Dashboard\Vendor\Settings\Category;
use App\Models\Dashboard\Vendor\Settings\Location;
use App\Models\Dashboard\Vendor\Settings\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseHistory extends Model
{

    use HasFactory;

    protected $fillable = [
        'customer_id',
        'vendor_id',
        'type',
        'location',
        'categories',
        'subtotal',
        'discount',
    ];

    public function customer() : BelongsTo
    {
        return $this->belongsTo(Member::class, 'customer_id', 'customer_id');
    }
    
    public function vendor() : BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

    protected function get_type() : BelongsTo 
    { 
        return $this->belongsTo(Type::class, 'type', 'id');
    }
    
    protected function get_location() : BelongsTo 
    { 
        return $this->belongsTo(Location::class, 'location', 'id');
    }
    
    protected function categories() : Attribute 
    { 
        return Attribute::make(
            get: fn ($value) => $this->collect($value, 'category'),
            set: fn ($value) => json_encode($value),
        );
    }

    public function collect($value, $path) 
    {
        $decData = json_decode($value);
        $datas = [];
        foreach ($decData as $id) {
            if ($path == 'type') {
                $datas[] = Type::find($id)->toArray();
            }
            if ($path == 'category') {
                $datas[] = Category::find($id)->toArray();
            }
            if ($path == 'location') {
                $datas[] = Location::find($id)->toArray();
            }
        }
        
        return $datas;
    }
    
}
