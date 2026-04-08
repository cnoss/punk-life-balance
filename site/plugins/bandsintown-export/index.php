<?php

use Kirby\Cms\Page;
use Kirby\Http\Response;

Kirby::plugin('plb/bandsintown-export', [
    'options' => [
        // If null, falls back to site()->title()
        'artistName' => null,
        'pageRoot' => 'news',
        'onlyListed' => true,
        'includeBom' => true,
        'defaults' => [
            'country' => 'Germany',
            'region' => '',
            'timezone' => 'Europe/Berlin',
        ],
    ],
    'routes' => function () {
        return [
            [
                'pattern' => 'export/bandsintown.csv',
                'language' => '*',
                'action' => function () {
                    $rootSlug = option('plb.bandsintown-export.pageRoot', 'news');
                    $onlyListed = option('plb.bandsintown-export.onlyListed', true);

                    $root = page($rootSlug);
                    if (!$root) {
                        return new Response('Missing page: ' . $rootSlug, 'text/plain', 404);
                    }

                    $items = $root->children();
                    if ($onlyListed) {
                        $items = $items->listed();
                    }

                    $today = strtotime('today');

                    $items = $items->filter(function (Page $item) use ($today) {
                        $dateField = $item->date();
                        if ($dateField->isEmpty()) {
                            return false;
                        }

                        if ($dateField->toDate() < $today) {
                            return false;
                        }

                        // Explicit flag
                        if ($item->kind()->value() === 'termin') {
                            return true;
                        }

                        // If structured BIT fields exist, assume gig
                        $hasBitFields = $item->bitVenue()->isNotEmpty()
                            || $item->bitCity()->isNotEmpty()
                            || $item->bitStartTime()->isNotEmpty();
                        if ($hasBitFields) {
                            return true;
                        }

                        // Heuristic: look for typical gig markers in layout text
                        $layoutText = plbBitExtractTextFromLayout($item);
                        if ($layoutText === '') {
                            return false;
                        }

                        $markers = [
                            'einlass',
                            'beginn',
                            'start',
                            'uhr',
                        ];
                        $hasMarker = false;
                        foreach ($markers as $marker) {
                            if (stripos($layoutText, $marker) !== false) {
                                $hasMarker = true;
                                break;
                            }
                        }

                        $hasPostalCity = (bool)preg_match('/\b\d{5}\s+\p{L}+/u', $layoutText);
                        $hasTime = (bool)preg_match('/\b([01]?\d|2[0-3]):[0-5]\d\b/', $layoutText);

                        return $hasMarker && ($hasPostalCity || $hasTime);
                    });

                    $items = $items->sortBy(function (Page $item) {
                        return $item->date()->toDate();
                    }, 'asc', SORT_NUMERIC);

                    $header = [
                        'Artist Name',
                        'Venue*',
                        'Country*',
                        'Address',
                        'City*',
                        'Region*',
                        'Postal Code',
                        'Timezone*',
                        'Start Date* (yyyy-mm-dd)',
                        'Start Time* (HH:MM)',
                        'End Date',
                        'End Time',
                        'Streaming Link',
                        'Ticket Link',
                        'Ticket Type',
                        'Ticket Link 2',
                        'Ticket Type 2',
                        'On-Sale Date',
                        'On-Sale Time',
                        'Lineup',
                        'Event Name',
                        'Event Display Format',
                        'Description',
                        'Schedule Date',
                        'Schedule Time',
                        'Do Not Announce',
                        'Setlist',
                        'Event Image',
                    ];

                    $artistName = option('plb.bandsintown-export.artistName');
                    if (!$artistName) {
                        $artistName = site()->title()->value();
                    }

                    $defaults = option('plb.bandsintown-export.defaults', []);
                    $defaultCountry = $defaults['country'] ?? 'Germany';
                    $defaultRegion = $defaults['region'] ?? '';
                    $defaultTimezone = $defaults['timezone'] ?? 'Europe/Berlin';

                    $rows = [];

                    foreach ($items as $item) {
                        $structure = $item->bandsintownEvents()->toStructure();

                        if ($structure->count() > 0) {
                            foreach ($structure as $event) {
                                $rows[] = plbBitBuildRowFromFields([
                                    'artistName' => $artistName,
                                    'venue' => $event->venue()->or($item->bitVenue())->value(),
                                    'country' => $event->country()->or($item->bitCountry())->or($defaultCountry)->value(),
                                    'address' => $event->address()->or($item->bitAddress())->value(),
                                    'city' => $event->city()->or($item->bitCity())->value(),
                                    'region' => $event->region()->or($item->bitRegion())->or($defaultRegion)->value(),
                                    'postalCode' => $event->postalCode()->or($item->bitPostalCode())->value(),
                                    'timezone' => $event->timezone()->or($item->bitTimezone())->or($defaultTimezone)->value(),
                                    'startDate' => $event->startDate()->or($item->date())->value(),
                                    'startTime' => $event->startTime()->or($item->bitStartTime())->value(),
                                    'endDate' => $event->endDate()->value(),
                                    'endTime' => $event->endTime()->value(),
                                    'streamingLink' => $event->streamingLink()->or($item->bitStreamingLink())->value(),
                                    'ticketLink' => $event->ticketLink()->or($item->bitTicketLink())->value(),
                                    'ticketType' => $event->ticketType()->or($item->bitTicketType())->value(),
                                    'ticketLink2' => $event->ticketLink2()->or($item->bitTicketLink2())->value(),
                                    'ticketType2' => $event->ticketType2()->or($item->bitTicketType2())->value(),
                                    'onSaleDate' => $event->onSaleDate()->or($item->bitOnSaleDate())->value(),
                                    'onSaleTime' => $event->onSaleTime()->or($item->bitOnSaleTime())->value(),
                                    'lineup' => $event->lineup()->or($item->bitLineup())->value(),
                                    'eventName' => $event->eventName()->or($item->bitEventName())->or($item->title())->value(),
                                    'eventDisplayFormat' => $event->eventDisplayFormat()->or($item->bitEventDisplayFormat())->value(),
                                    'description' => $event->description()->or($item->bitDescription())->value(),
                                    'scheduleDate' => $event->scheduleDate()->or($item->bitScheduleDate())->value(),
                                    'scheduleTime' => $event->scheduleTime()->or($item->bitScheduleTime())->value(),
                                    'doNotAnnounce' => $event->doNotAnnounce()->or($item->bitDoNotAnnounce())->value(),
                                    'setlist' => $event->setlist()->or($item->bitSetlist())->value(),
                                    'eventImage' => $event->eventImage()->or($item->bitEventImage())->value(),
                                ]);
                            }

                            continue;
                        }

                        $fallback = plbBitFallbackFromLayout($item);

                        $rows[] = plbBitBuildRowFromFields([
                            'artistName' => $artistName,
                            'venue' => $item->bitVenue()->or($fallback['venue'] ?? '')->value(),
                            'country' => $item->bitCountry()->or($defaultCountry)->value(),
                            'address' => $item->bitAddress()->or($fallback['address'] ?? '')->value(),
                            'city' => $item->bitCity()->or($fallback['city'] ?? '')->value(),
                            'region' => $item->bitRegion()->or($defaultRegion)->value(),
                            'postalCode' => $item->bitPostalCode()->or($fallback['postalCode'] ?? '')->value(),
                            'timezone' => $item->bitTimezone()->or($defaultTimezone)->value(),
                            'startDate' => $item->date()->value(),
                            'startTime' => $item->bitStartTime()->or($fallback['startTime'] ?? '')->value(),
                            'endDate' => $item->bitEndDate()->value(),
                            'endTime' => $item->bitEndTime()->value(),
                            'streamingLink' => $item->bitStreamingLink()->value(),
                            'ticketLink' => $item->bitTicketLink()->value(),
                            'ticketType' => $item->bitTicketType()->value(),
                            'ticketLink2' => $item->bitTicketLink2()->value(),
                            'ticketType2' => $item->bitTicketType2()->value(),
                            'onSaleDate' => $item->bitOnSaleDate()->value(),
                            'onSaleTime' => $item->bitOnSaleTime()->value(),
                            'lineup' => $item->bitLineup()->value(),
                            'eventName' => $item->bitEventName()->or($item->title())->value(),
                            'eventDisplayFormat' => $item->bitEventDisplayFormat()->value(),
                            'description' => $item->bitDescription()->value(),
                            'scheduleDate' => $item->bitScheduleDate()->value(),
                            'scheduleTime' => $item->bitScheduleTime()->value(),
                            'doNotAnnounce' => $item->bitDoNotAnnounce()->value(),
                            'setlist' => $item->bitSetlist()->value(),
                            'eventImage' => $item->bitEventImage()->value(),
                        ]);
                    }

                    $fh = fopen('php://temp', 'r+');
                    fputcsv($fh, $header);
                    foreach ($rows as $row) {
                        fputcsv($fh, $row);
                    }
                    rewind($fh);
                    $csv = stream_get_contents($fh);
                    fclose($fh);

                    if (option('plb.bandsintown-export.includeBom', true)) {
                        $csv = "\xEF\xBB\xBF" . $csv;
                    }

                    $filename = 'bandsintown-upcoming-' . date('Y-m-d') . '.csv';

                    return new Response(
                        $csv,
                        'text/csv',
                        200,
                        [
                            'Content-Type' => 'text/csv; charset=utf-8',
                            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                        ]
                    );
                }
            ]
        ];
    },
]);

function plbBitBuildRowFromFields(array $fields): array
{
    $startDate = plbBitFormatDate($fields['startDate'] ?? '');
    $startTime = plbBitFormatTime($fields['startTime'] ?? '');

    // Bandsintown expects Y to mean true in some templates
    $doNotAnnounce = trim((string)($fields['doNotAnnounce'] ?? ''));
    if ($doNotAnnounce !== '' && strtolower($doNotAnnounce) !== 'y') {
        $doNotAnnounce = in_array(strtolower($doNotAnnounce), ['1', 'true', 'yes', 'ja'], true) ? 'Y' : '';
    }

    return [
        (string)($fields['artistName'] ?? ''),
        (string)($fields['venue'] ?? ''),
        (string)($fields['country'] ?? ''),
        (string)($fields['address'] ?? ''),
        (string)($fields['city'] ?? ''),
        (string)($fields['region'] ?? ''),
        (string)($fields['postalCode'] ?? ''),
        (string)($fields['timezone'] ?? ''),
        $startDate,
        $startTime,
        plbBitFormatDate($fields['endDate'] ?? ''),
        plbBitFormatTime($fields['endTime'] ?? ''),
        (string)($fields['streamingLink'] ?? ''),
        (string)($fields['ticketLink'] ?? ''),
        (string)($fields['ticketType'] ?? ''),
        (string)($fields['ticketLink2'] ?? ''),
        (string)($fields['ticketType2'] ?? ''),
        plbBitFormatDate($fields['onSaleDate'] ?? ''),
        plbBitFormatTime($fields['onSaleTime'] ?? ''),
        (string)($fields['lineup'] ?? ''),
        (string)($fields['eventName'] ?? ''),
        (string)($fields['eventDisplayFormat'] ?? ''),
        plbBitNormalizeOneLine((string)($fields['description'] ?? '')),
        plbBitFormatDate($fields['scheduleDate'] ?? ''),
        plbBitFormatTime($fields['scheduleTime'] ?? ''),
        $doNotAnnounce,
        (string)($fields['setlist'] ?? ''),
        (string)($fields['eventImage'] ?? ''),
    ];
}

function plbBitFormatDate($value): string
{
    $value = trim((string)$value);
    if ($value === '') {
        return '';
    }

    // Already in ISO format
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
        return $value;
    }

    $timestamp = strtotime($value);
    if ($timestamp === false) {
        return '';
    }

    return date('Y-m-d', $timestamp);
}

function plbBitFormatTime($value): string
{
    $value = trim((string)$value);
    if ($value === '') {
        return '';
    }

    if (preg_match('/^([01]?\d|2[0-3]):[0-5]\d$/', $value, $m)) {
        $parts = explode(':', $m[0]);
        return str_pad($parts[0], 2, '0', STR_PAD_LEFT) . ':' . $parts[1];
    }

    $timestamp = strtotime($value);
    if ($timestamp === false) {
        return '';
    }

    return date('H:i', $timestamp);
}

function plbBitNormalizeOneLine(string $value): string
{
    $value = str_replace(["\r\n", "\r", "\n"], ' ', $value);
    $value = preg_replace('/\s+/', ' ', $value);
    return trim((string)$value);
}

function plbBitExtractTextFromLayout(Page $page): string
{
    $layoutField = $page->layout();
    if (!$layoutField || $layoutField->isEmpty()) {
        return '';
    }

    $json = $layoutField->value();
    if (!is_string($json) || trim($json) === '') {
        return '';
    }

    $decoded = json_decode($json, true);
    if (!is_array($decoded)) {
        return '';
    }

    $texts = [];

    $walk = function ($node) use (&$walk, &$texts) {
        if (is_array($node)) {
            foreach ($node as $key => $value) {
                if ($key === 'text' && is_string($value) && trim($value) !== '') {
                    $texts[] = $value;
                } else {
                    $walk($value);
                }
            }
        }
    };

    $walk($decoded);

    if (count($texts) === 0) {
        return '';
    }

    $combined = implode("\n", $texts);
    $combined = html_entity_decode($combined, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $combined = strip_tags($combined);
    $combined = str_replace(["\r\n", "\r"], "\n", $combined);

    return trim($combined);
}

function plbBitFallbackFromLayout(Page $page): array
{
    $text = plbBitExtractTextFromLayout($page);
    if ($text === '') {
        return [];
    }

    $lines = array_values(array_filter(array_map(function ($line) {
        return trim($line);
    }, preg_split('/\n+/', $text))));

    // Postal code + city
    $postalCode = '';
    $city = '';
    $postalIdx = null;

    foreach ($lines as $i => $line) {
        if (preg_match('/\b(\d{5})\s+([^,]+)\b/u', $line, $m)) {
            $postalCode = $m[1];
            $city = trim($m[2]);
            $postalIdx = $i;
            break;
        }
        if (preg_match('/\b(\d{5})\s+(.+)$/u', $line, $m)) {
            $postalCode = $m[1];
            $city = trim($m[2]);
            $postalIdx = $i;
            break;
        }
        if (preg_match('/\b(\d{5})\b/u', $line, $m)) {
            $postalCode = $m[1];
            $postalIdx = $i;
        }
    }

    // Start time
    $startTime = '';
    if (preg_match('/Beginn\s*[:\-]?\s*([01]?\d|2[0-3]):[0-5]\d/i', $text, $m)) {
        $startTime = $m[1];
    } elseif (preg_match('/Start\s*[:\-]?\s*(?:ab\s*)?(([01]?\d|2[0-3]):[0-5]\d)/i', $text, $m)) {
        $startTime = $m[1];
    } elseif (preg_match('/\b([01]?\d|2[0-3]):[0-5]\d\b/', $text, $m)) {
        $startTime = $m[0];
    }

    // Address + venue heuristic
    $venue = '';
    $address = '';

    if ($postalIdx !== null) {
        // If address is combined with postal+city ("Uhlstraße 72, 50321 Brühl")
        if (isset($lines[$postalIdx])) {
            $line = $lines[$postalIdx];
            if (preg_match('/^(.+?),\s*(\d{5})\s+(.+)$/u', $line, $m)) {
                $address = trim($m[1]);
                $postalCode = $m[2];
                $city = trim($m[3]);

                if ($postalIdx >= 1) {
                    $venueCandidate = $lines[$postalIdx - 1] ?? '';
                    if ($venueCandidate !== '' && !preg_match('/\b\d{5}\b/', $venueCandidate)) {
                        $venue = $venueCandidate;
                    }
                }
            }
        }

        // "Venue", "Street", "Postal City" pattern
        if ($address === '' && $postalIdx >= 1) {
            $addressCandidate = $lines[$postalIdx - 1] ?? '';
            if ($addressCandidate !== '' && !preg_match('/\b\d{5}\b/', $addressCandidate)) {
                $address = $addressCandidate;
            }
        }
        if ($venue === '' && $postalIdx >= 2) {
            $venueCandidate = $lines[$postalIdx - 2] ?? '';
            if ($venueCandidate !== '' && !preg_match('/\b\d{5}\b/', $venueCandidate)) {
                $venue = $venueCandidate;
            }
        }

        // Sometimes venue+address+city are on the same line
        if ($venue === '' && $postalIdx >= 1) {
            $venue = $lines[$postalIdx - 1] ?? '';
        }
    }

    // Cleanup
    $venue = trim($venue);
    $address = trim($address);

    return array_filter([
        'venue' => $venue,
        'address' => $address,
        'postalCode' => $postalCode,
        'city' => $city,
        'startTime' => $startTime,
    ], function ($v) {
        return trim((string)$v) !== '';
    });
}
