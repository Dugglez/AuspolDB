<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CandidatesElectionsElectorate Entity
 *
 * @property int $id
 * @property int $candidate_id
 * @property int $election_id
 * @property int $electorate_id
 * @property int $party_id
 * @property int $votes
 * @property string $swing
 * @property bool $winner
 * @property bool|null $prev_winner
 *
 * @property \App\Model\Entity\Candidate $candidate
 * @property \App\Model\Entity\Election $election
 * @property \App\Model\Entity\Electorate $electorate
 * @property \App\Model\Entity\Party $party
 */
class CandidatesElectionsElectorate extends Entity
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
        'election_id' => true,
        'electorate_id' => true,
        'party_id' => true,
        'votes' => true,
        'swing' => true,
        'winner' => true,
        'prev_winner' => true,
        'candidate' => true,
        'election' => true,
        'electorate' => true,
        'party' => true,
    ];
}
