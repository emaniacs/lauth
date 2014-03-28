<?php

class UsersTableSeeder extends Seeder {
	public function run()
	{
		//
        User::create(array(
							'username' => 'admin',
							'email' => 'admin@aredhi.com',
							'fullname' => 'Administrator',
							'password' => Hash::make('admin'),
							'role'  => User::getRoleIdByName('admin'),
							'status'  => 1
					));
		User::create(array(
							'username' => 'moderator1',
							'email' => 'moderator1@aredhi.com',
							'fullname' => 'Moderator 1',
							'password' => Hash::make('moderator1'),
							'role'  => User::getRoleIdByName('moderator'),
							'status'  => 1
					));
		User::create(array(
							'username' => 'moderator2',
							'email' => 'moderator2@aredhi.com',
							'fullname' => 'Moderator 2',
							'password' => Hash::make('moderator2'),
							'role'  => User::getRoleIdByName('moderator'),
							'status'  => 1
					));
		User::create(array(
							'username' => 'user1',
							'email' => 'user1@aredhi.com',
							'fullname' => 'Ini Users 1 ',
							'password' => Hash::make('user1'),
							'role'  => User::getRoleIdByName('user'),
							'status'  => 1
					));
                    
        // ini contoh user yang tidak aktif
		User::create(array(
							'username' => 'user2',
							'email' => 'user2@aredhi.com',
							'fullname' => 'Ini Users 2',
							'password' => Hash::make('user2'),
							'role'  => User::getRoleIdByName('user'),
							'status'  => 0
					));
	}
}
