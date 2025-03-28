<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    use HasFactory;

    protected $table = 'contactform'; // Specify the table name
    protected $primaryKey = 'id'; // Specify the primary key column
    
    protected $fillable = [
        'user_id', 
        'issue',   
        'reply',   
        'status',  
    ];

    /**
     * Get the user that submitted the contact form.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
