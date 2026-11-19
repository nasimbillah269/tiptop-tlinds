<?php

namespace App\Support;

use Symfony\Component\Mime\MimeTypeGuesserInterface;

/**
 * Fallback MIME guesser for servers where the php_fileinfo extension is missing.
 * Detects the type from the file content (magic bytes), never from the file name,
 * and only knows the types the media uploader accepts. Anything else returns null
 * so upload validation rejects it.
 */
class ContentMimeTypeGuesser implements MimeTypeGuesserInterface
{
    public function isGuesserSupported(): bool
    {
        return true;
    }

    public function guessMimeType(string $path): ?string
    {
        if (!is_file($path) || !is_readable($path)) {
            return null;
        }

        $head = (string) file_get_contents($path, false, null, 0, 4096);
        if ($head === '') {
            return null;
        }

        $info = @getimagesize($path);
        if ($info && in_array($info['mime'] ?? '', ['image/jpeg', 'image/png', 'image/gif', 'image/webp'], true)) {
            return $info['mime'];
        }

        if (str_starts_with($head, '%PDF-')) {
            return 'application/pdf';
        }
        if (str_starts_with($head, "PK\x03\x04")) {
            return str_contains($head, 'word/')
                ? 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                : 'application/zip';
        }
        if (str_starts_with($head, "Rar!\x1A\x07")) {
            return 'application/x-rar-compressed';
        }
        if (substr($head, 4, 4) === 'ftyp') {
            return substr($head, 8, 2) === 'qt' ? 'video/quicktime' : 'video/mp4';
        }
        if (str_starts_with($head, "\x1A\x45\xDF\xA3")) {
            return 'video/webm';
        }
        if (str_starts_with($head, "\x30\x26\xB2\x75\x8E\x66\xCF\x11")) {
            return 'video/x-ms-wmv';
        }
        if (str_starts_with($head, 'ID3') || preg_match('/^\xFF[\xE2-\xFF]/', $head)) {
            return 'audio/mpeg';
        }
        if (preg_match('/^\s*(<\?xml[^>]*>\s*)?(<!--.*?-->\s*)*(<!DOCTYPE[^>]*>\s*)?<svg[\s>]/is', $head)) {
            return 'image/svg+xml';
        }

        return null;
    }
}
