<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Candidate Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 *
 * @property \App\Model\Entity\CandidatesPartiesElection[] $candidates_parties_elections
 * @property \App\Model\Entity\ElectionsElectorate[] $elections_electorates
 * @property \App\Model\Entity\ElectionsState[] $elections_states
 */
class Candidate extends Entity
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
        'name' => true,
        'description' => true,
        'candidates_parties_elections' => true,
        'elections_electorates' => true,
        'elections_states' => true,
    ];
}
