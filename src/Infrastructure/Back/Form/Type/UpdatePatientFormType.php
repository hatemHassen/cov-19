<?php


namespace App\Infrastructure\Back\Form\Type;

use App\Application\Command\UpdatePatientCommand;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;

class UpdatePatientFormType extends CreatePatientFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder,$options);
        $builder
            ->add('update', SubmitType::class, ['attr' => ['class' => 'btn btn-light'], 'label' => 'common.update', 'translation_domain' => 'messages'])
            ->remove('create');
    }

    /**
     * @param FormInterface[]|\Traversable $forms
     * @param UpdatePatientCommand $data
     */
    public function mapFormsToData($forms, &$data): void
    {
        $forms = iterator_to_array($forms);
        $data = new UpdatePatientCommand(
            $data->getId(),
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