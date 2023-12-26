<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Electorates Model
 *
 * @property \App\Model\Table\CandidatesElectionsElectoratesTable&\Cake\ORM\Association\HasMany $CandidatesElectionsElectorates
 * @property \App\Model\Table\ElectionsTable&\Cake\ORM\Association\BelongsToMany $Elections
 *
 * @method \App\Model\Entity\Electorate newEmptyEntity()
 * @method \App\Model\Entity\Electorate newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Electorate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Electorate get($primaryKey, $options = [])
 * @method \App\Model\Entity\Electorate findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Electorate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Electorate[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Electorate|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Electorate saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Electorate[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Electorate[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Electorate[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Electorate[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ElectoratesTable extends Table
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

        $this->setTable('electorates');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('CandidatesElectionsElectorates', [
            'foreignKey' => 'electorate_id',
        ]);
        $this->belongsToMany('Elections', [
            'foreignKey' => 'electorate_id',
            'targetForeignKey' => 'election_id',
            'joinTable' => 'elections_electorates',
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
            ->scalar('jurisdiction')
            ->requirePresence('jurisdiction', 'create')
            ->notEmptyString('jurisdiction');

        $validator
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('namesake')
            ->allowEmptyString('namesake');

        $validator
            ->boolean('abolished')
            ->allowEmptyString('abolished');

        $validator
            ->integer('population')
            ->allowEmptyString('population');

        return $validator;
    }
}
