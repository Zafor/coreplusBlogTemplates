<?php
    if (!$entries) {
        return;
    }

    foreach ($entries as $entry) {
        switch ($entry['acf_fc_layout']) {
            case 'media_banner':
                echo view('add-ons/media-banner', [
                    'isReverse'   => TrueLib::arrayGet($entry, 'is_reverse'),
                    'heading'     => TrueLib::arrayGet($entry, 'heading'),
                    'list'        => TrueLib::arrayGet($entry, 'list'),
                    'image'       => TrueLib::arrayGet($entry, 'image'),
                    'enableVideo' => TrueLib::arrayGet($entry, 'enable_video'),
                    'videoUrl'    => TrueLib::arrayGet($entry, 'video_url'),
                    'useWysiwyg'  => TrueLib::arrayGet($entry, 'use_wysiwyg'),
                    'wysiwyg'     => TrueLib::arrayGet($entry, 'wysiwyg'),
                ]);
                break;
            case 'text_with_logos':
                echo view('add-ons/text-with-logos-banner', [
                    'heading' => TrueLib::arrayGet($entry, 'heading'),
                    'content' => TrueLib::arrayGet($entry, 'content'),
                    'logos'   => TrueLib::arrayGet($entry, 'logos'),
                ]);
                break;
            case 'action_banner':
                echo view('add-ons/action-banner', [
                    'heading' => TrueLib::arrayGet($entry, 'heading'),
                    'actions' => TrueLib::arrayGet($entry, 'actions'),
                ]);
                break;
            default:
                break;
        }
    }
?>

