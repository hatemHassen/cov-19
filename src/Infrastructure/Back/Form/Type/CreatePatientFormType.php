<?php


namespace App\Infrastructure\Back\Form\Type;

use App\Infrastructure\Front\Form\Type\CreatePatientFormType as FrontCreatePatientFormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CreatePatientFormType extends FrontCreatePatientFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder,$options);
        $builder
            ->add('create', SubmitType::class,['attr'=>['class'=>'btn btn-light'],'label'=>'common.create','translation_domain'=>'messages'])
            ->remove('send');
    }
}