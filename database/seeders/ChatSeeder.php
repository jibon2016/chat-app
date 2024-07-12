<?php

namespace Database\Seeders;

use App\Models\Chat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Chat::create([
            'sender_id' => 1,
            'receiver_id' => 2,
            'message' => 'Hi',
        ]);

        Chat::create([
            'sender_id' => 2,
            'receiver_id' => 1,
            'message' => 'Helllo',
        ]);

        Chat::create([
            'sender_id' => 1,
            'receiver_id' => 2,
            'message' => 'How are you?',
        ]);

        Chat::create([
            'sender_id' => 2,
            'receiver_id' => 1,
            'message' => 'Iam Fine, How are u?',
        ]);

        Chat::create([
            'sender_id' => 1,
            'receiver_id' => 2,
            'message' => 'Iam fine also.',
        ]);

        Chat::create([
            'sender_id' => 2,
            'receiver_id' => 1,
            'message' => 'Thank You',
        ]);

        Chat::create([
            'sender_id' => 1,
            'receiver_id' => 2,
            'message' => 'Thank you Too',
        ]);
    }
}
