<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

/**
 * Every editable text, list and setting of the public website on one tabbed form.
 *
 * @property-read Schema $form
 */
class SiteContent extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPencilSquare;

    protected static ?string $navigationLabel = 'Site content';

    protected static ?string $title = 'Site content';

    protected static ?int $navigationSort = 1;

    /**
     * Icons available to the venue feature cards (see resources/views/partials/icon.blade.php).
     *
     * @var array<string, string>
     */
    private const FEATURE_ICONS = [
        'microphone-stage' => 'Microphone',
        'snooker' => 'Snooker rack',
        'martini' => 'Cocktail glass',
        'vinyl-record' => 'Vinyl record',
        'confetti' => 'Confetti',
        'calendar-check' => 'Calendar with tick',
        'calendar-blank' => 'Calendar',
        'disc' => 'Disc',
        'ticket' => 'Ticket',
        'phone' => 'Phone',
        'map-pin' => 'Map pin',
    ];

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(collect(SiteSetting::EDITABLE_KEYS)
            ->mapWithKeys(fn (string $key): array => [$key => config("hfh.{$key}")])
            ->all());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Content')
                    ->persistTabInQueryString()
                    ->tabs([
                        $this->generalTab(),
                        $this->homeTab(),
                        $this->featuresTab(),
                        $this->nightsTab(),
                        $this->menuTab(),
                        $this->faqTab(),
                        $this->otherPagesTab(),
                        $this->seoTab(),
                    ]),
            ])
            ->statePath('data');
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([EmbeddedSchema::make('form')])
                    ->id('form')
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Save changes')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ])->sticky(),
                    ]),
            ]);
    }

    public function save(): void
    {
        SiteSetting::saveContent($this->form->getState());

        Notification::make()
            ->success()
            ->title('Saved. The website now shows your changes.')
            ->send();
    }

    private function generalTab(): Tab
    {
        return Tab::make('General & theme')
            ->icon(Heroicon::OutlinedSwatch)
            ->schema([
                Section::make('Colour theme')
                    ->description('Changes the colours of the whole public website.')
                    ->schema([
                        Radio::make('theme')
                            ->hiddenLabel()
                            ->options(config('hfh.themes'))
                            ->required(),
                    ]),
                Section::make('Venue and contact')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')->label('Venue name')->required()->maxLength(80),
                        TextInput::make('tagline')->maxLength(200),
                        TextInput::make('phone')
                            ->helperText('Also used for the call buttons and WhatsApp.')
                            ->tel()
                            ->required()
                            ->maxLength(30),
                        TextInput::make('email')
                            ->helperText('Shown as the floating email button. Leave empty to hide it.')
                            ->email()
                            ->maxLength(190),
                        TextInput::make('address')
                            ->helperText('Street, then a comma, then suburb. The map links follow this address.')
                            ->required()
                            ->maxLength(190)
                            ->columnSpanFull(),
                        TextInput::make('price_range')->label('Typical spend')->maxLength(80),
                    ]),
                Section::make('Opening hours')
                    ->schema([
                        Repeater::make('hours')
                            ->hiddenLabel()
                            ->columns(3)
                            ->itemLabel(fn (array $state): ?string => $state['day'] ?? null)
                            ->addActionLabel('Add a day')
                            ->schema([
                                TextInput::make('day')->required()->maxLength(40),
                                TextInput::make('time')->required()->maxLength(80),
                                Toggle::make('live')->label('Highlight')->inline(false),
                            ]),
                    ]),
            ]);
    }

    private function homeTab(): Tab
    {
        return Tab::make('Home page')
            ->icon(Heroicon::OutlinedHome)
            ->schema([
                Section::make('Hero')
                    ->columns(2)
                    ->schema([
                        TextInput::make('home.hero_kicker')->label('Small line above the heading')->maxLength(80),
                        TextInput::make('home.hero_title')->label('Heading')->required()->maxLength(80),
                        Textarea::make('home.hero_lead')->label('Intro text')->rows(3)->columnSpanFull(),
                        TextInput::make('home.hero_cta')->label('Main button')->maxLength(40),
                        TextInput::make('home.hero_cta_secondary')->label('Second button')->maxLength(40),
                    ]),
                Section::make('About')
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        TextInput::make('home.about_ghost')->label('Faded background word')->maxLength(30),
                        TextInput::make('home.about_title')->label('Heading')->maxLength(80),
                        Textarea::make('home.about_text')->label('Text')->rows(4)->columnSpanFull(),
                        Repeater::make('home.about_cards')
                            ->label('Small cards')
                            ->columns(2)
                            ->columnSpanFull()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->schema([
                                TextInput::make('title')->required()->maxLength(40),
                                TextInput::make('text')->required()->maxLength(160),
                            ]),
                        TextInput::make('home.about_cta')->label('Button')->maxLength(40),
                    ]),
                Section::make('Weekly event banner')
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        TextInput::make('home.ticket_label')->label('Small line')->maxLength(40),
                        TextInput::make('home.ticket_title')->label('Heading')->maxLength(80),
                        Textarea::make('home.ticket_text')->label('Text')->rows(2)->columnSpanFull(),
                        TextInput::make('home.ticket_day')->label('Day')->maxLength(40),
                        TextInput::make('home.ticket_doors')->label('Doors')->maxLength(40),
                        TextInput::make('home.ticket_cta')->label('Button')->maxLength(40),
                    ]),
                $this->sectionHeading('Services intro', 'services'),
                $this->sectionHeading('Gallery intro', 'gallery'),
                $this->sectionHeading('Events intro', 'events', withButton: true),
                $this->sectionHeading('Booking intro', 'booking'),
                Section::make('Call-to-action and contact')
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        TextInput::make('home.booking_mobile_cta')->label('Booking button on phones')->maxLength(40),
                        TextInput::make('home.callout_title')->label('"Talk to the team" heading')->maxLength(80),
                        TextInput::make('home.contact_ghost')->label('Contact faded word')->maxLength(30),
                        TextInput::make('home.contact_title')->label('Contact heading')->maxLength(80),
                        TextInput::make('home.contact_address_label')->label('Address card title')->maxLength(40),
                        TextInput::make('home.contact_call_label')->label('Phone card title')->maxLength(40),
                        TextInput::make('home.contact_hours_label')->label('Hours card title')->maxLength(40),
                    ]),
            ]);
    }

    private function sectionHeading(string $label, string $prefix, bool $withButton = false): Section
    {
        $fields = [
            TextInput::make("home.{$prefix}_ghost")->label('Faded background word')->maxLength(30),
            TextInput::make("home.{$prefix}_title")->label('Heading')->maxLength(80),
            Textarea::make("home.{$prefix}_text")->label('Text')->rows(2)->columnSpanFull(),
        ];

        if ($withButton) {
            $fields[] = TextInput::make("home.{$prefix}_cta")->label('Button')->maxLength(40);
        }

        return Section::make($label)->columns(2)->collapsible()->collapsed()->schema($fields);
    }

    private function featuresTab(): Tab
    {
        return Tab::make('Features')
            ->icon(Heroicon::OutlinedSparkles)
            ->schema([
                Repeater::make('features')
                    ->label('Venue feature cards (home page)')
                    ->columns(2)
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                    ->addActionLabel('Add a feature')
                    ->schema([
                        TextInput::make('title')->required()->maxLength(40),
                        Select::make('icon')->options(self::FEATURE_ICONS)->required(),
                        Textarea::make('text')->required()->rows(2)->maxLength(240)->columnSpanFull(),
                        TextInput::make('cta')->label('Link text')->required()->maxLength(40),
                        TextInput::make('link')
                            ->helperText('A page on this site, e.g. /menu or /book?type=karaoke')
                            ->required()
                            ->maxLength(120),
                    ]),
            ]);
    }

    private function nightsTab(): Tab
    {
        return Tab::make('Nights')
            ->icon(Heroicon::OutlinedMoon)
            ->schema([
                Repeater::make('nights')
                    ->label('Event nights (home and events pages)')
                    ->columns(2)
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                    ->addActionLabel('Add a night')
                    ->schema([
                        TextInput::make('title')->required()->maxLength(60),
                        TextInput::make('when')->required()->maxLength(80),
                        Textarea::make('blurb')->required()->rows(2)->maxLength(300)->columnSpanFull(),
                        Select::make('book')
                            ->label('Booking button pre-selects')
                            ->options(config('hfh.booking_types'))
                            ->required(),
                        Toggle::make('count')->label('Show countdown to Friday doors')->inline(false),
                    ]),
            ]);
    }

    private function menuTab(): Tab
    {
        return Tab::make('Menu')
            ->icon(Heroicon::OutlinedBookOpen)
            ->schema([
                Repeater::make('menu')
                    ->label('Menu sections')
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['group'] ?? null)
                    ->addActionLabel('Add a menu section')
                    ->schema([
                        TextInput::make('group')->label('Section name')->required()->maxLength(60),
                        TextInput::make('note')->label('Short note')->maxLength(120),
                        Repeater::make('items')
                            ->label('Drinks and dishes')
                            ->columns(3)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->addActionLabel('Add an item')
                            ->schema([
                                TextInput::make('name')->required()->maxLength(60),
                                TextInput::make('description')->maxLength(160),
                                Toggle::make('house_pick')->label('House pick')->inline(false),
                            ]),
                    ]),
            ]);
    }

    private function faqTab(): Tab
    {
        return Tab::make('FAQ')
            ->icon(Heroicon::OutlinedQuestionMarkCircle)
            ->schema([
                Repeater::make('faq')
                    ->label('Questions on the events page')
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['question'] ?? null)
                    ->addActionLabel('Add a question')
                    ->schema([
                        TextInput::make('question')->required()->maxLength(120),
                        Textarea::make('answer')->required()->rows(2)->maxLength(400),
                    ]),
            ]);
    }

    private function otherPagesTab(): Tab
    {
        return Tab::make('Other pages')
            ->icon(Heroicon::OutlinedDocumentDuplicate)
            ->schema([
                Section::make('Events page')
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        TextInput::make('events_page.title')->label('Heading')->maxLength(80),
                        TextInput::make('events_page.text')->label('Intro text')->maxLength(200),
                        TextInput::make('events_page.faq_ghost')->label('FAQ faded word')->maxLength(30),
                        TextInput::make('events_page.faq_title')->label('FAQ heading')->maxLength(80),
                        TextInput::make('events_page.meta_title')->label('Browser tab title')->maxLength(120),
                        Textarea::make('events_page.meta_description')->label('Search description')->rows(2)->maxLength(300),
                    ]),
                Section::make('Menu page')
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        TextInput::make('menu_page.title')->label('Heading')->maxLength(80),
                        TextInput::make('menu_page.text')->label('Intro text')->maxLength(200),
                        TextInput::make('menu_page.cta')->label('Button')->maxLength(40),
                        TextInput::make('menu_page.meta_title')->label('Browser tab title')->maxLength(120),
                        Textarea::make('menu_page.meta_description')->label('Search description')->rows(2)->maxLength(300)->columnSpanFull(),
                    ]),
                Section::make('Booking page and form')
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        TextInput::make('book_page.title')->label('Heading')->maxLength(80),
                        TextInput::make('book_page.text')->label('Intro text')->helperText('"Prefer to talk now? Ring" and the phone number are added after it.')->maxLength(200),
                        TextInput::make('book_page.side_title')->label('Side card heading')->maxLength(60),
                        TextInput::make('book_page.form_submit')->label('Send button')->maxLength(40),
                        TextInput::make('book_page.form_hint')->label('Note under the message box')->maxLength(160),
                        TextInput::make('book_page.form_success')->label('Message after sending')->maxLength(160),
                        TextInput::make('book_page.meta_title')->label('Browser tab title')->maxLength(120),
                        Textarea::make('book_page.meta_description')->label('Search description')->rows(2)->maxLength(300),
                    ]),
            ]);
    }

    private function seoTab(): Tab
    {
        return Tab::make('SEO & footer')
            ->icon(Heroicon::OutlinedMagnifyingGlass)
            ->schema([
                Section::make('Home page in search results and link previews')
                    ->schema([
                        TextInput::make('seo.title')->label('Browser tab title')->maxLength(120),
                        Textarea::make('seo.description')->label('Search description')->rows(2)->maxLength(300),
                        Textarea::make('seo.share_description')->label('Link preview description')->rows(2)->maxLength(300),
                    ]),
                Section::make('Footer')
                    ->schema([
                        TextInput::make('footer.note')->label('Footer note')->maxLength(200),
                    ]),
            ]);
    }
}
