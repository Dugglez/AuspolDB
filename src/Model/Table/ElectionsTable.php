<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Elections Model
 *
 * @property \App\Model\Table\CandidatesElectionsElectoratesTable&\Cake\ORM\Association\HasMany $CandidatesElectionsElectorates
 * @property \App\Model\Table\CandidatesElectionsStatesTable&\Cake\ORM\Association\HasMany $CandidatesElectionsStates
 * @property \App\Model\Table\CandidatesPartiesElectionsTable&\Cake\ORM\Association\HasMany $CandidatesPartiesElections
 * @property \App\Model\Table\ElectoratesTable&\Cake\ORM\Association\BelongsToMany $Electorates
 *
 * @method \App\Model\Entity\Election newEmptyEntity()
 * @method \App\Model\Entity\Election newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Election[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Election get($primaryKey, $options = [])
 * @method \App\Model\Entity\Election findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Election patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Election[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Election|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Election saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Election[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Election[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Election[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Election[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ElectionsTable extends Table
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

        $this->setTable('elections');
        $this->setDisplayField('jurisdiction');
        $this->setPrimaryKey('id');

        $this->hasMany('CandidatesElectionsElectorates', [
            'foreignKey' => 'election_id',
        ]);
        $this->hasMany('CandidatesElectionsStates', [
            'foreignKey' => 'election_id',
        ]);
        $this->hasMany('CandidatesPartiesElections', [
            'foreignKey' => 'election_id',
        ]);
        $this->belongsToMany('Electorates', [
            'foreignKey' => 'election_id',
            'targetForeignKey' => 'electorate_id',
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
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmptyDate('date');

        $validator
            ->scalar('jurisdiction')
            ->requirePresence('jurisdiction', 'create')
            ->notEmptyString('jurisdiction');

        $validator
            ->scalar('electoral_system')
            ->requirePresence('electoral_system', 'create')
            ->notEmptyString('electoral_system');

        $validator
            ->scalar('parliamentary_status')
            ->allowEmptyString('parliamentary_status');

        $validator
            ->integer('outgoing_government_party')
            ->allowEmptyString('outgoing_government_party');

        $validator
            ->integer('incoming_government_party')
            ->allowEmptyString('incoming_government_party');

        $validator
            ->integer('government_seats')
            ->allowEmptyString('government_seats');

        $validator
            ->integer('nongovernment_seats')
            ->allowEmptyString('nongovernment_seats');

        return $validator;
    }
}
