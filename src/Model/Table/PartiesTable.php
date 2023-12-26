<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parties Model
 *
 * @property \App\Model\Table\CandidatesElectionsElectoratesTable&\Cake\ORM\Association\HasMany $CandidatesElectionsElectorates
 * @property \App\Model\Table\CandidatesPartiesElectionsTable&\Cake\ORM\Association\HasMany $CandidatesPartiesElections
 *
 * @method \App\Model\Entity\Party newEmptyEntity()
 * @method \App\Model\Entity\Party newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Party[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Party get($primaryKey, $options = [])
 * @method \App\Model\Entity\Party findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Party patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Party[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Party|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Party saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Party[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Party[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Party[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Party[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PartiesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('parties');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('CandidatesElectionsElectorates', [
            'foreignKey' => 'party_id',
        ]);
        $this->hasMany('CandidatesPartiesElections', [
            'foreignKey' => 'party_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->date('founded')
            ->allowEmptyDate('founded');

        return $validator;
    }
}
