<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function events(): View
    {
        return view('pages.events');
    }

    public function menu(): View
    {
        return view('pages.menu');
    }

    public function book(): View
    {
        return view('pages.book');
    }

    public function search(Request $request): View
    {
        $query = Str::of($request->string('q'))->squish()->limit(80, '')->toString();

        return view('pages.search', [
            'query' => $query,
            'results' => $query === '' ? [] : $this->searchContent($query),
        ]);
    }

    /**
     * Every word of the query must appear in a result's text (case-insensitive).
     *
     * @return list<array{kind: string, title: string, text: string, url: string}>
     */
    private function searchContent(string $query): array
    {
        $words = array_filter(explode(' ', Str::lower($query)));

        return collect($this->searchableContent())
            ->filter(fn (array $item): bool => collect($words)->every(
                fn (string $word): bool => Str::contains(Str::lower($item['title'].' '.$item['text']), $word)
            ))
            ->values()
            ->all();
    }

    /**
     * Nights, features, menu items and FAQ answers, each with the page it lives on.
     *
     * @return list<array{kind: string, title: string, text: string, url: string}>
     */
    private function searchableContent(): array
    {
        $items = [];

        foreach (config('hfh.nights', []) as $night) {
            $items[] = ['kind' => 'Night', 'title' => $night['title'], 'text' => $night['when'].'. '.$night['blurb'], 'url' => route('events')];
        }

        foreach (config('hfh.features', []) as $feature) {
            $items[] = ['kind' => 'At the venue', 'title' => $feature['title'], 'text' => $feature['text'], 'url' => url($feature['link'])];
        }

        foreach (config('hfh.menu', []) as $group) {
            foreach ($group['items'] as $dish) {
                $items[] = ['kind' => $group['group'], 'title' => $dish['name'], 'text' => (string) ($dish['description'] ?? ''), 'url' => route('menu')];
            }
        }

        foreach (config('hfh.faq', []) as $faq) {
            $items[] = ['kind' => 'FAQ', 'title' => $faq['question'], 'text' => $faq['answer'], 'url' => route('events').'#faq-title'];
        }

        return $items;
    }
}
