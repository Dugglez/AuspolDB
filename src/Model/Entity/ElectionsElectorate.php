<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ElectionsElectorate Entity
 *
 * @property int $id
 * @property int $election_id
 * @property int $electorate_id
 * @property string $twocp_or_majority
 * @property int $winning_candidate
 * @property int $winning_party
 * @property int|null $second_candidate
 * @property int|null $second_party
 * @property int|null $formal_votes
 * @property int|null $informal_votes
 * @property string|null $turnout
 *
 * @property \App\Model\Entity\Election $election
 * @property \App\Model\Entity\Electorate $electorate
 * @property \App\Model\Entity\Candidate[] $candidates
 */
class ElectionsElectorate extends Entity
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
        'election_id' => true,
        'electorate_id' => true,
        'twocp_or_majority' => true,
        'winning_candidate' => true,
        'winning_party' => true,
        'second_candidate' => true,
        'second_party' => true,
        'formal_votes' => true,
        'informal_votes' => true,
        'turnout' => true,
        'election' => true,
        'electorate' => true,
        'candidates' => true,
    ];
}
