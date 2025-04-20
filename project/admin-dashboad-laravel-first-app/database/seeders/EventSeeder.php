<?php

namespace Database\Seeders;

use App\Enums\EventType;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'id' => 1,
                'type' => EventType::INFO,
                'title' => 'World Braille Day',
                'start' => Carbon::createFromDate(now()->year, 1, 4)->startOfDay()->toDateTimeString(),
                'all_day' => true,
            ],
            [
                'id' => 2,
                'type' => EventType::INFO,
                'title' => 'World Leprosy Day',
                'start' => Carbon::createFromDate(now()->year, 1, 30)->startOfDay()->toDateTimeString(),
                'all_day' => true,
            ],
            [
                'id' => 3,
                'type' => EventType::INFO,
                'title' => 'International Mother Language Day',
                'start' => Carbon::createFromDate(now()->year, 2, 21)->startOfDay()->toDateTimeString(),
                'all_day' => true,
            ],
            [
                'id' => 4,
                'type' => EventType::INFO,
                'title' => "International Women's Day",
                'start' => Carbon::createFromDate(now()->year, 3, 8)->startOfDay()->toDateTimeString(),
                'all_day' => true,
            ],
            [
                'id' => 5,
                'type' => EventType::INFO,
                'title' => 'World Thinking Day',
                'start' => Carbon::createFromDate(now()->year, 2, 22)->startOfDay()->toDateTimeString(),
                'all_day' => true,
            ],
            [
                'id' => 6,
                'type' => EventType::INFO,
                'title' => 'International Mother Language Day',
                'start' => Carbon::createFromDate(now()->year, 3, 21)->startOfDay()->toDateTimeString(),
                'all_day' => true,
            ],
            [
                'id' => 7,
                'type' => EventType::INFO,
                'title' => 'World Water Day',
                'start' => Carbon::createFromDate(now()->year, 3, 22)->startOfDay()->toDateTimeString(),
                'all_day' => true,
            ],
            [
                'id' => 8,
                'type' => EventType::INFO,
                'title' => 'World Health Day',
                'start' => Carbon::createFromDate(now()->year, 4, 7)->startOfDay()->toDateTimeString(),
                'all_day' => true,
            ],
            [
                'id' => 9,
                'type' => EventType::INFO,
                'title' => 'International Special Librarians Day',
                'start' => Carbon::createFromDate(now()->year, 4, 16)->startOfDay()->toDateTimeString(),
                'all_day' => true,
            ],
            [
                'id' => 10,
                'type' => EventType::INFO,
                'title' => 'Earth Day',
                'start' => Carbon::createFromDate(now()->year, 4, 22)->startOfDay()->toDateTimeString(),
                'all_day' => true,
            ],
            [
                'id' => 153,
                'type' => EventType::PRIMARY,
                'title' => 'All Day Event',
                'start' => Carbon::create(null, null, 1)->toDateTimeString(),
                'all_day' => true,
                'department' => 'All Day Event',
                'location' => 'San Francisco, US',
                'description' => 'An all-day event is an event that lasts an entire day or longer',
            ],
            [
                'id' => 136,
                'type' => EventType::WARNING,
                'title' => 'Visit Online Course',
                'start' => Carbon::now()->subDays(5)->toDateTimeString(),
                'end' => Carbon::now()->subDays(2)->toDateTimeString(),
                'all_day' => true,
                'department' => 'Long Event',
                'description' => 'Long Term Event means an incident that last longer than 12 hours.',
            ],
            [
                'id' => 999,
                'type' => EventType::DANGER,
                'title' => 'Client Meeting with Alexis',
                'start' => Carbon::now()->addDays(22)->setTime(20, 0)->toDateTimeString(),
                'end' => Carbon::now()->addDays(24)->setTime(16, 0)->toDateTimeString(),
                'all_day' => true,
                'department' => 'Meeting with Alexis',
                'location' => 'California, US',
                'description' => 'A meeting is a gathering of two or more people that has been convened for the purpose of achieving a common goal through verbal interaction, such as sharing information or reaching agreement.',
            ],
            [
                'id' => 991,
                'type' => EventType::PRIMARY,
                'title' => 'Repeating Event',
                'start' => Carbon::now()->addDays(4)->setTime(16, 0)->toDateTimeString(),
                'end' => Carbon::now()->addDays(9)->setTime(16, 0)->toDateTimeString(),
                'all_day' => true,
                'department' => 'Repeating Event',
                'location' => 'Las Vegas, US',
                'description' => 'A recurring or repeating event is simply any event that you will occur more than once on your calendar.',
            ],
            [
                'id' => 112,
                'type' => EventType::SUCCESS,
                'title' => 'Meeting With Designer',
                'start' => Carbon::now()->setTime(12, 30)->toDateTimeString(),
                'all_day' => true,
                'department' => 'Meeting',
                'location' => 'Head Office, US',
                'description' => 'Tell how to boost website traffic',
            ],
            [
                'id' => 113,
                'type' => EventType::DANGER,
                'title' => 'Weekly Strategy Planning',
                'start' => Carbon::now()->addDays(9)->toDateTimeString(),
                'end' => Carbon::now()->addDays(11)->toDateTimeString(),
                'all_day' => true,
                'department' => 'Lunch',
                'location' => 'Head Office, US',
                'description' => 'Strategies for Creating Your Weekly Schedule',
            ],
            [
                'id' => 875,
                'type' => EventType::SUCCESS,
                'title' => 'Birthday Party',
                'start' => Carbon::now()->addDays(1)->setTime(19, 0)->toDateTimeString(),
                'all_day' => true,
                'department' => 'Birthday Party',
                'location' => 'Los Angeles, US',
                'description' => 'Family slumber party – Bring out the blankets and pillows and have a family slumber party! Play silly party games, share special snacks and wind down the fun with a special movie.',
            ],
            [
                'id' => 783,
                'type' => EventType::INFO,
                'title' => 'Click for Google',
                'start' => Carbon::create(null, null, 28)->toDateTimeString(),
                'end' => Carbon::create(null, null, 29)->toDateTimeString(),
                'all_day' => true,
                'url' => 'http://google.com/',
            ],
            [
                'id' => 456,
                'type' => EventType::INFO,
                'title' => 'Project Discussion with Team',
                'start' => Carbon::now()->addDays(23)->setTime(20, 0)->toDateTimeString(),
                'end' => Carbon::now()->addDays(24)->setTime(16, 0)->toDateTimeString(),
                'all_day' => true,
                'department' => 'Discussion',
                'location' => 'Head Office, US',
                'description' => 'Tell how to boost website traffic',
            ],
        ];

        foreach ($events as $event) {
            Event::query()->create($event);
        }
    }
}
