<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Electorate Entity
 *
 * @property int $id
 * @property string $name
 * @property string $jurisdiction
 * @property string $type
 * @property string|null $namesake
 * @property bool|null $abolished
 * @property int|null $population
 *
 * @property \App\Model\Entity\CandidatesElectionsElectorate[] $candidates_elections_electorates
 * @property \App\Model\Entity\Election[] $elections
 */
class Electorate extends Entity
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
        'jurisdiction' => true,
        'type' => true,
        'namesake' => true,
        'abolished' => true,
        'population' => true,
        'candidates_elections_electorates' => true,
        'elections' => true,
    ];
}
