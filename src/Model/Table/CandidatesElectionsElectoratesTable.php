<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CandidatesElectionsElectorates Model
 *
 * @property \App\Model\Table\CandidatesTable&\Cake\ORM\Association\BelongsTo $Candidates
 * @property \App\Model\Table\ElectionsTable&\Cake\ORM\Association\BelongsTo $Elections
 * @property \App\Model\Table\ElectoratesTable&\Cake\ORM\Association\BelongsTo $Electorates
 * @property \App\Model\Table\PartiesTable&\Cake\ORM\Association\BelongsTo $Parties
 *
 * @method \App\Model\Entity\CandidatesElectionsElectorate newEmptyEntity()
 * @method \App\Model\Entity\CandidatesElectionsElectorate newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CandidatesElectionsElectorate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CandidatesElectionsElectorate get($primaryKey, $options = [])
 * @method \App\Model\Entity\CandidatesElectionsElectorate findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CandidatesElectionsElectorate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CandidatesElectionsElectorate[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CandidatesElectionsElectorate|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CandidatesElectionsElectorate saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CandidatesElectionsElectorate[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CandidatesElectionsElectorate[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CandidatesElectionsElectorate[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CandidatesElectionsElectorate[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CandidatesElectionsElectoratesTable extends Table
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

        $this->setTable('candidates_elections_electorates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Candidates', [
            'foreignKey' => 'candidate_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Elections', [
            'foreignKey' => 'election_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Electorates', [
            'foreignKey' => 'electorate_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Parties', [
            'foreignKey' => 'party_id',
            'joinType' => 'INNER',
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
            ->integer('candidate_id')
            ->notEmptyString('candidate_id');

        $validator
            ->integer('election_id')
            ->notEmptyString('election_id');

        $validator
            ->integer('electorate_id')
            ->notEmptyString('electorate_id');

        $validator
            ->integer('party_id')
            ->notEmptyString('party_id');

        $validator
            ->integer('votes')
            ->requirePresence('votes', 'create')
            ->notEmptyString('votes');

        $validator
            ->decimal('swing')
            ->requirePresence('swing', 'create')
            ->notEmptyString('swing');

        $validator
            ->boolean('winner')
            ->requirePresence('winner', 'create')
            ->notEmptyString('winner');

        $validator
            ->boolean('prev_winner')
            ->allowEmptyString('prev_winner');

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
        $rules->add($rules->existsIn('candidate_id', 'Candidates'), ['errorField' => 'candidate_id']);
        $rules->add($rules->existsIn('election_id', 'Elections'), ['errorField' => 'election_id']);
        $rules->add($rules->existsIn('electorate_id', 'Electorates'), ['errorField' => 'electorate_id']);
        $rules->add($rules->existsIn('party_id', 'Parties'), ['errorField' => 'party_id']);

        return $rules;
    }
}
