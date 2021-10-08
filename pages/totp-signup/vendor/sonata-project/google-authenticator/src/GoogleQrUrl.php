<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\GoogleAuthenticator;

/**
 * Responsible for QR image url generation.
 *
 * @see http://goqr.me/api/
 * @see http://goqr.me/api/doc/
 * @see https://github.com/google/google-authenticator/wiki/Key-Uri-Format
 *
 * @author Iltar van der Berg <kjarli@gmail.com>
 */
final class GoogleQrUrl
{
    /**
     * Private by design.
     */
    private function __construct()
    {
    }


    public static function generate(string $accountName, string $secret, string $issuer, int $size = 200): string
    {
        if ('' === $accountName || false !== strpos($accountName, ':')) {
            throw RuntimeException::InvalidAccountName($accountName);
        }

        if ('' === $secret) {
            throw RuntimeException::InvalidSecret();
        }

        $label = $accountName;
        $otpauthString = 'otpauth://totp/%s?secret=%s';

        if (null !== $issuer) {
            if ('' === $issuer || false !== strpos($issuer, ':')) {
                throw RuntimeException::InvalidIssuer($issuer);
            }

            // use both the issuer parameter and label prefix as recommended by Google for BC reasons
            $label = $issuer.':'.$label;
            $otpauthString .= '&issuer=%s';
        }

        $otpauthString = rawurlencode(sprintf($otpauthString, $label, $secret, $issuer));

        return sprintf(
            'https://api.qrserver.com/v1/create-qr-code/?size=%1$dx%1$d&data=%2$s&ecc=M',
            $size,
            $otpauthString
        );
    }
}

// NEXT_MAJOR: Remove class alias
class_alias('Sonata\GoogleAuthenticator\GoogleQrUrl', 'Google\Authenticator\GoogleQrUrl', false);