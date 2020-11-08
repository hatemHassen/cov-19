<?php


namespace App\Infrastructure\Front\Form\Type;
use App\Application\Command\ContactCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;

class ContactFormType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,['label'=>'home.sections.contact.contact.name'])
            ->add('email', EmailType::class,['label'=>'home.sections.contact.contact.email'])
            ->add('message', TextareaType::class,['label'=>'home.sections.contact.contact.message'])
            ->add('send', SubmitType::class,['attr'=>['class'=>'btn-hover btn-block main-btn'],'translation_domain' => 'messages','label'=>'common.send'])
             ->add('captcha', Recaptcha3Type::class, [
                 'constraints' => new Recaptcha3(),
                 'action_name' => 'homepage',
             ])
            ->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'empty_data' => null,
            'translation_domain' => 'home'
        ]);
    }

    /**
     * @param ContactCommand $data
     * @param FormInterface[]|\Traversable $forms
     */
    public function mapDataToForms($data, $forms): void
    {
        $forms = iterator_to_array($forms);
        $forms['name']->setData($data ? $data->getName() : '');
        $forms['email']->setData($data ? $data->getEmail() : '');
        $forms['message']->setData($data ? $data->getMessage() : '');
    }

    /**
     * @param FormInterface[]|\Traversable $forms
     * @param ContactCommand $data
     */
    public function mapFormsToData($forms, &$data): void
    {
        $forms = iterator_to_array($forms);

        $data = new ContactCommand(
            $forms['name']->getData(),
            $forms['email']->getData(),
            $forms['message']->getData()
        );
    }

}