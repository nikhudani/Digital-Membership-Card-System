<?php

namespace App\Models\Dashboard\Vendor;

use App\Models\Dashboard\Vendor\Settings\Category;
use App\Models\Dashboard\Vendor\Settings\Location;
use App\Models\Dashboard\Vendor\Settings\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VendorDetail extends Model
{
    
    use HasFactory;
    
    protected $primaryKey = 'vendor_id';

    protected $fillable = [
        'vendor_id',
        'types',
        'categories',
        'locations',
    ];

    public function vendor() : BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

    protected function types() : Attribute 
    { 
        return Attribute::make(
            get: fn ($value) => $this->collect($value, 'type'),
            set: fn ($value) => json_encode($value),
        );
    }
    
    protected function categories() : Attribute 
    { 
        return Attribute::make(
            get: fn ($value) => $this->collect($value, 'category'),
            set: fn ($value) => json_encode($value),
        );
    }
    
    protected function locations() : Attribute 
    { 
        return Attribute::make(
            get: fn ($value) => $this->collect($value, 'location'),
            set: fn ($value) => json_encode($value),
        );
    }
    
    public function collect($value, $path)
    {
        $decData = json_decode($value);
        $datas = [];

        foreach ($decData as $id) {
            if ($path == 'type') {
                $type = Type::find($id);
                if ($type) {
                    $datas[] = $type->toArray();
                }
            }

            if ($path == 'category') {
                $category = Category::find($id);
                if ($category) {
                    $datas[] = $category->toArray();
                }
            }

            if ($path == 'location') {
                $location = Location::find($id);
                if ($location) {
                    $datas[] = $location->toArray();
                }
            }
        }

        return $datas;
    }
    
}
