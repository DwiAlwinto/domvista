<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Logbook;
use App\Models\LogbookEntry;
use Carbon\Carbon;

class CarryOverEntries extends Command
{
    protected $signature = 'logbook:carry-over';
    protected $description = 'Automatically carry over unfinished logbook entries to the new day';

    public function handle()
    {
        $today = Carbon::today();

        // Check if today's logbook already exists
        if (Logbook::whereDate('logbook_date', $today)->exists()) {
            $this->info('Logbook for today already exists. No action needed.');
            return;
        }

        // Find all unfinished entries from all previous dates
        $unfinishedEntries = LogbookEntry::where('status', 'On Progress')
            ->whereDate('created_at', '<', $today)
            ->with('logbook')
            ->get();

        // Create new logbook for today
        $newLogbook = Logbook::create([
            'logbook_date' => $today,
            'logbook_number' => 'LB-' . $today->format('Ymd'),
            'status' => $unfinishedEntries->isEmpty() ? 'Draft' : 'On Progress'
        ]);

        $this->info('New logbook created for ' . $today->format('Y-m-d'));

        // Process carry-over if there are unfinished entries
        if ($unfinishedEntries->isNotEmpty()) {
            $carriedCount = 0;

            foreach ($unfinishedEntries as $entry) {
                $newEntry = $entry->replicate();
                $newEntry->fill([
                    'carried_from' => $entry->id,
                    'original_date' => $entry->original_date ?? $entry->created_at->toDateString(),
                    'is_carried_over' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                    
                ]);
                $newLogbook->entries()->save($newEntry);
                $carriedCount++;
            }

            $this->info("Successfully carried over {$carriedCount} unfinished entries from previous dates.");
        } else {
            $this->info('No unfinished entries to carry over.');
        }
    }
}
