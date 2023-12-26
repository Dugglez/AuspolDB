<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ElectionsElectorates Model
 *
 * @property \App\Model\Table\ElectionsTable&\Cake\ORM\Association\BelongsTo $Elections
 * @property \App\Model\Table\ElectoratesTable&\Cake\ORM\Association\BelongsTo $Electorates
 * @property \App\Model\Table\CandidatesTable&\Cake\ORM\Association\BelongsToMany $Candidates
 *
 * @method \App\Model\Entity\ElectionsElectorate newEmptyEntity()
 * @method \App\Model\Entity\ElectionsElectorate newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ElectionsElectorate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ElectionsElectorate get($primaryKey, $options = [])
 * @method \App\Model\Entity\ElectionsElectorate findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ElectionsElectorate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ElectionsElectorate[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ElectionsElectorate|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ElectionsElectorate saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ElectionsElectorate[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ElectionsElectorate[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ElectionsElectorate[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ElectionsElectorate[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ElectionsElectoratesTable extends Table
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

        $this->setTable('elections_electorates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Elections', [
            'foreignKey' => 'election_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Electorates', [
            'foreignKey' => 'electorate_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('Candidates', [
            'foreignKey' => 'elections_electorate_id',
            'targetForeignKey' => 'candidate_id',
            'joinTable' => 'candidates_elections_electorates',
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
            ->integer('election_id')
            ->notEmptyString('election_id');

        $validator
            ->integer('electorate_id')
            ->notEmptyString('electorate_id');

        $validator
            ->decimal('twocp_or_majority')
            ->requirePresence('twocp_or_majority', 'create')
            ->notEmptyString('twocp_or_majority');

        $validator
            ->integer('winning_candidate')
            ->requirePresence('winning_candidate', 'create')
            ->notEmptyString('winning_candidate');

        $validator
            ->integer('winning_party')
            ->requirePresence('winning_party', 'create')
            ->notEmptyString('winning_party');

        $validator
            ->integer('second_candidate')
            ->allowEmptyString('second_candidate');

        $validator
            ->integer('second_party')
            ->allowEmptyString('second_party');

        $validator
            ->integer('formal_votes')
            ->allowEmptyString('formal_votes');

        $validator
            ->integer('informal_votes')
            ->allowEmptyString('informal_votes');

        $validator
            ->decimal('turnout')
            ->allowEmptyString('turnout');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('election_id', 'Elections'), ['errorField' => 'election_id']);
        $rules->add($rules->existsIn('electorate_id', 'Electorates'), ['errorField' => 'electorate_id']);

        return $rules;
    }
}
