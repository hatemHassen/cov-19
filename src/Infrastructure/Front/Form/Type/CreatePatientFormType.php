<?php


namespace App\Infrastructure\Front\Form\Type;

use App\Application\Command\CreatePatientCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType ;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Domain\Model\Town\Town;

class CreatePatientFormType extends AbstractType implements DataMapperInterface
{
    protected const ANTECEDENT_CHOICES = [
        'patient.createPatientAction.form.antecedent.tobacco' => 1,
        'patient.createPatientAction.form.antecedent.diabetes' => 2,
        'patient.createPatientAction.form.antecedent.cardiovascular' => 3,
        'patient.createPatientAction.form.antecedent.chronicLung' => 4,
        'patient.createPatientAction.form.antecedent.asthma' => 5,
        'patient.createPatientAction.form.antecedent.copd' => 6,
        'patient.createPatientAction.form.antecedent.chronicNephropathy' => 7,
        'patient.createPatientAction.form.antecedent.grafted' => 8,
        'patient.createPatientAction.form.antecedent.cirrhoses' => 9,
        'patient.createPatientAction.form.antecedent.hemopathy' => 10,
        'patient.createPatientAction.form.antecedent.otherDiseases' => 11,
        'patient.createPatientAction.form.antecedent.nothing' => 12,
    ];
    protected const TREATMENT_CHOICES = [
        'patient.createPatientAction.form.treatment.corticosteroid' => 1,
        'patient.createPatientAction.form.treatment.Biotherapy' => 2,
        'patient.createPatientAction.form.treatment.Chemotherapy' => 3,
        'patient.createPatientAction.form.treatment.other' => 4,
    ];
    protected const SYMPTOMS_CHOICES = [
        'patient.createPatientAction.form.symptoms.fever' => 1,
        'patient.createPatientAction.form.symptoms.cough' => 2,
        'patient.createPatientAction.form.symptoms.chest' => 3,
        'patient.createPatientAction.form.symptoms.muscle' => 4,
        'patient.createPatientAction.form.symptoms.lossStrength' => 5,
        'patient.createPatientAction.form.symptoms.conjunctivitis' => 6,
        'patient.createPatientAction.form.symptoms.neurological' => 7,
        'patient.createPatientAction.form.symptoms.digestive' => 8,
        'patient.createPatientAction.form.symptoms.swallowing' => 9,
        'patient.createPatientAction.form.symptoms.headache' => 10,
        'patient.createPatientAction.form.symptoms.other' => 11,
        'patient.createPatientAction.form.symptoms.lossSmell' => 12,

    ];
    protected const BOOLEAN_CHOICES = [
        'patient.createPatientAction.form.choice.yes' => 1,
        'patient.createPatientAction.form.choice.no' => 0,
    ];

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, ['label' => 'patient.createPatientAction.form.email'])
            ->add('lastName', TextType::class, ['label' => 'patient.createPatientAction.form.lastName'])
            ->add('firstName', TextType::class, ['label' => 'patient.createPatientAction.form.firstName'])
            ->add('gender', ChoiceType::class, ['label' => 'patient.createPatientAction.form.gender.label', 'choices' => ['patient.createPatientAction.form.gender.men' => 0, 'patient.createPatientAction.form.gender.women' => 1], 'expanded' => true, 'multiple' => false])
            ->add('age', NumberType ::class, ['label' => 'patient.createPatientAction.form.age'])
            ->add('street', TextType::class, ['label' => 'patient.createPatientAction.form.street'])
            ->add('town', EntityType::class, ['label' => 'patient.createPatientAction.form.town', 'class' => Town::class,'choice_label' => 'name',])
            ->add('zipCode', TextType::class, ['label' => 'patient.createPatientAction.form.zipCode'])
            ->add('mobile', TextType::class, ['label' => 'patient.createPatientAction.form.mobile'])
            ->add('phone', TextType::class, ['label' => 'patient.createPatientAction.form.phone', 'required' => false])
            ->add('antecedent', ChoiceType::class, ['label' => 'patient.createPatientAction.form.antecedent.label', 'choices' => self::ANTECEDENT_CHOICES, 'expanded' => true, 'multiple' => true])
            ->add('treatment', ChoiceType::class, ['label' => 'patient.createPatientAction.form.treatment.label', 'choices' => self::TREATMENT_CHOICES, 'expanded' => true, 'multiple' => true])
            ->add('symptoms', ChoiceType::class, ['label' => 'patient.createPatientAction.form.symptoms.label', 'choices' => self::SYMPTOMS_CHOICES, 'expanded' => true, 'multiple' => true])
            ->add('symptomsStartDate', DateType::class, ['label' => 'patient.createPatientAction.form.symptomsStartDate','widget'=> 'single_text'])
            ->add('doctorVisited', ChoiceType::class, ['label' => 'patient.createPatientAction.form.doctorVisited', 'choices' => self::BOOLEAN_CHOICES, 'expanded' => true, 'multiple' => false])
            ->add('emergencyVisited', ChoiceType::class, ['label' => 'patient.createPatientAction.form.emergencyVisited', 'choices' => self::BOOLEAN_CHOICES, 'expanded' => true, 'multiple' => false])
            ->add('temperature', NumberType ::class, ['label' => 'patient.createPatientAction.form.temperature'])
            ->add('breathingFrequency', NumberType ::class, ['label' => 'patient.createPatientAction.form.breathingFrequency'])
            ->add('oxygenSaturation', NumberType ::class, ['label' => 'patient.createPatientAction.form.oxygenSaturation'])
            ->add('heartBeat', ChoiceType::class, ['label' => 'patient.createPatientAction.form.heartBeat', 'choices' => self::BOOLEAN_CHOICES, 'expanded' => true, 'multiple' => false])
            ->add('send', SubmitType::class, ['attr' => ['class' => 'btn-hover btn-block main-btn'], 'translation_domain' => 'messages', 'label' => 'common.send'])
            ->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'empty_data' => null,
            'translation_domain' => 'patient',
            'attr' => ['class' => 'create-patient']
        ]);
    }

    /**
     * @param CreatePatientCommand $data
     * @param FormInterface[]|\Traversable $forms
     */
    public function mapDataToForms($data, $forms): void
    {
        $forms = iterator_to_array($forms);
        $forms['email']->setData($data ? $data->getEmail() : '');
        $forms['lastName']->setData($data ? $data->getLastName() : '');
        $forms['firstName']->setData($data ? $data->getFirstName() : '');
        $forms['gender']->setData($data ? $data->getGender() : '');
        $forms['age']->setData($data ? $data->getAge() : 0);
        $forms['street']->setData($data ? $data->getStreet() : '');
        $forms['town']->setData($data ? $data->getTown() : null);
        $forms['zipCode']->setData($data ? $data->getZipCode() : '');
        $forms['mobile']->setData($data ? $data->getMobile() : '');
        $forms['phone']->setData($data ? $data->getPhone() : '');
        $forms['antecedent']->setData($data ? $data->getAntecedent() : []);
        $forms['treatment']->setData($data ? $data->getTreatment() : []);
        $forms['symptoms']->setData($data ? $data->getSymptoms() : []);
        $forms['symptomsStartDate']->setData($data ? $data->getSymptomsStartDate() : new \DateTime());
        $forms['doctorVisited']->setData($data ? $data->isDoctorVisited() : '');
        $forms['emergencyVisited']->setData($data ? $data->isEmergencyVisited() : '');
        $forms['temperature']->setData($data ? $data->getTemperature() : 0);
        $forms['breathingFrequency']->setData($data ? $data->getBreathingFrequency() : 0);
        $forms['oxygenSaturation']->setData($data ? $data->getOxygenSaturation() : 0);
        $forms['heartBeat']->setData($data ? $data->getHeartBeat() : '');
    }

    /**
     * @param FormInterface[]|\Traversable $forms
     * @param CreatePatientCommand $data
     */
    public function mapFormsToData($forms, &$data): void
    {
        $forms = iterator_to_array($forms);

        $data = new CreatePatientCommand(
            $forms['email']->getData(),
            $forms['lastName']->getData(),
            $forms['firstName']->getData(),
            $forms['gender']->getData(),
            $forms['age']->getData(),
            $forms['town']->getData(),
            $forms['zipCode']->getData(),
            $forms['street']->getData(),
            $forms['mobile']->getData(),
            $forms['phone']->getData(),
            $forms['antecedent']->getData(),
            $forms['treatment']->getData(),
            $forms['symptoms']->getData(),
            $forms['symptomsStartDate']->getData(),
            $forms['doctorVisited']->getData(),
            $forms['emergencyVisited']->getData(),
            $forms['temperature']->getData(),
            $forms['breathingFrequency']->getData(),
            $forms['oxygenSaturation']->getData(),
            $forms['heartBeat']->getData()
        );
    }

}