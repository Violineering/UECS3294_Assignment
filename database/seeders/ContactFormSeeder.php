<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContactFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contactform')->insert([
            [
                'user_id' => 1, // Assuming user_id 1 exists in the users table
                'issue' => 'I am unable to reset my password.',
                'reply' => 'Please check your email for a password reset link.',
                'status' => 'resolved',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'issue' => 'My book purchase did not go through.',
                'reply' => 'We are looking into this issue. Please wait for further updates.',
                'status' => 'in-progress',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'issue' => 'How can I contact customer support?',
                'reply' => 'You can reach us via our support email or chat.',
                'status' => 'resolved',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
