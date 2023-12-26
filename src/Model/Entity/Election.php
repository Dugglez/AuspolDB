<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Election Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $date
 * @property string $jurisdiction
 * @property string $electoral_system
 * @property string|null $parliamentary_status
 * @property int|null $outgoing_government_party
 * @property int|null $incoming_government_party
 * @property int|null $government_seats
 * @property int|null $nongovernment_seats
 *
 * @property \App\Model\Entity\CandidatesElectionsElectorate[] $candidates_elections_electorates
 * @property \App\Model\Entity\CandidatesElectionsState[] $candidates_elections_states
 * @property \App\Model\Entity\CandidatesPartiesElection[] $candidates_parties_elections
 * @property \App\Model\Entity\Electorate[] $electorates
 */
class Election extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'date' => true,
        'jurisdiction' => true,
        'electoral_system' => true,
        'parliamentary_status' => true,
        'outgoing_government_party' => true,
        'incoming_government_party' => true,
        'government_seats' => true,
        'nongovernment_seats' => true,
        'candidates_elections_electorates' => true,
        'candidates_elections_states' => true,
        'candidates_parties_elections' => true,
        'electorates' => true,
    ];
}
