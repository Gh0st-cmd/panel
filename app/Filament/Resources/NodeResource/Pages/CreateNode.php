<?php

namespace App\Filament\Resources\NodeResource\Pages;

use App\Filament\Resources\NodeResource;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\HtmlString;

class CreateNode extends CreateRecord
{
    protected static string $resource = NodeResource::class;

    protected static bool $canCreateAnother = false;

    protected ?string $subheading = 'which is a machine that runs your Servers';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Tabs::make('Tabs')
                ->columns([
                    'default' => 2,
                    'sm' => 3,
                    'md' => 3,
                    'lg' => 4,
                ])
                ->persistTabInQueryString()
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Basic Settings')
                        ->icon('tabler-server')
                        ->schema([
                            Forms\Components\TextInput::make('fqdn')
                                ->columnSpan(2)
                                ->required()
                                ->autofocus()
                                ->live(debounce: 1500)
                                ->rule('prohibited', fn ($state) => is_ip($state) && request()->isSecure())
                                ->label(fn ($state) => is_ip($state) ? 'IP Address' : 'Domain Name')
                                ->placeholder(fn ($state) => is_ip($state) ? '192.168.1.1' : 'node.example.com')
                                ->helperText(function ($state) {
                                    if (is_ip($state)) {
                                        if (request()->isSecure()) {
                                            return '
                                    Your panel is currently secured via an SSL certificate and that means your nodes require one too.
                                    You must use a domain name, because you cannot get SSL certificates for IP Addresses
                                ';
                                        }

                                        return '';
                                    }

                                    return "
                            This is the domain name that points to your node's IP Address.
                            If you've already set up this, you can verify it by checking the next field!
                        ";
                                })
                                ->hintColor('danger')
                                ->hint(function ($state) {
                                    if (is_ip($state) && request()->isSecure()) {
                                        return 'You cannot connect to an IP Address over SSL';
                                    }

                                    return '';
                                })
                                ->afterStateUpdated(function (Forms\Set $set, ?string $state) {
                                    $set('dns', null);
                                    $set('ip', null);

                                    [$subdomain] = str($state)->explode('.', 2);
                                    if (!is_numeric($subdomain)) {
                                        $set('name', $subdomain);
                                    }

                                    if (!$state || is_ip($state)) {
                                        $set('dns', null);

                                        return;
                                    }

                                    $validRecords = gethostbynamel($state);
                                    if ($validRecords) {
                                        $set('dns', true);

                                        $set('ip', collect($validRecords)->first());

                                        return;
                                    }

                                    $set('dns', false);
                                })
                                ->maxLength(191),

                            Forms\Components\TextInput::make('ip')
                                ->disabled()
                                ->hidden(),

                            Forms\Components\ToggleButtons::make('dns')
                                ->label('DNS Record Check')
                                ->helperText('This lets you know if your DNS record correctly points to an IP Address.')
                                ->disabled()
                                ->inline()
                                ->default(null)
                                ->hint(fn (Forms\Get $get) => $get('ip'))
                                ->hintColor('success')
                                ->options([
                                    true => 'Valid',
                                    false => 'Invalid',
                                ])
                                ->colors([
                                    true => 'success',
                                    false => 'danger',
                                ])
                                ->columnSpan([
                                    'default' => 1,
                                    'sm' => 1,
                                    'md' => 1,
                                    'lg' => 1,
                                ]),

                            Forms\Components\TextInput::make('daemon_listen')
                                ->columnSpan([
                                    'default' => 1,
                                    'sm' => 1,
                                    'md' => 1,
                                    'lg' => 1,
                                ])
                                ->label(trans('strings.port'))
                                ->helperText('If you are running the daemon behind Cloudflare you should set the daemon port to 8443 to allow websocket proxying over SSL.')
                                ->minValue(0)
                                ->maxValue(65536)
                                ->default(8080)
                                ->required()
                                ->integer(),

                            Forms\Components\TextInput::make('name')
                                ->label('Display Name')
                                ->columnSpan([
                                    'default' => 1,
                                    'sm' => 1,
                                    'md' => 1,
                                    'lg' => 2,
                                ])
                                ->required()
                                ->regex('/[a-zA-Z0-9_\.\- ]+/')
                                ->helperText('This name is for display only and can be changed later.')
                                ->maxLength(100),

                            Forms\Components\ToggleButtons::make('scheme')
                                ->label('Communicate over SSL')
                                ->columnSpan([
                                    'default' => 1,
                                    'sm' => 1,
                                    'md' => 1,
                                    'lg' => 1,
                                ])
                                ->required()
                                ->inline()
                                ->helperText(function (Forms\Get $get) {
                                    if (request()->isSecure()) {
                                        return new HtmlString('Your Panel is using a secure SSL connection,<br>so your Daemon must too.');
                                    }

                                    if (is_ip($get('fqdn'))) {
                                        return 'An IP address cannot use SSL.';
                                    }

                                    return '';
                                })
                                ->disableOptionWhen(fn (string $value): bool => $value === 'http' && request()->isSecure())
                                ->options([
                                    'http' => 'HTTP',
                                    'https' => 'HTTPS (SSL)',
                                ])
                                ->colors([
                                    'http' => 'warning',
                                    'https' => 'success',
                                ])
                                ->icons([
                                    'http' => 'tabler-lock-open-off',
                                    'https' => 'tabler-lock',
                                ])
                                ->default(fn () => request()->isSecure() ? 'https' : 'http'),
                        ]),
                    Tabs\Tab::make('Advanced Settings')
                        ->icon('tabler-server-cog')
                        ->schema([
                            Forms\Components\TextInput::make('upload_size')
                                ->label('Upload Limit')
                                ->helperText('Enter the maximum size of files that can be uploaded through the web-based file manager.')
                                ->columnSpan(1)
                                ->numeric()->required()
                                ->default(256)
                                ->minValue(1)
                                ->maxValue(1024)
                                ->suffix('MiB'),
                            Forms\Components\ToggleButtons::make('public')
                                ->label('Automatic Allocation')->inline()
                                ->default(true)
                                ->columnSpan(1)
                                ->options([
                                    true => 'Yes',
                                    false => 'No',
                                ])
                                ->colors([
                                    true => 'success',
                                    false => 'danger',
                                ]),
                            Forms\Components\ToggleButtons::make('maintenance_mode')
                                ->label('Maintenance Mode')->inline()
                                ->columnSpan(1)
                                ->default(false)
                                ->hinticon('tabler-question-mark')
                                ->hintIconTooltip("If the node is marked 'Under Maintenance' users won't be able to access servers that are on this node.")
                                ->options([
                                    true => 'Enable',
                                    false => 'Disable',
                                ])
                                ->colors([
                                    true => 'danger',
                                    false => 'success',
                                ]),
                            Forms\Components\TagsInput::make('tags')
                                ->label('Tags')
                                ->disabled()
                                ->placeholder('Not Implemented')
                                ->hintIcon('tabler-question-mark')
                                ->hintIconTooltip('Not Implemented')
                                ->columnSpan(1),
                            Forms\Components\Grid::make()
                                ->columns(6)
                                ->columnSpanFull()
                                ->schema([
                                    Forms\Components\ToggleButtons::make('unlimited_mem')
                                        ->label('Memory')->inlineLabel()->inline()
                                        ->afterStateUpdated(fn (Forms\Set $set) => $set('memory', 0))
                                        ->afterStateUpdated(fn (Forms\Set $set) => $set('memory_overallocate', 0))
                                        ->formatStateUsing(fn (Forms\Get $get) => $get('memory') == 0)
                                        ->live()
                                        ->options([
                                            true => 'Unlimited',
                                            false => 'Limited',
                                        ])
                                        ->colors([
                                            true => 'primary',
                                            false => 'warning',
                                        ])
                                        ->columnSpan(2),
                                    Forms\Components\TextInput::make('memory')
                                        ->dehydratedWhenHidden()
                                        ->hidden(fn (Forms\Get $get) => $get('unlimited_mem'))
                                        ->label('Memory Limit')->inlineLabel()
                                        ->suffix('MiB')
                                        ->columnSpan(2)
                                        ->numeric()
                                        ->minValue(0)
                                        ->default(0),
                                    Forms\Components\TextInput::make('memory_overallocate')
                                        ->dehydratedWhenHidden()
                                        ->label('Overallocate')->inlineLabel()
                                        ->hidden(fn (Forms\Get $get) => $get('unlimited_mem'))
                                        ->hintIcon('tabler-question-mark')
                                        ->hintIconTooltip('The % allowable to go over the set limit.')
                                        ->columnSpan(2)
                                        ->numeric()
                                        ->minValue(-1)
                                        ->maxValue(100)
                                        ->default(0)
                                        ->suffix('%'),
                                ]),
                            Forms\Components\Grid::make()
                                ->columns(6)
                                ->columnSpanFull()
                                ->schema([
                                    Forms\Components\ToggleButtons::make('unlimited_disk')
                                        ->label('Disk')->inlineLabel()->inline()
                                        ->live()
                                        ->afterStateUpdated(fn (Forms\Set $set) => $set('disk', 0))
                                        ->afterStateUpdated(fn (Forms\Set $set) => $set('disk_overallocate', 0))
                                        ->formatStateUsing(fn (Forms\Get $get) => $get('disk') == 0)
                                        ->options([
                                            true => 'Unlimited',
                                            false => 'Limited',
                                        ])
                                        ->colors([
                                            true => 'primary',
                                            false => 'warning',
                                        ])
                                        ->columnSpan(2),
                                    Forms\Components\TextInput::make('disk')
                                        ->dehydratedWhenHidden()
                                        ->hidden(fn (Forms\Get $get) => $get('unlimited_disk'))
                                        ->label('Disk Limit')->inlineLabel()
                                        ->suffix('MiB')
                                        ->columnSpan(2)
                                        ->numeric()
                                        ->minValue(0)
                                        ->default(0),
                                    Forms\Components\TextInput::make('disk_overallocate')
                                        ->dehydratedWhenHidden()
                                        ->hidden(fn (Forms\Get $get) => $get('unlimited_disk'))
                                        ->label('Overallocate')->inlineLabel()
                                        ->hintIcon('tabler-question-mark')
                                        ->hintIconTooltip('The % allowable to go over the set limit.')
                                        ->columnSpan(2)
                                        ->numeric()
                                        ->minValue(-1)
                                        ->maxValue(100)
                                        ->default(0)
                                        ->suffix('%'),
                                ]),
                            Forms\Components\Grid::make()
                                ->columns(6)
                                ->columnSpanFull()
                                ->schema([
                                    Forms\Components\ToggleButtons::make('unlimited_cpu')
                                        ->label('CPU')->inlineLabel()->inline()
                                        ->live()
                                        ->afterStateUpdated(fn (Forms\Set $set) => $set('cpu', 0))
                                        ->afterStateUpdated(fn (Forms\Set $set) => $set('cpu_overallocate', 0))
                                        ->formatStateUsing(fn (Forms\Get $get) => $get('cpu') == 0)
                                        ->options([
                                            true => 'Unlimited',
                                            false => 'Limited',
                                        ])
                                        ->colors([
                                            true => 'primary',
                                            false => 'warning',
                                        ])
                                        ->default(0)
                                        ->columnSpan(2),
                                    Forms\Components\TextInput::make('cpu')
                                        ->dehydratedWhenHidden()
                                        ->hidden(fn (Forms\Get $get) => $get('unlimited_cpu'))
                                        ->label('CPU Limit')->inlineLabel()
                                        ->suffix('%')
                                        ->columnSpan(2)
                                        ->numeric()
                                        ->minValue(0),
                                    Forms\Components\TextInput::make('cpu_overallocate')
                                        ->dehydratedWhenHidden()
                                        ->hidden(fn (Forms\Get $get) => $get('unlimited_cpu'))
                                        ->label('Overallocate')->inlineLabel()
                                        ->hintIcon('tabler-question-mark')
                                        ->hintIconTooltip('The % allowable to go over the set limit.')
                                        ->columnSpan(2)
                                        ->numeric()
                                        ->default(0)
                                        ->minValue(-1)
                                        ->maxValue(100)
                                        ->suffix('%'),
                                ]),
                        ]),
                ]),
        ]);
    }

    protected function getRedirectUrlParameters(): array
    {
        return [
            'tab' => '-configuration-tab',
        ];
    }
}
