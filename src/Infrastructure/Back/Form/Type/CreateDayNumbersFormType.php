<?php


namespace App\Infrastructure\Back\Form\Type;

use App\Application\Command\CreateDayNumbersCommand;
use App\Domain\Model\Town\Town;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateDayNumbersFormType extends AbstractType implements DataMapperInterface
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, ['label' => 'dayNumbers.createDayNumbersAction.form.date','widget'=> 'single_text'])
            ->add('newCases', NumberType ::class, ['label' => 'dayNumbers.createDayNumbersAction.form.newCases'])
            ->add('newDeaths', NumberType ::class, ['label' => 'dayNumbers.createDayNumbersAction.form.newDeaths'])
            ->add('newHealedCases', NumberType ::class, ['label' => 'dayNumbers.createDayNumbersAction.form.newHealedCases'])
            ->add('town', EntityType::class, ['label' => 'dayNumbers.createDayNumbersAction.form.town', 'class' => Town::class, 'choice_label' => 'name',])
            ->add('create', SubmitType::class,['attr'=>['class'=>'btn btn-light'],'label'=>'common.create','translation_domain' => 'messages'])

            ->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'empty_data' => null,
            'translation_domain' => 'dayNumbers',
            'attr' => ['class' => 'create-dayNumbers']
        ]);
    }

    /**
     * @param CreateDayNumbersCommand $data
     * @param FormInterface[]|\Traversable $forms
     */
    public function mapDataToForms($data, $forms): void
    {
        $forms = iterator_to_array($forms);
        $forms['newCases']->setData($data ? $data->getNewCases() : 0);
        $forms['newDeaths']->setData($data ? $data->getNewDeaths() : 0);
        $forms['newHealedCases']->setData($data ? $data->getNewHealedCases() : 0);
        $forms['town']->setData($data ? $data->getTown() : null);
        $forms['date']->setData($data ? $data->getDate() : null);

    }

    /**
     * @param FormInterface[]|\Traversable $forms
     * @param CreateDayNumbersCommand $data
     */
    public function mapFormsToData($forms, &$data): void
    {
        $forms = iterator_to_array($forms);

        $data = new CreateDayNumbersCommand(
            $forms['newCases']->getData(),
            $forms['newDeaths']->getData(),
            $forms['newHealedCases']->getData(),
            $forms['town']->getData(),
            $forms['date']->getData()
        );
    }

}