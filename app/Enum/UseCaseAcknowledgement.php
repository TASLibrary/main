<?php

namespace App\Enum;

enum UseCaseAcknowledgement: int
{
    case Public = 0;

    case Originator = 1;

    case Consent = 2;

    public static function getMessage(UseCaseAcknowledgement $acknowledgement): string
    {
        switch ($acknowledgement){
            case UseCaseAcknowledgement::Public:
                return 'The scenario described is publicly available and is submitted under "fair dealing" for critique/review.';
            case UseCaseAcknowledgement::Originator:
                return 'I am the originator of the scenario OR I have authority to grant permission for its publication.';
            case UseCaseAcknowledgement::Consent:
                return 'I am uploading the scenario with the informed consent of the copyright holder.';
        }

        return '';
    }
}
