<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedSettings();
    }

    private function seedSettings()
    {
        DB::table('settings')->insert([
            'name' => 'title',
            'value' => 'TAS UseCase LIBRARY',
            'friendly_name' => 'Site Title',
            'description' => 'Main heading and title',
            'validation' => 'required|string|max:255',
            'type' => 'text'
        ]);

        DB::table('settings')->insert([
            'name' => 'description',
            'value' => 'An Online Database of Experimental Usecase Scenarios for Trusted Related Research',
            'friendly_name' => 'Site Description',
            'description' => 'Main description',
            'validation' => 'required|string|max:255',
            'type' => 'text'
        ]);

        DB::table('settings')->insert([
            'name' => 'welcome_text',
            'value' => 'Welcome',
            'friendly_name' => 'Welcome Text',
            'description' => 'Welcome text for the home page',
            'validation' => 'required|string|max:1023',
            'type' => 'textarea'
        ]);

        DB::table('settings')->insert([
            'name' => 'footer_text',
            'value' => 'Some text for footer',
            'friendly_name' => 'Footer Text',
            'description' => 'Text that shows up in the footer',
            'validation' => 'nullable|string|max:1023',
            'type' => 'textarea'
        ]);

        DB::table('settings')->insert([
            'name' => 'how_it_works',
            'value' => 'Sample text',
            'friendly_name' => 'How It Works Page Content',
            'description' => 'Text for How It Works Page',
            'validation' => 'nullable|string|max:10230',
            'type' => 'textarea'
        ]);

        DB::table('settings')->insert([
            'name' => 'about_us',
            'value' => 'Sample text',
            'friendly_name' => 'About Us Page Content',
            'description' => 'Text for About Us Page',
            'validation' => 'nullable|string|max:10230',
            'type' => 'textarea'
        ]);

        DB::table('settings')->insert([
            'name' => 'video_file_path',
            'value' => 'some path',
            'friendly_name' => 'Video File',
            'description' => 'Video file for the home page',
            'validation' => 'required|string|max:1023',
            'type' => 'file'
        ]);

        DB::table('settings')->insert([
            'name' => 'prohibited_email_providers',
            'value' => '',
            'friendly_name' => 'Prohibited Email Providers',
            'description' => 'List of email providers not allowed to register, please enter one provider domain per line.',
            'validation' => 'nullable|string',
            'type' => 'plaintext'
        ]);

        DB::table('settings')->insert([
            'name' => 'mail_from_address',
            'value' => 'taslibrary@kcl.ac.uk',
            'friendly_name' => 'Mail From Address',
            'description' => 'Email address used to send emails from, and contact us messages to',
            'validation' => 'required|email|max:255',
            'type' => 'text'
        ]);
    }
}
