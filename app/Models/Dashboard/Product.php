<?php

namespace App\Models\Dashboard;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
 
    use Translatable;

    # -------------------- THE TABLE ASSOCIATED WITH THE MODEL ------------------- #
    protected $table = 'products';
    protected $with = ["translations"];
    public $translatedAttributes = ['description', 'name'];
    # ----------------- THE ATTRIBUTES THAT ARE MASS ASSIGNNABLE ----------------- #
    protected $guarded = [];


    # -------------------------------- UPLOAD PATH ------------------------------- #
    const UPLOADPATH = 'images/';

    # ------------------------------- UPLOAD FIELDS ------------------------------ #
    const UPLOADFIELDS = [];
    # ----------------------------------- CASTS ---------------------------------- #
    protected $casts = [
        //fields to cast
    ];
    public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}

}


##----------------------------------------RELATIONSHIPS

##----------------------------------------ATTRIBUTES

##----------------------------------------CUSTOM FUNCTIONS

##----------------------------------------SCOPS

##----------------------------------------ACCESSORS AND MUTATORS