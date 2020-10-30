<?php


namespace App\Infrastructure\Front\Form\Type;

use App\Application\Command\CreatePatientCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CreatePatientFormType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, ['label' => 'patient.createPatientAction.form.email'])
            ->add('lastName', TextType::class, ['label' => 'patient.createPatientAction.form.lastName'])
            ->add('firstName', TextType::class, ['label' => 'patient.createPatientAction.form.firstName'])
            ->add('gender', TextType::class, ['label' => 'patient.createPatientAction.form.gender'])
            ->add('age', TextType::class, ['label' => 'patient.createPatientAction.form.age'])
            ->add('street', TextType::class, ['label' => 'patient.createPatientAction.form.street'])
            ->add('city', TextType::class, ['label' => 'patient.createPatientAction.form.city'])
            ->add('zipCode', TextType::class, ['label' => 'patient.createPatientAction.form.zipCode'])
            ->add('mobile', TextType::class, ['label' => 'patient.createPatientAction.form.mobile'])
            ->add('phone', TextType::class, ['label' => 'patient.createPatientAction.form.phone'])
            ->add('antecedent', TextType::class, ['label' => 'patient.createPatientAction.form.antecedent'])
            ->add('treatment', TextType::class, ['label' => 'patient.createPatientAction.form.treatment'])
            ->add('symptoms', TextType::class, ['label' => 'patient.createPatientAction.form.symptoms'])
            ->add('symptomsStartDate', TextType::class, ['label' => 'patient.createPatientAction.form.symptomsStartDate'])
            ->add('doctorVisited', TextType::class, ['label' => 'patient.createPatientAction.form.doctorVisited'])
            ->add('emergencyVisited', TextType::class, ['label' => 'patient.createPatientAction.form.emergencyVisited'])
            ->add('temperature', TextType::class, ['label' => 'patient.createPatientAction.form.temperature'])
            ->add('breathingFrequency', TextType::class, ['label' => 'patient.createPatientAction.form.breathingFrequency'])
            ->add('oxygenSaturation', TextType::class, ['label' => 'patient.createPatientAction.form.oxygenSaturation'])
            ->add('heartBeat', TextType::class, ['label' => 'patient.createPatientAction.form.heartBeat'])
            ->add('send', SubmitType::class, ['attr' => ['class' => 'btn-hover btn-block main-btn'], 'translation_domain' => 'messages', 'label' => 'common.send'])
            ->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'empty_data' => null,
            'translation_domain' => 'patient'
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
        $forms['age']->setData($data ? $data->getAge() : '');
        $forms['street']->setData($data ? $data->getStreet() : '');
        $forms['city']->setData($data ? $data->getCity() : '');
        $forms['zipCode']->setData($data ? $data->getZipCode() : '');
        $forms['mobile']->setData($data ? $data->getMobile() : '');
        $forms['phone']->setData($data ? $data->getPhone() : '');
        $forms['antecedent']->setData($data ? $data->getAntecedent() : '');
        $forms['treatment']->setData($data ? $data->getTreatment() : '');
        $forms['symptoms']->setData($data ? $data->getSymptoms() : '');
        $forms['symptomsStartDate']->setData($data ? $data->getSymptomsStartDate() : '');
        $forms['doctorVisited']->setData($data ? $data->isDoctorVisited() : '');
        $forms['emergencyVisited']->setData($data ? $data->isEmergencyVisited() : '');
        $forms['temperature']->setData($data ? $data->getTemperature() : '');
        $forms['breathingFrequency']->setData($data ? $data->getBreathingFrequency() : '');
        $forms['oxygenSaturation']->setData($data ? $data->getOxygenSaturation() : '');
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
            $forms['street']->getData(),
            $forms['city']->getData(),
            $forms['zipCode']->getData(),
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