<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CallActivitySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'call_activity_id' => 1,
                'source_type' => 1,
                'source_id' => 1,
                'source' => '123',
                'destination_type' => 2,
                'destination_id' => 2,
                'destination' => '388',
                'company_id' => 1,
                'company_phoneline_id' => null,
                'phoneline' => null,
                'comment' => '',
                'date_start' => '2020-03-01 12:00:00',
                'date_end' => null,
                'duration' => null,
                'duration_live' => null,
                'record' => null,
                'unique_id' => null,
                'disposition' => null,
                'status_dial' => 1,
            ]
        ];
        foreach($data as $item) {
            DB::table('calls_activity')->insert([
                'call_activity_id' => $item['call_activity_id'],
                'source_type' => $item['source_type'],
                'source_id' => $item['source_id'],
                'source' => $item['source'],
                'destination_type' => $item['destination_type'],
                'destination_id' => $item['destination_id'],
                'destination' => $item['destination'],
                'company_id' => $item['company_id'],
                'company_phoneline_id' => $item['company_phoneline_id'],
                'phoneline' => $item['phoneline'],
                'comment' => $item['comment'],
                'date_start' => $item['date_start'],
                'date_end' => $item['date_end'],
                'duration' => $item['duration'],
                'duration_live' => $item['duration_live'],
                'record' => $item['record'],
                'unique_id' => $item['unique_id'],
                'disposition' => $item['disposition'],
                'status_dial' => $item['status_dial'],
            ]);
        }
    }
}
