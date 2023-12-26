<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Party Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\FrozenDate|null $founded
 *
 * @property \App\Model\Entity\CandidatesElectionsElectorate[] $candidates_elections_electorates
 * @property \App\Model\Entity\CandidatesPartiesElection[] $candidates_parties_elections
 */
class Party extends Entity
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
        'founded' => true,
        'description' => true,
        'candidates_elections_electorates' => true,
        'candidates_parties_elections' => true,
    ];
}
