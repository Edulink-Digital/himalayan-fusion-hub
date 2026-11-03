<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'week' => $this->weekWithDates(),
            'doors' => $this->nextDoors(),
        ]);
    }

    public function events(): View
    {
        return view('pages.events', ['doors' => $this->nextDoors()]);
    }

    public function menu(): View
    {
        return view('pages.menu');
    }

    public function book(): View
    {
        return view('pages.book');
    }

    /**
     * The next time the doors open, in venue time. Today counts until the doors have opened.
     */
    private function nextDoors(): Carbon
    {
        $now = Carbon::now(config('hfh.timezone'));
        [$hour, $minute] = array_map('intval', explode(':', config('hfh.doors.time')));
        $doors = $now->copy()->next(config('hfh.doors.day'))->setTime($hour, $minute);
        $today = $now->copy()->setTime($hour, $minute);

        return $now->isFriday() && $now->lessThan($today) ? $today : $doors;
    }

    /**
     * The week config with the next calendar date for each day tab.
     *
     * @return array<int, array{key: string, tab: string, date: ?string, slots: array<int, array{string, string, string}>}>
     */
    private function weekWithDates(): array
    {
        $today = Carbon::today(config('hfh.timezone'));

        return array_map(function (array $day) use ($today): array {
            $date = null;

            if ($day['weekday'] !== null) {
                $date = $today->dayOfWeek === $day['weekday'] ? $today->copy() : $today->copy()->next($day['weekday']);
            }

            return [
                'key' => $day['key'],
                'tab' => $day['tab'],
                'date' => $date?->format('j M'),
                'slots' => $day['slots'],
            ];
        }, config('hfh.week'));
    }
}
