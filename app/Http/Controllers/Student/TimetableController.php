<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index()
    {
        return view('student.timetable');
    }

    public function store(){
        //good for when source of data is an excel
        //avoid using a foreach loop
        $user = User::upsert(
            [
                ['email' => "admin@domain.com", 'name' => "Admin 1", 'password' => bcrypt('password')],
                ['email' => "admin2@domain.com", 'name' => "Admin 2", 'password' => bcrypt('password')],
            ],
            ['email'], //condition (unique by)
            ['name','password']//fields to update or insert
        );

        //to know where the eleqoent model was changed recently or during a request

        $user = User::firstOrCreate([
            ['email' => 'admin@domain.com'],
            ['name' => 'Admin', 'password'=> bcrypt('password')]
        ]);

        echo $user->wasRecentlyCreated ? 'Created' : 'Found';

        //if you change any property before saving
        $user->name = "Admin updated";
        echo $user->isDirty() ? 'Edited' : 'Unedited';

        //if you change a specific property before saving
        $user->name = "Admin updated";
        echo $user->isDirty('name') ? 'Name Edited' : 'Name Unedited';

        //checking if was saved to the database
        $user->save();

        //if you change any property after saving
        $user->name = "Admin updated";
        echo $user->wasChanged() ? 'Changed' : 'Unchanged';

        //if you change a specific property after saving
        $user->name = "Admin updated";
        echo $user->isDirty('name') ? 'Name change' : 'Name unchange';

        $user->touch();//to work with updated_at
    }
}
