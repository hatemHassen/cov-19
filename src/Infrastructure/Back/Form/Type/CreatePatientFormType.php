<?php


namespace App\Infrastructure\Back\Form\Type;

use App\Application\Command\CreatePatientCommand;
use App\Infrastructure\Front\Form\Type\CreatePatientFormType as FrontCreatePatientFormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;

class CreatePatientFormType extends FrontCreatePatientFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder,$options);
        $builder
            ->add('status', ChoiceType::class,['label' => 'patient.createPatientAction.form.status.label', 'choices' => ['patient.createPatientAction.form.status.inProgress' => 0, 'patient.createPatientAction.form.status.treated' => 1], 'expanded' => false, 'multiple' => false])
            ->add('comment', TextareaType::class,['label'=>'patient.createPatientAction.form.comment','required' => false])
            ->add('create', SubmitType::class,['attr'=>['class'=>'btn btn-light'],'label'=>'common.create','translation_domain'=>'messages'])
            ->remove('send');
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
        $forms['status']->setData($data ? $data->getStatus() : 0);
        $forms['comment']->setData($data ? $data->getComment() : '');
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
            $forms['heartBeat']->getData(),
            $forms['status']->getData(),
            1,
            $forms['comment']->getData()
        );
    }
}