<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CandidatesPartiesElection Entity
 *
 * @property int $id
 * @property int $candidate_id
 * @property int $party_id
 * @property int $election_id
 *
 * @property \App\Model\Entity\Candidate $candidate
 * @property \App\Model\Entity\Party $party
 * @property \App\Model\Entity\Election $election
 */
class CandidatesPartiesElection extends Entity
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
        'candidate_id' => true,
        'party_id' => true,
        'election_id' => true,
        'candidate' => true,
        'party' => true,
        'election' => true,
    ];
}
