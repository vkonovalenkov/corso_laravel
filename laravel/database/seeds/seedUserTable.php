<?php

use LaraCourse\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class seedUserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        //$sql  = 'INSERT INTO users (name,email,password)';
        //$sql .= ' values (:name,:email,:password)';
        for($i = 0;$i < 30;$i++){
            /*DB::statement($sql,[
                'name'=> Str::random(10),
                'email'=> Str::random(10).'@gmail.com',
                'password'=> Hash::make('password')
            ]);
            */
            /*
            DB::table('users')->insert([
                'name'=> Str::random(10),
                'email'=> Str::random(10).'@gmail.com',
                'password'=> Hash::make('password'),
                'created_at'=> Carbon::now()
            ]);
        }
      */
        factory(User::class,30)->create();
    }
}
