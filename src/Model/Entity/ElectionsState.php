<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ElectionsState Entity
 *
 * @property int $id
 * @property string $state
 * @property string|null $composition
 * @property int|null $formal_votes
 * @property int|null $informal_votes
 * @property int|null $turnout
 *
 * @property \App\Model\Entity\Candidate[] $candidates
 */
class ElectionsState extends Entity
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
        'state' => true,
        'composition' => true,
        'formal_votes' => true,
        'informal_votes' => true,
        'turnout' => true,
        'candidates' => true,
    ];
}
